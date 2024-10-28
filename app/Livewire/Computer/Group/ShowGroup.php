<?php

namespace App\Livewire\Computer\Group;

use App\Helpers\SophosHelper;
use App\Models\Group;
use App\Models\GroupComputer;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowGroup extends Component
{
    public $id;
    public $groups;

    public function mount($id)
    {
        $this->groups = Group::where('id_group', $id)->first();
    }

    public function deleteGroup($id)
    {
        $group = Group::where('id_group', $id)->first();
        
        DB::beginTransaction();
        try {
            $tenant = Tenant::first();
            $token = (new SophosHelper())->createToken()->json()['access_token'];

            $delete = Http::baseUrl('https://api-au01.central.sophos.com')
                    ->withToken($token)
                    ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                    ->delete('/endpoint/v1/endpoint-groups/' . $id);
                
            if ($delete->ok()){
                logger($delete->json());
                $group->delete();
                DB::table('groups')->where('id_group', $id)->delete();
                DB::table('group_computers')->where('group_id', $id)->delete();

                session()->flash('success', 'policy deleted Successfully');
                $this->redirectRoute('computer.group', navigate:true);
                DB::commit();
            } else {
                logger($delete->json());
                DB::rollback();
                session()->flash('error', $delete->json()['message']);
                $this->redirectRoute('computer.group', navigate:true);
            }
        } catch(\Exception $e) {
            logger($e->getMessage());
            DB::rollback();
            session()->flash('error', $e->getMessage());
            $this->redirectRoute('computer.group', navigate:true);
        }
    }

    public function render()
    {
        return view('livewire.computer.group.show-group',[
            'groups' => $this->groups,
            'computerGroups' => GroupComputer::where('group_id', $this->groups->id_group)->get(),
            'countComputerGroups' => GroupComputer::where('group_id', $this->groups->id_group)->count(),
        ]);
    }
}
