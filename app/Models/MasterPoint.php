<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MasterPoint extends Model
{
    protected $connection = 'mysqltwo';

    protected $readonly = true;

    protected $fillable = [
        'master_id',
        'name',
        'latitude',
        'longitude',
        'status',
        'description',
        'image',
        'address'
    ];

    protected $table = 'master_points';

    public function master()
    {
        return $this->belongsTo('App\Models\Master');
    }

    public function recordingTime()
    {
        return $this->hasOne('App\Models\RecordingTime');
    }

    public function nailsJobs()
    {
        return $this->hasMany('App\Models\NailsJobs', 'master_point_id', 'id');
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d.m.Y H:i');
    }


    public function getImageAttribute($value)
    {
        return 'http://nailsmasterstest.com.xsph.ru/'.Storage::url($value);
    }
}
