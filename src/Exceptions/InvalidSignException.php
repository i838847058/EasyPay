<?php

namespace Shuxian\Pay\Exceptions;

class InvalidSignException extends Exception
{
    /**
     * Bootstrap.
     *
     * @author shuxian <me@yansonga.cn>
     *
     * @param string       $message
     * @param array|string $raw
     */
    public function __construct($message, $raw = [])
    {
        parent::__construct('INVALID_SIGN: '.$message, $raw, self::INVALID_SIGN);
    }
}
