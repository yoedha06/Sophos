<?php

namespace App\Livewire\Events;

use App\Helpers\SophosHelper;
use App\Models\Computer;
use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class IndexEvent extends Component
{
    
    use WithPagination;
    #[Title('Events')]
    public $startDate;
    public $endDate; 
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

    public function filterByDateRange()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Event::where('computer_id', $this->id_computer);

        if ($this->startDate) {
            $query->whereDate('event_create_at', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('event_create_at', '<=', $this->endDate);
        }

        $events = $query->orderBy('event_create_at', 'desc')->paginate(10);

        return view('livewire.events.index-event', [
            'events' => $events,
        ]);
    }
}
