<?php
namespace Nora\Logging\Monolog;

use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Handler\SlackHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Nora\Framework\Kernel\AbstractKernelConfigurator;
use Nora\Framework\Plugins\Logger\Provider\MonologLoggerProvider;
use Psr\Log\LoggerInterface;

class MonologConfigurator extends AbstractKernelConfigurator
{
    public function configure()
    {
        $this->bind(LoggerInterface::class)
            ->toProvider(
                MonologLoggerProvider::class
            );
    }
}
