<?php

namespace App\Livewire\Policies;

use App\Helpers\SettingHelper;
use App\Helpers\SophosHelper;
use App\Models\Computer;
use App\Models\Policy;
use App\Models\PolicyComputer;
use App\Models\PolicyUser;
use App\Models\ShUser;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
class CreatePolicies extends Component
{
    #[Title('Create Policies')]
    public $type;
    public $name;
    public $group;
    public $searchDevice = '';
    public $searchUser = '';
    public $selectedEndpoints = [];
    public $selectedUsers = [];
    public $settings;
    public $settingType = false;
    
    protected $rules = [    
        'type' => 'required',
        'name' => 'required',
        'group' => 'required',
        'selectedEndpoints' => 'required_without:selectedUsers',
        'selectedUsers' => 'required_without:selectedEndpoints',
    ];

    public function updatedType($value)
    {
        if ($value === 'windows-firewall') {
            $this->group = 'device';
        } else if ($value === 'web-control') {
            $this->group = 'user';
        } else {
            $this->group = '';
        }
    }

    public function accessToken()
    {
        return (new SophosHelper())->createToken()->json()['access_token'];
    }

    public function create()
    {
        $this->validate();
        $tenant = Tenant::first();

        try {
            DB::transaction(function () use ($tenant) {
                $token = $this->accessToken();

                $appliesTo = [];
                if ($this->group === 'device' && !empty($this->selectedEndpoints)) {
                    $this->selectedUsers = [];
                    $appliesTo['endpoints'] = $this->selectedEndpoints;
                } elseif ($this->group === 'user' && !empty($this->selectedUsers)) {
                    $this->selectedEndpoints = []; 
                    $appliesTo['users'] = $this->selectedUsers;
                }

                $payload = [
                    'name' => $this->name,
                    'type' => $this->type,
                    'appliesTo' => $appliesTo,
                ];

                $post = Http::baseUrl('https://api-au01.central.sophos.com')
                    ->withToken($token)
                    ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                    ->post('/endpoint/v1/policies', $payload);

                $responseData = $post->json();

                if ($post->failed() && $responseData['error'] === 'Unauthorized') {
                    $token = $this->accessToken();
                    SettingHelper::setByKey('access_token', $token);

                    $post = Http::baseUrl('https://api-au01.central.sophos.com')
                        ->withToken($token)
                        ->withHeader('X-Tenant-ID', $tenant->id_tenant)
                        ->post('/endpoint/v1/policies', $payload);

                    $responseData = $post->json();
                }

                if ($post->failed()) {
                    Log::error('Failed with status: ' . $post->status() . ' and response: ' . json_encode($post->json()));
                    throw new \Exception('Failed create policy: ' . ($responseData['error'] ?? 'Unknown error'));
                }

                if (isset($responseData['id'])) {
                    Policy::create([
                        'id_policies' => $responseData['id'],
                        'name' => $responseData['name'],
                        'type' => $responseData['type'],
                        'locked_by_managing_account' => $responseData['lockedByManagingAccount'],
                        'priority' => $responseData['priority'],
                        'tenant_id' => $responseData['tenant']['id'],
                        'enabled' => $responseData['enabled'],
                        'settings' => json_encode($responseData['settings']),
                    ]);

                        if (isset($responseData['appliesTo']['endpoints'])) {
                            $computers = $responseData['appliesTo']['endpoints'];

                            foreach ($computers as $computerId) {
                                PolicyComputer::create([
                                    'policy_id' => $responseData['id'],
                                    'computer_id' => $computerId
                                ]);
                            }
                        } elseif (isset($responseData['appliesTo']['users'])) {
                            $users = $responseData['appliesTo']['users'];

                            foreach ($users as $userId) {
                                PolicyUser::create([
                                    'policy_id' => $responseData['id'],
                                    'user_id' => $userId
                                ]);
                            }
                        }

                    session()->flash('success', 'Policy Created Successfully');
                    $this->reset(['type', 'name', 'group', 'selectedEndpoints']);
                    $this->redirect('/policies/list', navigate:true);
                }else {
                    Log::error('ID not found in response: ' . json_encode($responseData));
                    throw new \Exception('ID not found in response');
                }
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            session()->flash('error', $e->getMessage());
        }
    }

    public function applies()
    {
        $this->reset(['selectedEndpoints', 'selectedUsers']);
    }

    public function render()
    {
        return view('livewire.policies.create-policies', [
            'endpoints' => Computer::where('hostname', 'like', '%'. $this->searchDevice .'%')->get(),
            'users' => ShUser::where('name', 'like', '%' . $this->searchUser . '%')->get(),
            'computers' => Computer::count(),
            'user' => ShUser::count(),
            'settings' => $this->settings
        ]);
    }
}
