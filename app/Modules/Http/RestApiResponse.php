<?php

namespace App\Modules\Http;

trait RestApiResponse
{
    protected array $response = [
        'status' => 'ERROR',
        'data' => null,
        'message' => null,
        'errors' => null
    ];
}
