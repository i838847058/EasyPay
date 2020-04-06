<?php

namespace Shuxian\Pay\Gateways\Wechat;

use Shuxian\Pay\Events;
use Shuxian\Pay\Exceptions\GatewayException;
use Shuxian\Pay\Exceptions\InvalidArgumentException;
use Shuxian\Pay\Exceptions\InvalidSignException;
use Shuxian\Supports\Collection;

class PosGateway extends Gateway
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
        unset($payload['trade_type'], $payload['notify_url']);

        $payload['sign'] = Support::generateSign($payload);

        Events::dispatch(new Events\PayStarted('Wechat', 'Pos', $endpoint, $payload));

        return Support::requestApi('pay/micropay', $payload);
    }

    /**
     * Get trade type config.
     *
     * @author shuxian <me@shuxian.cn>
     */
    protected function getTradeType(): string
    {
        return 'MICROPAY';
    }
}
