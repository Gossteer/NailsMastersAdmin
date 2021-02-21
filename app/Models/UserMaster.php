<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model
{
    protected $connection = 'mysqltwo';

    protected $readonly = true;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','login', 'surname', 'lastname', 'phone_number', 'master_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'admin_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y H:i');
    }

    public function master()
    {
        return $this->belongsTo('App\Models\Master');
    }

    public function logger()
    {
        return $this->hasMany('App\Models\LoggerShow', 'user_id');
    }

    // public function admin()
    // {
    //     return $this->hasOne('App\Admin');
    // }

    // public function recording()
    // {
    //     return $this->hasOne('App\Recording');
    // }

    // public function toArray($request)
    // {
    //     return parent::toArray($request);
    // }
}
