<?php
namespace NoraLoggingFake;

use Nora\Kernel\KernelInterface;
use Psr\Log\LoggerInterface;

class Kernel implements KernelInterface
{
    public $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }
}
