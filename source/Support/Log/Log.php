<?php

namespace Source\Support\Log;

use Source\Support\Log\Logger;

class Log
{
    private array $channels;
    private array $logger_config;

    public function __construct(string $path_directory)
    {
        if (file_exists($path_directory . '/logger.php'))
            $this->logger_config = include_once($path_directory . '/logger.php');

        $this->setChannels();
    }

    private function setChannels(): void
    {
        $channels = $this->logger_config['channels'];

        foreach (array_keys($channels) as $channel) {
            
            $logger = new Logger($channel);

            $channel_config = $this->logger_config['channels'][$channel];

            $logger = $this->setHandlers($logger, $channel_config);

            $this->channels[$channel] = $logger;
        }

    }

    private function setHandlers(Logger $logger, array $channel_config): Logger
    {
        if (isset($channel_config['handlers'])) {

            foreach ($channel_config['handlers'] as $handler => $level) {

                if (is_object($level)) {
                    
                    $handler = $level;

                    $logger->pushHandler($handler);

                    continue;
                }
                
                $logger->pushHandler(new $handler($level));
            }
        }

        return $logger;
    }

    public function channel(string $channel): Logger
    {
        return $this->channels[$channel];
    }
}