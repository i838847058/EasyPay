<?php

namespace Shuxian\Pay\Gateways\Wechat;

use Symfony\Component\HttpFoundation\Request;
use Shuxian\Pay\Events;
use Shuxian\Pay\Exceptions\GatewayException;
use Shuxian\Pay\Exceptions\InvalidArgumentException;
use Shuxian\Pay\Exceptions\InvalidSignException;
use Shuxian\Supports\Collection;

class ScanGateway extends Gateway
{
    /**
     * Pay an order.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @param string $endpoint
     *
     * @throws GatewayException
     * @throws InvalidArgumentException
     * @throws InvalidSignException
     */
    public function pay($endpoint, array $payload): Collection
    {
        $payload['spbill_create_ip'] = Request::createFromGlobals()->server->get('SERVER_ADDR');
        $payload['trade_type'] = $this->getTradeType();

        Events::dispatch(new Events\PayStarted('Wechat', 'Scan', $endpoint, $payload));

        return $this->preOrder($payload);
    }

    /**
     * Get trade type config.
     *
     * @author shuxian <me@shuxian.cn>
     */
    protected function getTradeType(): string
    {
        return 'NATIVE';
    }
}
