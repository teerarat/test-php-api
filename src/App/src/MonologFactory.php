<?php
/**
 * Created by PhpStorm.
 * User: teerarat
 * Date: 2019-03-17
 * Time: 02:03
 */

namespace App;


use Interop\Container\ContainerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Zend\ServiceManager\Factory\FactoryInterface;

class MonologFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Logger|object
     * @throws \Exception
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get("config")["monolog"];
        if(isset($config["stream"]) && $config["stream"] == "hostname")
            $streamHandler = new StreamHandler(__DIR__."/../../../data/".$config["hostname"]);
        else
            $streamHandler = new StreamHandler('php://stdout');

        $monolog = new Logger($config["name"]);
        $monolog->pushHandler($streamHandler);

        $monolog->info("Monolog init.");
        return $monolog;
    }
}