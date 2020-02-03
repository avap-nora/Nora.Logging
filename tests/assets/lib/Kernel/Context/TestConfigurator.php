<?php
namespace NoraLoggingFake\Kernel\Context;

use Monolog\Handler\SlackHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Nora\Framework\Kernel\AbstractKernelConfigurator;
use Nora\Logging\Monolog\MonologConfigurator;

class TestConfigurator extends AbstractKernelConfigurator
{
    public function configure()
    {
        // ロギング設定
        // ---------------------------------------
        $appHandler = new StreamHandler(
            $this->meta->logDir . '/test.log',
            Logger::WARNING
        );
        $debugHandler = new StreamHandler(
            $this->meta->logDir . '/debug.log',
            Logger::DEBUG
        );

        $slackHandler = new SlackHandler(
            $token = getenv('SLACK_TOKEN'),
            $channel = getenv('SLACK_ROOM'),
            $name = null,
            $use_attachment = true,
            $icon_emoji = null,
            $over_notification_log_level = Logger::INFO,
            $use_bubble = true,
            $use_short_attachment = true,
            $use_context_and_extra = true
        );


        $this->bind()
            ->annotatedWith('logger_config')
            ->toInstance(
                [
                 'handlers' => [
                     $appHandler,
                     $debugHandler,
                    $slackHandler
                 ]
                ]
            );
        $this->install(new MonologConfigurator($this->meta));
    }
}

