<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Master extends Model
{
    use HasFactory;

    protected $connection = 'mysqltwo';

    protected $readonly = true;

    protected $fillable = [
        'portfolio_id', 'status', 'image'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d.m.Y H:i');
    }

    public function user()
    {
        return $this->hasOne('App\Models\UserMaster');
    }

    public function portfolio()
    {
        return $this->belongsTo('App\Models\Portfolio');
    }

    public function masterPoint()
    {
        return $this->hasMany('App\Models\MasterPoint');
    }

    public function getImageAttribute($value)
    {
        return 'https://nailsmasters.gossteer.ru'.Storage::url($value);
    }
}
