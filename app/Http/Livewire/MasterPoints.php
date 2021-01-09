<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MasterPoints extends Component
{
    public $MasterPointView;

    public function render()
    {
        return view('livewire.master-points');
    }

    public function setStatus()
    {
        //Когда будет репликация
        // dd($this->userMaster);
        $this->MasterPointView->status = $this->userMaster->master->status == 1 ? 0 : 1;
        $this->MasterPointView->status->save();
    }
}
