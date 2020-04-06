<?php

namespace Shuxian\Pay\Contracts;

use Symfony\Component\HttpFoundation\Response;
use Shuxian\Supports\Collection;

interface GatewayApplicationInterface
{
    /**
     * To pay.
     *
     * @author shuxian <me@yansonga.cn>
     *
     * @param string $gateway
     * @param array  $params
     *
     * @return Collection|Response
     */
    public function pay($gateway, $params);

    /**
     * Query an order.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @param string|array $order
     *
     * @return Collection
     */
    public function find($order, string $type);

    /**
     * Refund an order.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @return Collection
     */
    public function refund(array $order);

    /**
     * Cancel an order.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @param string|array $order
     *
     * @return Collection
     */
    public function cancel($order);

    /**
     * Close an order.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @param string|array $order
     *
     * @return Collection
     */
    public function close($order);

    /**
     * Verify a request.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @param string|array|null $content
     *
     * @return Collection
     */
    public function verify($content, bool $refund);

    /**
     * Echo success to server.
     *
     * @author shuxian <me@shuxian.cn>
     *
     * @return Response
     */
    public function success();
}
