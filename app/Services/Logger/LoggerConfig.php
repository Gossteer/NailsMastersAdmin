<?php

namespace App\Services\Logger;

class LoggerConfig implements iLoggerConfig
{
    private $type_id_config;

    public function __construct(array $config)
    {
        $this->type_id_config = $config;
    }

    public function getTypeConfig(int $type_id) : string
    {
        return $this->type_id_config[$type_id];
    }
}
