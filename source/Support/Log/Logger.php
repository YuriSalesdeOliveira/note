<?php

namespace Source\Support\Log;

use DateTimeZone;
use DateTimeImmutable;
use Source\Support\Log\handler\HandlerInterface;

class Logger implements LoggerInterface
{
    const EMERGENCY = 600;
    const ALERT     = 550;
    const CRITICAL  = 500;
    const ERROR     = 400;
    const WARNING   = 300;
    const NOTICE    = 250;
    const INFO      = 200;
    const DEBUG     = 100;

    protected static $levels = [
        self::DEBUG     => 'DEBUG',
        self::INFO      => 'INFO',
        self::NOTICE    => 'NOTICE',
        self::WARNING   => 'WARNING',
        self::ERROR     => 'ERROR',
        self::CRITICAL  => 'CRITICAL',
        self::ALERT     => 'ALERT',
        self::EMERGENCY => 'EMERGENCY',
    ];

    protected string $channel;

    protected array $handlers;

    protected array $logs;

    protected DateTimeZone $timezone;

    protected $exceptionHandler;

    public function __construct(string $channel, array $handlers = [])
    {
        $this->channel = $channel;
        $this->setHandlers($handlers);
        $this->timezone = new DateTimeZone(date_default_timezone_get() ?: 'AMERICA');
    }

    public function setHandlers(array $handlers): self
    {
        $this->handlers = [];
        foreach (array_reverse($handlers) as $handler)
           $this->pushHandler($handler);
        
        return $this;
            
    }

    public function pushHandler(HandlerInterface $handler): self
    {
        array_unshift($this->handlers, $handler);

        return $this;
    }

    private function addLog(int $level, string $message, array $context = [])
    {
        $log = [
            'level' => $level,
            'level_name' => self::$levels[$level],
            'message' => $message,
            'context' => $context,
            'channel' => $this->channel,
            'date_time' => new DateTimeImmutable(null, $this->timezone),
        ];

        foreach ($this->handlers as $handler) $handler->handle($log);
    }

    public function emergency($message, array $context = [])
    {
        $this->addLog(self::EMERGENCY, $message, $context);
    }
    
    public function alert($message, array $context = [])
    {
        $this->addLog(self::ALERT, $message, $context);
    }
    
    public function critical($message, array $context = [])
    {
        $this->addLog(self::CRITICAL, $message, $context);
    }
    
    public function error($message, array $context = [])
    {
        $this->addLog(self::ERROR, $message, $context);
    }
    
    public function warning($message, array $context = [])
    {
        $this->addLog(self::WARNING, $message, $context);
    }
    
    public function notice($message, array $context = [])
    {
        $this->addLog(self::NOTICE, $message, $context);
    }
    
    public function info($message, array $context = [])
    {
        $this->addLog(self::INFO, $message, $context);
    }
    
    public function debug($message, array $context = [])
    {
        $this->addLog(self::DEBUG, $message, $context);
    }
    
    public function log($level, $message, array $context = []) {}
    


}