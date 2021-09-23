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
     * @OA\Post(
     *     tags={"Interested"},
     *     path="/api/v1/cakes/{id}/subscribe",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of cake to subscribe",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          name="name",
     *          description="Name a customer",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="email",
     *          description="Email a customer",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     summary="Subscribe a customer in cake",
     *     description="Subscribe a customer in cake",
     *     @OA\Response(response="200", description="An json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
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
