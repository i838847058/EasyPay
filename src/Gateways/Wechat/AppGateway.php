<?php

namespace Shuxian\Pay\Gateways\Wechat;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Shuxian\Pay\Events;
use Shuxian\Pay\Exceptions\GatewayException;
use Shuxian\Pay\Exceptions\InvalidArgumentException;
use Shuxian\Pay\Exceptions\InvalidSignException;
use Shuxian\Pay\Gateways\Wechat;
use Shuxian\Supports\Str;

class AppGateway extends Gateway
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
     * @throws Exception
     */
    public function pay($endpoint, array $payload): Response
    {
        $payload['appid'] = Support::getInstance()->appid;
        $payload['trade_type'] = $this->getTradeType();

        if (Wechat::MODE_SERVICE === $this->mode) {
            $payload['sub_appid'] = Support::getInstance()->sub_appid;
        }

        $pay_request = [
            'appid' => Wechat::MODE_SERVICE === $this->mode ? $payload['sub_appid'] : $payload['appid'],
            'partnerid' => Wechat::MODE_SERVICE === $this->mode ? $payload['sub_mch_id'] : $payload['mch_id'],
            'prepayid' => $this->preOrder($payload)->get('prepay_id'),
            'timestamp' => strval(time()),
            'noncestr' => Str::random(),
            'package' => 'Sign=WXPay',
        ];
        $pay_request['sign'] = Support::generateSign($pay_request);

        Events::dispatch(new Events\PayStarted('Wechat', 'App', $endpoint, $pay_request));

        return JsonResponse::create($pay_request);
    }

    /**
     * Get trade type config.
     *
     * @author shuxian <me@shuxian.cn>
     */
    protected function getTradeType(): string
    {
        return 'APP';
    }
}