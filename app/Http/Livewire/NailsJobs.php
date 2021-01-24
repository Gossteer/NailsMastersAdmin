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
        $this->NailsJobsView->status = $this->NailsJobsView->status == 1 ? 0 : 1;
        $this->NailsJobsView->save();
    }

    public function deleteNailsJobs()
    {
        //Когда будет репликация
        // dd($this->userMaster);
        // $this->NailsJobsView->status = $this->NailsJobsView->status == 1 ? 0 : 1;
        $this->NailsJobsView->delete();
    }
}
