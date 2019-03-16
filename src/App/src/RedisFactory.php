<?php
/**
 * Created by PhpStorm.
 * User: teerarat
 * Date: 2019-03-17
 * Time: 01:09
 */

namespace App;


use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class RedisFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $redis = new \Redis();
        $redis->connect($container->get("config")["redis"]["host"]);
        return $redis;
    }

}