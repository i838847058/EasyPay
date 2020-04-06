<?php

namespace Shuxian\Pay\Gateways\Alipay;

use Shuxian\Pay\Contracts\GatewayInterface;
use Shuxian\Pay\Events;
use Shuxian\Pay\Exceptions\GatewayException;
use Shuxian\Pay\Exceptions\InvalidConfigException;
use Shuxian\Pay\Exceptions\InvalidSignException;
use Shuxian\Supports\Collection;

class TransferGateway implements GatewayInterface
{
    /**
     * Pay an order.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @param string $endpoint
     *
     * @throws GatewayException
     * @throws InvalidConfigException
     * @throws InvalidSignException
     */
    public function pay($endpoint, array $payload): Collection
    {
        $payload['method'] = 'alipay.fund.trans.uni.transfer';
        $payload['sign'] = Support::generateSign($payload);

        Events::dispatch(new Events\PayStarted('Alipay', 'Transfer', $endpoint, $payload));

        return Support::requestApi($payload);
    }

    /**
     * Find.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @param $order
     */
    public function find($order): array
    {
        return [
            'method' => 'alipay.fund.trans.order.query',
            'biz_content' => json_encode(is_array($order) ? $order : ['out_biz_no' => $order]),
        ];
    }
}
