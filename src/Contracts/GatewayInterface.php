<?php

namespace Shuxian\Pay\Contracts;

use Symfony\Component\HttpFoundation\Response;
use Shuxian\Supports\Collection;

interface GatewayInterface
{
    /**
     * Pay an order.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @param string $endpoint
     *
     * @return Collection|Response
     */
    public function pay($endpoint, array $payload);
}
