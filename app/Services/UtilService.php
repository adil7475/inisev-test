<?php

namespace App\Services;

use App\Enums\CommonEnum;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UtilService
{
    /**
     * @param $statusCode
     * @param null $message
     * @param null $data
     * @param string $type
     * @return JsonResponse
     */
    public function makeResponse($statusCode, $message = null, $data = null, string $type = CommonEnum::RESPONSE_TYPE_ERROR): JsonResponse
    {
        $response['data'] = $data;
        $response['code'] = $statusCode;
        $response['message'] = $message;
        $response['status'] = $type;
        return new JsonResponse($response, $statusCode);
    }

    /**
     * @param \Exception $exception
     * @return JsonResponse
     */
    public function responseWithException(\Exception $exception): JsonResponse
    {
        if (app()->environment('local')) {
            return $this->makeResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $exception->getMessage(),
                ['trace' => $exception->getTraceAsString()]
            );
        }

        return $this->makeResponse(Response::HTTP_INTERNAL_SERVER_ERROR, CommonEnum::EXCEPTION_ERROR_MESSAGE);
    }

    /**
     * @param string $message
     * @return JsonResponse
     */
    public function responseWithAccessDenied(string $message = CommonEnum::ACCESS_DENIED_MESSAGE): JsonResponse
    {
        return $this->makeResponse(Response::HTTP_FORBIDDEN, $message);
    }
}
