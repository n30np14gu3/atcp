<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Throwable;
class InvalidRequestArgsException extends Exception
{
    protected $code = 422;
    private array $response;

    public function __construct(array $response, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    public function render(): JsonResponse
    {
        return response()->json($this->response, $this->code);
    }
}
