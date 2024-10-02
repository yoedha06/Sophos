<?php

namespace App\Livewire\Computer;

use App\Helpers\SophosHelper;
use App\Models\Computer;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
#[Layout('components.layouts.app')]
class IndexComputer extends Component
{
    public $sortBy = 'created_at';
    public $sortDir = 'DESC'; 

    #[Title('Computers')]
    public function fecthComputer()
    {
        return (new SophosHelper())->getUsers()->json();
    }

    public function fecth()
    {
        $this->fecthComputer();
    }

    public function setSortBy($sortByField)
    {
        if($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir ==  "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }

    public function render()
    {
        return view('livewire.computer.index-computer',[
            'computers' => Computer::orderBy($this->sortBy, $this->sortDir)->get(),
        ]);
    }
}
