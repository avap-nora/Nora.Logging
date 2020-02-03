<?php
namespace Nora\Logging\Monolog;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\SlackHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Nora\Kernel\AbstractKernelModule;
use Nora\Framework\Plugins\Logger\Provider\MonologLoggerProvider;
use Psr\Log\LoggerInterface;

class MonologModule extends AbstractKernelModule
{
    public function configure()
    {
        $this->bind(LoggerInterface::class)
            ->toProvider(
                MonologProvider::class
            );
    }
}
