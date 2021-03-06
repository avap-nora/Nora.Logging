<?php
namespace Nora\Logging\Monolog;

use Monolog\Logger;
use Nora\Architecture\DI\Annotation\Named;
use Nora\Architecture\DI\Dependency\ProviderInterface;
use Nora\Architecture\DI\Injector\InjectionPoint;
use Nora\Architecture\DI\Injector\InjectionPointInterface;
use Nora\Kernel\KernelMeta;
use Psr\Log\LoggerInterface;
use Nora\Architecture\DI\Configuration\AbstractConfigurator;
use ReflectionClass;

class MonologProvider implements ProviderInterface
{
    private $ip;
    private $meta;

    /**
     * @Named("config=logger_config")
     */
    public function __construct(
        InjectionPointInterface $ip,
        KernelMeta $meta,
        array $config
    ) {
        $this->ip = $ip;
        $this->meta = $meta;
        $this->name = $ip->getClass()->name;
        $this->handlers = $config['handlers'];
    }

    public function get()
    {
        $logger = new Logger($this->name);
        foreach ($this->handlers as $handler) {
            $logger->pushHandler($handler);
        }
        $logger->pushProcessor([$this, 'logProcess']);
        return $logger;
    }

    /**
     * ログ情報に追加情報を埋め込む処理
     */
    public function logProcess($record)
    {
        $record['context']['name'] = $this->meta->context;
        $record['extra']['project'] = $this->ip->getClass()->getFileName();
        return $record;
    }
}
