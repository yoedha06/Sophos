<?php

namespace App\Livewire\Policies;

use App\Helpers\SophosHelper;
use App\Models\Computer;
use App\Models\Policy;
use App\Models\PolicyComputer;
use App\Models\PolicyUser;
use App\Models\ShUser;
use App\Models\Tenant;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use PDO;

class EditPolicies extends Component
{
    public $id;
    public $type;
    public $name;
    public $selectedEndpoints = [];
    public $selectedUsers = [];
    public $applyEndpoints = false;
    public $applyUsers = false;
    public $searchUsers = '';
    public $searchDevice = '';

    public function mount($id_policies)
    {
        $policy = Policy::where('id_policies', $id_policies)
            ->where('type', '!=', 'Base Policy')->first();

        if ($policy) {
            $this->id = $policy->id_policies;
            $this->type = $policy->type;
            $this->name = $policy->name;
            $this->selectedEndpoints = PolicyComputer::where('policy_id', $this->id)->pluck('computer_id')->toArray();
            $this->selectedUsers = PolicyUser::where('policy_id', $this->id)->pluck('user_id')->toArray();

            if (count($this->selectedEndpoints) > 0) {
                $this->applyEndpoints = true;
            } else if (count($this->selectedUsers) > 0) {
                $this->applyUsers = true;
            } else {
                $this->applyEndpoints = false;
                $this->applyUsers = false;
            }
        }
    }

    public function accessToken()
    {
        return (new SophosHelper())->createToken()->json()['access_token'];
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $tenant = Tenant::first();
            $token = $this->accessToken();

            $appliesTo = [];

            if ($this->applyEndpoints && count($this->selectedEndpoints) > 0) {
                $appliesTo['endpoints'] = $this->selectedEndpoints;
            } elseif ($this->applyUsers && count($this->selectedUsers) > 0) {
                $appliesTo['users'] = $this->selectedUsers;
            }

            $payload = [
                'name' => $this->name,
                'appliesTo' => $appliesTo,
            ];

            $patch = Http::baseUrl('https://api-au01.central.sophos.com')
                ->withToken($token)
                ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                ->patch('/endpoint/v1/policies/' . $this->id, $payload);

                if ($patch->ok()) {
                    Policy::updateOrCreate([
                        'id_policies' => $this->id,
                    ],[
                        'id_policies' =>$this->id,
                        'name' => $this->name,
                    ]);

                    if (isset($patch->json()['appliesTo']['endpoints'])) {
                        $computer = $patch->json()['appliesTo']['endpoints'];

                        DB::table('policy_computers')
                            ->where('policy_id', $this->id)
                            ->whereNotIn('computer_id', $computer)
                            ->delete();

                        foreach ($computer as $endpoint) {
                            DB::table('policy_computers')
                                ->updateOrInsert([
                                    'policy_id' => $this->id,
                                    'computer_id' => $endpoint,
                                ],[
                                    'policy_id' => $this->id,
                                    'computer_id' => $endpoint,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]
                            );
                        }
                    } elseif(isset($patch->json()['appliesTo']['users'])) {
                        $users = $patch->json()['appliesTo']['users'];

                        DB::table('policy_users')
                            ->where('policy_id', $this->id)
                            ->whereNotIn('user_id', $users)
                            ->delete();

                        foreach ($users as $user) {
                            DB::table('policy_users')
                                ->updateOrInsert([
                                    'policy_id' => $this->id,
                                    'user_id' => $user,
                                ],[
                                    'policy_id' => $this->id,
                                    'user_id' => $user,
                                    'created_at' => now(),
                                    'updated_at' => now(),
                                ]
                            );
                        }
                    }
                    
                    session()->flash('success', 'Policy updated successfully');
                    DB::commit();
                    $this->redirect('/policies/list', navigate:true);
                } else {
                    DB::rollback();
                    session()->flash('error', $patch->json()['message']);
                    $this->redirect('/policies/list', navigate:true);
                }

        } catch (Exception $e) {
            DB::rollback();
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }


    public function render()
    {
        return view('livewire.policies.edit-policies', [
            'users' => ShUser::where('name', 'like', '%' . $this->searchUsers . '%')->get(),
            'computers' => Computer::where('hostname', 'like', '%' . $this->searchDevice . '%')->get(),
            'countComputer' => Computer::count(),
            'countUsers' => ShUser::count(),
        ]);
    }
}
