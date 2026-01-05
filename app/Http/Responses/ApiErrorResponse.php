<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Log;

final class ApiErrorResponse implements Responsable
{
    public function __construct(
        private string $message,
        private \Throwable $exception,
        private int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR,
        private array $headers = [],
        private int $options = 0
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        $response = ["message" => $this->message];

        $statusCode = $this->exception->getCode();

        if (!is_int($statusCode) || $statusCode < 100 || $statusCode > 599) {
            $statusCode = $this->statusCode;
        }

        if (!is_null($this->exception) && config('app.debug')) {
            $response['debug'] = [
                'message' => $this->exception->getMessage(),
                'file'    => $this->exception->getFile(),
                'line'    => $this->exception->getLine(),
                'trace'   => $this->exception->getTraceAsString()
            ];
        }

        return response()->json(
            $response,
            $statusCode,
            $this->headers,
            $this->options
        );
    }
}
