<?php

declare(strict_types=1);

namespace App\Handler;

use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use Zend\Diactoros\Response\JsonResponse;

use function time;

class PingHandler implements RequestHandlerInterface
{
    /** @var \Redis  */
    protected $redis;

    /** @var LoggerInterface  */
    protected $logger;

    /**
     * PingHandler constructor.
     * @param \Redis $redis
     */
    public function __construct(\Redis $redis,LoggerInterface $logger)
    {
        $this->redis = $redis;
        $this->logger = $logger;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $this->logger->info("Ping called");
        return new JsonResponse($this->redis->info());
    }
}
