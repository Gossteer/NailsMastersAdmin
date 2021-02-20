<?php

namespace App\Services\Logger;

interface iLoggerConfig
{
    public function getTypeConfig(int $type_id) : string;
}
