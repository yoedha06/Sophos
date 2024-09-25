<?php

namespace App\Livewire\Computer;

use App\Helpers\SophosHelper;
use App\Models\Computer;
use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Component;

class DetailComputer extends Component
{
    public $id_computer;
    public Computer $computer;

    #[Layout('components.layouts.app')]

    public function mount()
    {
        $this->computer = Computer::where('id_computer', $this->id_computer)->first();
    }

    public function fecthEvent()
    {
        return (new SophosHelper())->getEvent()->json();
    }
    
    public function render()
    {
        $event = Event::where('computer_id', $this->id_computer)->orderBy('event_create_at', 'desc')->get();
        return view('livewire.computer.detail-computer',[
            'computer' => $this->computer,
            'events' => $event,
        ]);
    }
}
