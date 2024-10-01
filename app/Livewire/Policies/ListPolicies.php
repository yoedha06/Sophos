<?php

namespace App\Livewire\Policies;

use App\Models\Policy;
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
        return view('livewire.policies.list-policies', [
            'policies' => $policies
        ]);
    }
}
