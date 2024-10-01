<?php

namespace App\Livewire\Status;

use App\Helpers\SophosHelper;
use App\Models\Computer;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class IndexStatus extends Component
{
    public $id_computer;
    public Computer $computer;
    public $healthServices = [];

    public function mount($id_computer)
    {
        $this->id_computer = $id_computer;
        $this->computer = Computer::where('id_computer', $this->id_computer)->first();
        
        if ($this->computer) {
            $this->healthServices = $this->computer->health_service_details;
        }
    }

    public function fecthEvent()
    {
        return (new SophosHelper())->getEvent()->json();
    }

    public function fecth()
    {
        $this->fecthEvent();
    }
    public function render()
    {
        return view('livewire.status.index-status');
    }
}
