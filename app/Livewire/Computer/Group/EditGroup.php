<?php

namespace App\Livewire\Computer\Group;

use App\Helpers\SettingHelper;
use App\Helpers\SophosHelper;
use App\Models\Computer;
use App\Models\Group;
use App\Models\GroupComputer;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class EditGroup extends Component
{
    public $id;
    public $name;
    public $description;
    public $search = '';
    public $endpointIds = [];

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable|min:3|max:255',
        'endpointIds' => 'required'
    ];

    public function mount($id)
    {
        $group = Group::where('id_group', $id)->first();
        $this->name = $group->name;
        $this->description = $group->description;
        $this->endpointIds = GroupComputer::where('group_id', $this->id)->pluck('computer_id')->toArray();
    }

    public function update()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $tenant = Tenant::first();
            $token = (new SophosHelper())->createToken()->json()['access_token'];

            $payload = [
                'name' => $this->name,
                'description' => $this->description,
            ];

            $payloadEndpoints = [
                'ids' => $this->endpointIds
            ];

            $editGroup = Http::baseUrl('https://api-au01.central.sophos.com')
                ->withToken($token)
                ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                ->patch('/endpoint/v1/endpoint-groups/' . $this->id, $payload);

            $editGroupEndpoint = Http::baseUrl('https://api-au01.central.sophos.com')
                ->withToken($token)
                ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                ->post('/endpoint/v1/endpoint-groups/' . $this->id . '/endpoints', $payloadEndpoints);

            $response = $editGroup->json();
            $responseEndpoints = $editGroupEndpoint->json();
            
            logger('Response from editGroup:', $response);
            logger('Response from editGroupEndpoint:', $responseEndpoints);

            if ($editGroup->failed() && isset($response['error']) && $response['error'] === 'Unauthorized') {
                $token = (new SophosHelper())->createToken()->json()['access_token'];
                SettingHelper::setByKey('access_token', $token);

                $editGroup = Http::baseUrl('https://api-au01.central.sophos.com')
                    ->withToken($token)
                    ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                    ->patch('/endpoint/v1/endpoint-groups/' . $this->id, $payload);
                
                $editGroupEndpoint = Http::baseUrl('https://api-au01.central.sophos.com')
                    ->withToken($token)
                    ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                    ->post('/endpoint/v1/endpoint-groups/' . $this->id . '/endpoints', $payloadEndpoints);

                $response = $editGroup->json();
                $responseEndpoints = $editGroupEndpoint->json();
            }

            if ($editGroup->successful() && $editGroupEndpoint->successful()) {

                Group::updateOrCreate(
                    ['id_group' => $response['id']],
                    [
                        'name' => $response['name'],
                        'description' => $response['description'],
                        'type' => $response['type'],
                        'tenant_id' => $response['tenant']['id']
                    ]
                );

                if (!empty($responseEndpoints['addedEndpoints'])) {
                    foreach ($responseEndpoints['addedEndpoints'] as $computer) {
                        GroupComputer::updateOrCreate(
                            [
                                'group_id' => $response['id'],
                                'computer_id' => $computer['id']
                            ],
                            [
                                'hostname' => $computer['hostname']
                            ]
                        );
                    }
                }

                DB::commit();
                session()->flash('success', 'Group Updated Successfully');
                $this->redirectRoute('computer.group', navigate: true);
            } else {
                logger('Failed to update group or endpoints.');
                DB::rollback();
                session()->flash('error', 'Failed to update group or endpoints.');
            }
        } catch (\Exception $e) {
            DB::rollback();
            logger('Error transaction: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.computer.group.edit-group',[
            'computersAvailable' => Computer::doesntHave('groupComputer')
                ->where('hostname', 'like', '%'. $this->search .'%')
                ->get()
        ]);
    }
}
