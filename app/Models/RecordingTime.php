<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class RecordingTime extends Model
{
    protected $fillable = [
        'time',
        'master_point_id',
    ];

    protected $connection = 'mysqltwo';

    protected $readonly = true;

    public function masterPoint()
    {
        return $this->belongsTo('App\Models\MasterPoint');
    }

    public function recording()
    {
        return $this->hasMany('App\Models\Recording');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i');
    }
}
