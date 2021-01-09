<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recording extends Model
{
    // protected $fillable = [

    // ];
    protected $connection = 'mysqltwo';

    protected $readonly = true;

    public function nailsJobs()
    {
        return $this->belongsTo('App\Models\NailsJobs', 'nails_job_id');
    }

    public function recordingTime()
    {
        return $this->belongsTo('App\Models\RecordingTime');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\UserMaster');
    }
}
