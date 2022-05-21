<?php

namespace App\Http\Controllers\API;

use App\Enums\CommonEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\StoreRequest;
use App\Http\Resources\PostsResource;
use App\Models\Post;
use App\Models\Website;
use App\Services\PostService;
use App\Services\UtilService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * @param Website $website
     * @param StoreRequest $request
     * @param PostService $postService
     * @param UtilService $utilService
     * @return JsonResponse
     */
    public function store(Website $website, StoreRequest $request, PostService $postService, UtilService $utilService): JsonResponse
    {
        try {
            $data = $request->validated();

            $post = Post::create([
                'website_id' => $website->id,
                'title' => $data['title'],
                'description' => $data['description']
            ]);

            $postService->publishPost($post);

            return $utilService->makeResponse(
                Response::HTTP_CREATED,
                trans('Post has been created successfully'),
                PostsResource::make($post),
                CommonEnum::RESPONSE_TYPE_SUCCESS
            );
        } catch (\Exception $exception) {
            Log::error('["post-store-api-error"]: '. $exception->getMessage());
            return $utilService->responseWithException($exception);
        }
    }
}
