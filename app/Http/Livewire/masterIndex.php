<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Masterindex extends Component
{
    // public $master;
    public $userMaster;

    public function render()
    {
        return view('livewire.masterIndex');
    }

    public function mount()
    {
        // $this->userMaster = new UserMaster($this->master);
        // dd($this->userMaster);
    }


    public function setStatus()
    {
        //Когда будет репликация
        // dd($this->userMaster);
        $this->userMaster->master->status = $this->userMaster->master->status == 1 ? 0 : 1;
        $this->userMaster->master->save();
    }
}
