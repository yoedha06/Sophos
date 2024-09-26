<?php

namespace App\Livewire\Computer;

use App\Helpers\SophosHelper;
use App\Models\Computer;
use App\Models\Event;
use Livewire\Component;

class DetailComputer extends Component
{
    public $id_computer;
    public Computer $computer;
    public function mount($id_computer)
    {
        $this->id_computer = $id_computer;
        $this->computer = Computer::where('id_computer', $this->id_computer)->first();
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
        $event = Event::where('computer_id', $this->id_computer)->orderBy('event_create_at', 'desc')->limit(5)->get();
        return view('livewire.computer.detail-computer',[
            'computer' => $this->computer,
            'events' => $event,
        ]);
    }
}
