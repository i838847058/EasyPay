<?php

namespace Shuxian\Pay\Gateways\Alipay;

use Shuxian\Pay\Contracts\GatewayInterface;
use Shuxian\Pay\Exceptions\InvalidArgumentException;
use Shuxian\Supports\Collection;

abstract class Gateway implements GatewayInterface
{
    /**
     * Mode.
     *
     * @var string
     */
    protected $mode;

    /**
     * Bootstrap.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $this->mode = Support::getInstance()->mode;
    }

    /**
     * Pay an order.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @param string $endpoint
     *
     * @return Collection
     */
    abstract public function pay($endpoint, array $payload);
}
