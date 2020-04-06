<?php

namespace Shuxian\Pay\Exceptions;

class GatewayException extends Exception
{
    /**
     * Bootstrap.
     *
     * @author shuxian <me@yansonga.cn>
     *
     * @param string       $message
     * @param array|string $raw
     * @param int          $code
     */
    public function __construct($message, $raw = [], $code = self::ERROR_GATEWAY)
    {
        parent::__construct('ERROR_GATEWAY: '.$message, $raw, $code);
    }
}
