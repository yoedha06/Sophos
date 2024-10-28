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
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
class CreateGroup extends Component
{
    #[Title('Add Group Computers')]

    public $name;
    public $description;
    public $type = 'computer';
    public $endpointIds = [];
    public $search = '';

    protected $rules = [
        'name' => 'required|min:3',
        'description' => 'nullable|min:3|max:255',
        'endpointIds' => 'required'
    ];

    public function create()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $tenant = Tenant::first();
            $token = (new SophosHelper())->createToken()->json()['access_token'];

            $payload = [
                'name' => $this->name,
                'description' => $this->description,
                'type' => $this->type,
                'endpointIds' =>  $this->endpointIds
            ];

            $postGroup = Http::baseUrl('https://api-au01.central.sophos.com')
                ->withToken($token)
                ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                ->post('/endpoint/v1/endpoint-groups', $payload);

            logger($postGroup->json());
            $response = $postGroup->json();

            if ($postGroup->failed() && $response['error'] === 'Unauthorized'){
                $token = (new SophosHelper())->createToken()->json()['access_token'];
                SettingHelper::setByKey('access_token', $token);

                $postGroup = Http::baseUrl('https://api-au01.central.sophos.com')
                ->withToken($token)
                ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                ->post('/endpoint/v1/endpoint-groups', $payload);

                Group::create([
                    'id_group' => $response['id'],
                    'tenant_id' => $response['tenant']['id'],
                    'name' => $response['name'],
                    'description' => $response['description'] ?? null,
                    'type' => $response['type'],
                    'total_assigned' => $response['endpoints']['total'] ?? null
                ]);

                if(!empty($response['endpoints']['items']))
                {
                    foreach($response['endpoints']['items'] as $data){
                        GroupComputer::create([
                            'group_id' => $response['id'],
                            'hostname' => $data['hostname'],
                            'computer_id' => $data['id']
                        ]);
                    }
                }

                return $postGroup;
            }

            Group::create([
                'id_group' => $response['id'],
                'tenant_id' => $response['tenant']['id'],
                'name' => $response['name'],
                'description' => $response['description'] ?? null,
                'type' => $response['type'],
                'total_assigned' => $response['endpoints']['total'] ?? null
            ]);

            if(!empty($response['endpoints']['items']))
            {
                foreach($response['endpoints']['items'] as $data){
                    GroupComputer::create([
                        'group_id' => $response['id'],
                        'hostname' => $data['hostname'],
                        'computer_id' => $data['id']
                    ]);
                }
            }
            DB::commit();
            Log::info('data group berhasil disimpan');
            session()->flash('success', 'group'. $this->name . 'created successfully');
            $this->redirectRoute('computer.group', navigate:true);

        } catch(\Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            session()->flash('error', $e->getMessage());
            $this->redirectRoute('computer.group', navigate:true);
        }

    }

    public function render()
    {
        return view('livewire.computer.group.create-group',[
            'computersAvailable' => Computer::doesntHave('groupComputer')
                ->where('hostname', 'like', '%'. $this->search .'%')
                ->get()
        ]);
    }
}
