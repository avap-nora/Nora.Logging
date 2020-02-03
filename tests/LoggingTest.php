<?php
declare(strict_types=1);

namespace Nora\Logging;

use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Nora\Kernel\Bootstrap;
use NoraLoggingFake\Kernel;

class LoggingTest extends TestCase
{
    /**
     * @test
     */
    public function モジュールの呼び出し()
    {
        $kernel = (new Bootstrap)('NoraLoggingFake', 'app-test');

        $this->assertInstanceOf(Kernel::class, $kernel);
        return $kernel;
    }

    /**
     * @test
     * @depends モジュールの呼び出し
     */
    public function ロガー(Kernel $kernel)
    {
        $this->assertInstanceOf(Logger::class, $kernel->logger);
        $kernel->logger->warning('テスト1');
        $kernel->logger->emergency('テスト2');
        $kernel->logger->alert('テスト3');
        return $kernel;
    }
}
