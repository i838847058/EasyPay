<?php

namespace Shuxian\Pay\Gateways\Wechat;

use Shuxian\Pay\Exceptions\InvalidArgumentException;

class RefundGateway extends Gateway
{
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
            'endpoint' => 'pay/refundquery',
            'order' => is_array($order) ? $order : ['out_trade_no' => $order],
            'cert' => false,
        ];
    }

    /**
     * Pay an order.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @param string $endpoint
     *
     * @throws InvalidArgumentException
     */
    public function pay($endpoint, array $payload)
    {
        throw new InvalidArgumentException('Not Support Refund In Pay');
    }

    /**
     * Get trade type config.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @throws InvalidArgumentException
     */
    protected function getTradeType()
    {
        throw new InvalidArgumentException('Not Support Refund In Pay');
    }
}
