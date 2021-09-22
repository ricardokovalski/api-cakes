<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubscribeResource;
use App\Services\SubscribeService\SubscribeServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SubscribeController extends Controller
{
    protected $subscribeService;

    public function __construct(SubscribeServiceContract $subscribeService)
    {
        $this->subscribeService = $subscribeService;
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse|object
     */
    public function subscribe(Request $request, $id)
    {
        try {

            $subscribe = $this->subscribeService->subscribe($request->all(), $id);

            return (new SubscribeResource($subscribe))
                ->response()
                ->setStatusCode(ResponseAlias::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }
}
