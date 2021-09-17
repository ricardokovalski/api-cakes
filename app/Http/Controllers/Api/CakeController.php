<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CakeResource;
use App\Services\CakeService\CakeServiceContract;
use Exception;
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

    public function index()
    {
        try {
            return (new CakeResource($this->cakeService->getCakes()))
                ->response()
                ->setStatusCode(ResponseAlias::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], ResponseAlias::HTTP_BAD_REQUEST);
        }
    }

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

    public function destroy($id): \Illuminate\Http\JsonResponse
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
