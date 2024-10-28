<?php

namespace App\Livewire\Computer\Group;

use App\Models\Group;
use App\Models\Policy;
use App\Models\PolicyGrupComputer;
use Livewire\Component;

class PolicyGroup extends Component
{
    public $id;
    public $groups;
    public $policyGroup;

    public function mount($id)
    {
        $group = Group::where('id_group', $id)->first();
        $policy = PolicyGrupComputer::where('group_id', $group->id_group)->limit(1)->latest();
        $getPolicy = Policy::whereIn('id_policies', $policy->pluck('policy_id'))->get();
        $this->policyGroup = $getPolicy;
        $this->groups = $group;

    }

    public function render()
    {
        return view('livewire.computer.group.policy-group',[
            'groups' => $this->groups,
            'policyGroup' => $this->policyGroup
        ]);
    }
}
