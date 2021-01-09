<?php

namespace App\Http\Livewire;

use App\Models\UserMaster;
use Livewire\Component;

class Counter extends Component
{
    public $test;
    public $master;

    public function render()
    {
        return view('livewire.counter');
    }

    public function mount()
    {
        // dd($this->userMaster);
        $this->test = 0;
        // $this->test->fill(['status' => 0]);
    }

    public function setTest()
    {
        $this->test++;
    }

    public function getTest()
    {
        dd($this->test, $this->master);
    }

    // public function setStatus()
    // {
    //     dd($this->userMaster);

    //     $this->userMaster->master->status = 0;
    // }
}
