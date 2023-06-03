<?php


use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

function response_ok(mixed $data = [], string $message = "", $status_code = Response::HTTP_OK): JsonResponse
{
    return new JsonResponse([
        'status'  => 'Success',
        'message' => (!empty($message) ? $message : Response::$statusTexts[$status_code]),
        'data'    => $data,
    ], $status_code);
}

function response_error(array $errors = [] , string $message = "", $status_code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
{
    return new JsonResponse([
        "status" => "Error",
        "message" => (!empty($message) ? $message : Response::$statusTexts[$status_code]),
        "error" => $errors,
    ], $status_code);
}
