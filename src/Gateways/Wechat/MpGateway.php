<?php

namespace Shuxian\Pay\Gateways\Wechat;

use Exception;
use Shuxian\Pay\Events;
use Shuxian\Pay\Exceptions\GatewayException;
use Shuxian\Pay\Exceptions\InvalidArgumentException;
use Shuxian\Pay\Exceptions\InvalidSignException;
use Shuxian\Supports\Collection;
use Shuxian\Supports\Str;

class MpGateway extends Gateway
{
    /**
     * @var bool
     */
    protected $payRequestUseSubAppId = false;

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
     * @throws Exception
     */
    public function pay($endpoint, array $payload): Collection
    {
        $payload['trade_type'] = $this->getTradeType();

        $pay_request = [
            'appId' => !$this->payRequestUseSubAppId ? $payload['appid'] : $payload['sub_appid'],
            'timeStamp' => strval(time()),
            'nonceStr' => Str::random(),
            'package' => 'prepay_id='.$this->preOrder($payload)->get('prepay_id'),
            'signType' => 'MD5',
        ];
        $pay_request['paySign'] = Support::generateSign($pay_request);

        Events::dispatch(new Events\PayStarted('Wechat', 'JSAPI', $endpoint, $pay_request));

        return new Collection($pay_request);
    }

    /**
     * Get trade type config.
     *
     * @author shuxian <me@shuxian.cn>
     */
    protected function getTradeType(): string
    {
        return 'JSAPI';
    }
}
