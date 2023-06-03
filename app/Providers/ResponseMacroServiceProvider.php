<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use function PHPUnit\Framework\isEmpty;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Response::macro('success', function (array $data = [], $status_code = ResponseAlias::HTTP_OK) {
            return Response::json([
                "status" => "success",
                "data" => $data
            ], $status_code);
        });

        Response::macro('error', function (string $message = "", array $errors = [], $status_code = ResponseAlias::HTTP_UNPROCESSABLE_ENTITY) {
            $message = !empty($message) ? $message : ResponseAlias::$statusTexts[$status_code];
            return Response::json([
                "status" => "error",
                "message" => $message,
                "error" => $errors,
            ], $status_code);
        });
    }
}
