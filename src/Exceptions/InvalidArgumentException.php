<?php

namespace Shuxian\Pay\Exceptions;

class InvalidArgumentException extends Exception
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
        parent::__construct('INVALID_ARGUMENT: '.$message, $raw, self::INVALID_ARGUMENT);
    }
}
