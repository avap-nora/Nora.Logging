<?php
namespace NoraLoggingFake\Kernel;

use Nora\Framework\Kernel\KernelInterface;
use Nora\Utility\Globals\Globals;
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
