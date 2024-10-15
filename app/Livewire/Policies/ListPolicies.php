<?php

namespace App\Livewire\Policies;

use App\Helpers\SophosHelper;
use App\Models\Policy;
use App\Models\PolicyComputer;
use App\Models\PolicyUser;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
class ListPolicies extends Component
{
    #[Title(' List Policies')]
    protected $listeners = ['refreshComponent' => '$refresh'];
    public $search = '';
    public $id_policies;

    public function fecthPolicies()
    {
        return (new SophosHelper())->getPolicies()->json();
    }
    public function fecthPolicySetting()
    {
        return (new SophosHelper())->getSettingPolicy()->json();
    }

    public function fecth()
    {
        $this->fecthPolicies();
    }

    public function accessToken()
    {
        return (new SophosHelper())->createToken()->json()['access_token'];
    }

    public function deletePolicy($id_policies)
    {
        $policy = Policy::where('id_policies', $id_policies)->first();
        
        DB::beginTransaction();
        try {
            $tenant = Tenant::first();
            $token = $this->accessToken();
            $url = "https://api-au01.central.sophos.com/endpoint/v1/policies/";

            $delete = Http::baseUrl('https://api-au01.central.sophos.com')
                    ->withToken($token)
                    ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                    ->delete($url . $id_policies);
                
            if ($delete->ok()){
                logger($delete->json());
                $policy->delete();
                DB::table('policy_computers')->where('policy_id', $id_policies)->delete();
                DB::table('policy_users')->where('policy_id', $id_policies)->delete();

                session()->flash('success', 'policy deleted Successfully');
                $this->redirect('/policies/list', navigate:true);
                DB::commit();
            } else {
                logger($delete->json());
                DB::rollback();
                session()->flash('error', $delete->json()['message']);
                $this->redirect('/policies/list', navigate:true);
            }
        } catch(\Exception $e) {
            logger($e->getMessage());
            DB::rollback();
            session()->flash('error', $e->getMessage());
            $this->redirect('/policies/list', navigate:true);
        }
    }

    public function render()
    {
        $policies = Policy::with('policySetting')
            ->whereIn('type', ['application-control', 'windows-firewall', 'threat-protection', 'peripheral-control', 'web-control'])
            ->where('type', 'like', '%'. $this->search .'%')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('type');

        foreach ($policies as $type => $policyGroup) {
            foreach ($policyGroup as $policy) {
                $policy->computer_count = PolicyComputer::where('policy_id', $policy->id_policies)->count();
                $policy->user_count = PolicyUser::where('policy_id', $policy->id_policies)->count();
            }
        }
        return view('livewire.policies.list-policies', [
            'policies' => $policies,
        ]);
    }
}
