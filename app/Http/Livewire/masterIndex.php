<?php

namespace App\Http\Livewire;

use App\Events\Test;
use Livewire\Component;

class Masterindex extends Component
{
    // public $master;
    public $userMaster;
    public $piska;

    protected $listeners = ['echo:channel,Test' => 'render'];

    public function render()
    {
        return view('livewire.masterIndex');
    }

    public function mount()
    {
        $this->piska = 0;
        // $this->userMaster = new UserMaster($this->master);
        // dd($this->userMaster);
    }


    public function setStatus()
    {
        //Когда будет репликация
        // dd($this->userMaster);
        event(new Test());
        $this->userMaster->master->status = $this->userMaster->master->status == 1 ? 0 : 1;
        $this->userMaster->master->save();
    }

    public function testfunc()
    {
        $this->piska = 1;
    }


}
