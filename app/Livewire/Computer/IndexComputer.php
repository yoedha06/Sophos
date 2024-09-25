<?php

namespace App\Livewire\Computer;

use App\Helpers\SophosHelper;
use App\Models\Computer;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('components.layouts.app')]
class IndexComputer extends Component
{
    public function fecthComputer()
    {
        return (new SophosHelper())->getEndpoint()->json();
    }

    public function fetch()
    {
        $this->fecthComputer();
    }

    public function render()
    {
        return view('livewire.computer.index-computer',[
            'computers' => Computer::all(),
        ]);
    }
}
