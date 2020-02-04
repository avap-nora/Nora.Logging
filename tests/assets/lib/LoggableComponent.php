<?php
namespace NoraLoggingFake;

use Nora\Kernel\KernelInterface;
use Nora\Logging\LoggerTrait;
use Psr\Log\LoggerInterface;

class LoggableComponent
{
    use LoggerTrait;
}
