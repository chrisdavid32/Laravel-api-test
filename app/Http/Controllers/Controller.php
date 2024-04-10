<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function successResponse(mixed $data, string $message, int $code = 200) : JsonResponse
    {
        return response()->json(
            [
                "statusCode" => $code,
                "status" => "success",
                "message" => $message,
                "data" => $data
            ],
            $code
        );

    }
}
