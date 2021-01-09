<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NailsJobs extends Component
{
    public $NailsJobsView;

    public function render()
    {
        return view('livewire.nails-jobs');
    }

    public function setStatus()
    {
        //Когда будет репликация
        // dd($this->userMaster);
        $this->NailsJobsView->status = $this->userMaster->master->status == 1 ? 0 : 1;
        $this->NailsJobsView->status->save();
    }
}
