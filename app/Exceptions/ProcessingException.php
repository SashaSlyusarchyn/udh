<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ProcessingException extends Exception
{
    protected $error_code;
    protected $details = [];


    public function __construct($error_code = 0, $message = '', $details = [], $code = 0, Throwable $previous = null)
    {
        $this->error_code = $error_code;
        $this->details = $details;
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json([
            'data' => null,
            'isError' => true,
            'errors' => [
                [
                    'code' => $this->error_code,
                    'message' => $this->getMessage(),
                    'details' => $this->details
                ]
            ]
        ], $this->code);
    }
}
