<?php
namespace NoraLoggingFake;

use Nora\Kernel\KernelInterface;
use Psr\Log\LoggerInterface;

class Kernel implements KernelInterface
{
    public $logger;
    public $loggableComponent;



    public function __construct(
        LoggerInterface $logger,
        LoggableComponent $loggableComponent
    ) {
        $this->logger = $logger;
        $this->loggableComponent = $loggableComponent;
    }
}
