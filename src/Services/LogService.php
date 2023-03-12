<?php

namespace App\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;

class LogService
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function Log($error){

        if (isset($error)){
            $this->logger->info('user no sign in', [$error, $_SERVER['REMOTE_ADDR']]);
        }else{
            $this->logger->info('user sign in', [$_SERVER['REMOTE_ADDR']]);
        }
    }

}