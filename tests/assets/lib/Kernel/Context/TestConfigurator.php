<?php
namespace NoraLoggingFake\Kernel\Context;

use Monolog\ErrorHandler;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\SlackHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Nora\Framework\Kernel\AbstractKernelConfigurator;
use Nora\Logging\Monolog\MonologConfigurator;

class TestConfigurator extends AbstractKernelConfigurator
{
    public function configure()
    {
        $this->configureLogging();
    }

    private function configureLogging()
    {
        // ---------------------------------------
        // ロギング設定
        // ---------------------------------------

        // WARNING以上のログはtest.logへ
        $appHandler = new StreamHandler(
            $this->meta->logDir . '/app.log',
            Logger::WARNING
        );
        // DEBUG以上のログはdebug.logへ
        $debugHandler = new StreamHandler(
            $this->meta->logDir . '/debug.log',
            Logger::DEBUG
        );
        // 標準出力へのエラー
        $stdoutHandler = new StreamHandler(
            'php://stdout',
            Logger::DEBUG
        );

        // スラックへのロガー
        $slackHandler = new SlackHandler(
            getenv('SLACK_TOKEN'), // Slackトークン
            getenv('SLACK_ROOM'), // 送信先チャンネル
            null, // 送信ユーザ名
            true, // 添付形式にする
            null, // 送信ユーザアイコン
            Logger::ERROR, // ログ通知レベル
            true, // use bubble
            true, // $use_short_attachment 
            true, // $use_context_and_extra
        );

        $phpChannel = new Logger('PHP');
        $formatter = new LineFormatter();
        $formatter->includeStacktraces(true);
        $stdoutHandler->setFormatter($formatter);
        $phpChannel->pushHandler($stdoutHandler);
        $phpChannel->pushHandler($appHandler);

        // PHP Error Handlerに登録する
        $errorHandler = new ErrorHandler($phpChannel);
        $errorHandler->registerExceptionHandler();
        $errorHandler->registerErrorHandler();
        $errorHandler->registerFatalHandler();


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

        // モノログを導入
        $this->install(new MonologConfigurator($this->meta));
    }
}

