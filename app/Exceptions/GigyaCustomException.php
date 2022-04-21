<?php
namespace AKCBark\Exceptions;

use Exception;
use \Illuminate\Support\Facades\Log;

class GigyaCustomException extends Exception
{
    protected $message;

    public function __construct(
        $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        $this->message = $message;
        $this->log();
    }

    private function log()
    {
        Log::error($this->message);
    }
}
