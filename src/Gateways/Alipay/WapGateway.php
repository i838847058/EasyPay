<?php

namespace Shuxian\Pay\Gateways\Alipay;

class WapGateway extends WebGateway
{
    /**
     * Get method config.
     *
     * @author shuxian <me@shuxian.cn>
     */
    protected function getMethod(): string
    {
        return 'alipay.trade.wap.pay';
    }

    /**
     * Get productCode config.
     *
     * @author shuxian <me@shuxian.cn>
     */
    protected function getProductCode(): string
    {
        return 'QUICK_WAP_WAY';
    }
}
