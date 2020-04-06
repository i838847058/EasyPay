<?php

namespace Shuxian\Pay\Gateways\Wechat;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Shuxian\Pay\Events;
use Shuxian\Pay\Exceptions\GatewayException;
use Shuxian\Pay\Exceptions\InvalidArgumentException;
use Shuxian\Pay\Exceptions\InvalidSignException;

class WapGateway extends Gateway
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
    public function pay($endpoint, array $payload): RedirectResponse
    {
        $payload['trade_type'] = $this->getTradeType();

        Events::dispatch(new Events\PayStarted('Wechat', 'Wap', $endpoint, $payload));

        $mweb_url = $this->preOrder($payload)->get('mweb_url');

        $url = is_null(Support::getInstance()->return_url) ? $mweb_url : $mweb_url.
                        '&redirect_url='.urlencode(Support::getInstance()->return_url);

        return RedirectResponse::create($url);
    }

    /**
     * Get trade type config.
     *
     * @author shuxian <me@shuxian.cn>
     */
    protected function getTradeType(): string
    {
        return 'MWEB';
    }
}
