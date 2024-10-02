<?php

namespace App\Livewire\Policies;

use App\Models\Policy;
use App\Models\PolicyComputer;
use App\Models\PolicyUser;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Layout('components.layouts.app')]
class ListPolicies extends Component
{
    #[Title(' List Policies')]
    public function render()
    {
        $policies = Policy::with('policySetting')->get()->groupBy('type');

        foreach ($policies as $type => $policyGroup) {
            foreach ($policyGroup as $policy) {
                $policy->computer_count = PolicyComputer::where('policy_id', $policy->id_policies)->count();
                $policy->user_count = PolicyUser::where('policy_id', $policy->id_policies)->count();
            }
        }
        return view('livewire.policies.list-policies', [
            'policies' => $policies
        ]);
    }
}
