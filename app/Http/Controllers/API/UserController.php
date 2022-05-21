<?php

namespace App\Http\Controllers\API;

use App\AccessValidators\WebsiteAccessValidator;
use App\Enums\CommonEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Website;
use App\Services\UtilService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @param User $user
     * @param Website $website
     * @param WebsiteAccessValidator $websiteAccessValidator
     * @param UtilService $utilService
     * @return JsonResponse
     */
    public function subscribeToWebsite(
        User $user,
        Website $website,
        WebsiteAccessValidator $websiteAccessValidator,
        UtilService $utilService
    ): JsonResponse {
        try {
            if ($websiteAccessValidator->isUserAlreadySubscribedToWebsite($user, $website)) {
                return $utilService->responseWithAccessDenied(trans('You are already subscribed to the website'));
            }

            //Add user to give website subscription list
            $user->websites()->syncWithoutDetaching([$website->id]);

            return $utilService->makeResponse(
                Response::HTTP_CREATED,
                trans('User has been successfully subscribed to the website'),
                null,
                CommonEnum::RESPONSE_TYPE_SUCCESS
            );
        } catch (\Exception $exception) {
            Log::error('["user-subscribed-to-website-api-error"]: '. $exception->getMessage());
            return $utilService->responseWithException($exception);
        }
    }
}
