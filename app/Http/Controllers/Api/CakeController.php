<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CakeResource;
use App\Services\CakeService\CakeServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CakeController extends Controller
{
    /**
     * @var CakeServiceContract
     */
    protected $cakeService;

    /**
     * @param CakeServiceContract $cakeService
     */
    public function __construct(CakeServiceContract $cakeService)
    {
        $this->cakeService = $cakeService;
    }

    /**
     * @OA\Get(
     *     tags={"Cakes"},
     *     path="/api/v1/cakes",
     *     summary="List of cakes",
     *     description="Return a list of cakes",
     *     @OA\Response(response="200", description="An json"),
     *      security={
     *           {"apiKey": {}}
     *       }
     * )
     * @return JsonResponse|object
     */
    public function index()
    {
        try {
            return CakeResource::collection($this->cakeService->getCakes())
                ->response()
                ->setStatusCode(ResponseAlias::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @OA\Post(
     *      tags={"Cakes"},
     *      path="/api/v1/machines",
     *      summary="Store a cake",
     *      description="Return a cake",
     *      @OA\Parameter(
     *          name="name",
     *          description="Name field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="weight",
     *          description="Weight",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="value",
     *          description="Value",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="quantity",
     *          description="Quantity",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Store cake"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     * @param Request $request
     * @return JsonResponse|object
     */
    public function store(Request $request)
    {
        try {
            return (new CakeResource($this->cakeService->storeCake($request->all())))
                ->response()
                ->setStatusCode(ResponseAlias::HTTP_CREATED);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @OA\Get(
     *     tags={"Cakes"},
     *     path="/api/v1/cakes/{id}",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of cake",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Show a cake",
     *     description="Return a cake",
     *     @OA\Response(response="200", description="An json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
     * @param $id
     * @return JsonResponse|object
     */
    public function show($id)
    {
        try {
            return (new CakeResource($this->cakeService->getCake($id)))
                ->response()
                ->setStatusCode(ResponseAlias::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @OA\Put(
     *      tags={"Cakes"},
     *      path="/api/v1/cakes/{id}",
     *      summary="Update a cake",
     *      description="Update a cake",
     *      @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of cake to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="Name field",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="weight",
     *          description="Weight",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="value",
     *          description="Value",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="float"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="quantity",
     *          description="Quantity",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(response="200", description="Update cake"),
     *      security={
     *           {"apiKey": {}}
     *      }
     * )
     * @param Request $request
     * @param $id
     * @return JsonResponse|object
     */
    public function update(Request $request, $id)
    {
        try {
            return (new CakeResource($this->cakeService->updateCake($request->all(), $id)))
                ->response()
                ->setStatusCode(ResponseAlias::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @OA\Delete(
     *     tags={"Cakes"},
     *     path="/api/v1/cakes/{id}",
     *     @OA\Parameter(
     *          name ="id",
     *          in = "path",
     *          description = "ID of cake to return",
     *          required = true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     summary="Delete a cake",
     *     description="Delete a cake",
     *     @OA\Response(response="200", description="An json"),
     *     security={
     *           {"apiKey": {}}
     *     }
     * )
     * @param $id
     * @return JsonResponse|object
     */
    public function destroy($id)
    {
        try {
            return response()->json($this->cakeService->deleteCake($id), ResponseAlias::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }
}
