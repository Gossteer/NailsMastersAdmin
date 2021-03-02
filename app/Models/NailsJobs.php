<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class NailsJobs extends Model
{
    protected $connection = 'mysqltwo';

    protected $readonly = true;

    protected $fillable = [
        'price',
        'image',
        'description',
        'category_nail_id',
        'master_point_id',
        'description',
        'logical_delet',
        'name',
        'status',
        'instagram'
    ];

    protected $table = 'nails_jobs';


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d.m.Y H:i');
    }

    public function recording()
    {
        return $this->hasMany('App\Models\Recording', 'nails_job_id');
    }

    public function masterPoint()
    {
        return $this->belongsTo('App\Models\MasterPoint', 'master_point_id');
    }

    public function categoryNails()
    {
        return $this->belongsTo('App\Models\CategoryNails');
    }

    public function logger()
    {
        return $this->hasMany('App\Models\LoggerShow');
    }

    public function getImageAttribute($value)
    {

        return 'http://nailsmasterstest.com.xsph.ru'.Storage::url($value);

    }

}
