<?php

namespace App\Models;

use App\Services\Logger\iLoggerConfig;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class LoggerShow extends Model
{
    protected $connection = 'mysqltwo';

    protected $readonly = true;

    protected $table = 'loggers';

    protected $fillable = [
        'type_id',
        'message',
        'user_id',
        'nails_jobs_id',
    ];

    // private $type_id_config;

    // public function __construct()
    // {
    //     $this->type_id_config = config('logger.type_id');
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\UserMaster');
    }

    public function nailsJobs()
    {
        return $this->belongsTo('App\Models\NailsJobs');
    }

    public function getTypeAttribute()
    {
        return App::make(iLoggerConfig::class)->getTypeConfig((int) $this->type_id);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d.m.Y H:i');
    }
}
