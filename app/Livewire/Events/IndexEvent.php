<?php

namespace App\Livewire\Events;

use App\Helpers\SophosHelper;
use App\Models\Computer;
use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class IndexEvent extends Component
{
    use WithPagination;
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
        $event = Event::where('computer_id', $this->id_computer)->orderBy('event_create_at', 'desc')->paginate(5);
        return view('livewire.events.index-event',[
            'events' => $event,
        ]);
    }
}
