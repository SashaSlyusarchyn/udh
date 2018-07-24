<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class JwtAuthFailedException extends Exception
{
    protected $error_code;

    protected $type_code;

    public function __construct($message = "", $error_code = 0, $type_code = 0, $code = 0, Throwable $previous = null)
    {
        $this->error_code = $error_code;
        $this->type_code = $type_code;
        parent::__construct($message, $code, $previous);
    }

    public function render($request)
    {
        return response()->json([
            'isError' => true,
            'errors' => [
                'code' => $this->error_code,
                'type' => $this->type_code,
                'description' => $this->getMessage()
            ]
        ],$this->code);
    }
}
