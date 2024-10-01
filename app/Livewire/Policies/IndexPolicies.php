<?php

namespace App\Livewire\Policies;

use App\Helpers\SophosHelper;
use App\Models\Computer;
use App\Models\Policy;
use App\Models\PolicyComputer;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
class IndexPolicies extends Component
{
    #[Title('Policies')]
    public $id_computer;
    public Computer $computer;
    public $policies = [];

    public function mount($id_computer)
    {
        $this->id_computer = $id_computer;
        $this->computer = Computer::where('id_computer', $this->id_computer)->first();

        $policyId = PolicyComputer::where('computer_id', $id_computer)->get()->pluck('policy_id')->implode(',');
        $policy = Policy::whereIn('id_policies', explode(',', $policyId))->get();
        $this->policies = $policy;
    }

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
        $this->fecthPolicySetting();
        $this->fecthPolicies();
    }
    public function render()
    {
        return view('livewire.policies.index-policies', [
            'policies' => $this->policies
        ]);
    }
}
