<?php
declare(strict_types=1);

namespace Nora\Logging;

use PHPUnit\Framework\TestCase;

class LoggingTest extends TestCase
{
    public function testIsTrue()
    {
        $this->assertInstanceOf(Logging::class, new Logging());
    }
}
