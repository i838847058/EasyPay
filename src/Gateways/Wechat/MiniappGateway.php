<?php

namespace Shuxian\Pay\Gateways\Wechat;

use Shuxian\Pay\Exceptions\GatewayException;
use Shuxian\Pay\Exceptions\InvalidArgumentException;
use Shuxian\Pay\Exceptions\InvalidSignException;
use Shuxian\Pay\Gateways\Wechat;
use Shuxian\Supports\Collection;

class MiniappGateway extends MpGateway
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
        $payload['appid'] = Support::getInstance()->miniapp_id;

        if (Wechat::MODE_SERVICE === $this->mode) {
            $payload['sub_appid'] = Support::getInstance()->sub_miniapp_id;
            $this->payRequestUseSubAppId = true;
        }

        return parent::pay($endpoint, $payload);
    }
}
