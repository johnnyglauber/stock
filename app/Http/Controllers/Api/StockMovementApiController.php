<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateStockPlacementApiRequest;
use App\Http\Requests\Api\CreateStockRemovalApiRequest;
use App\Repositories\StockMovementRepositoryInterface;
use Illuminate\Http\JsonResponse;

class StockMovementApiController extends ApiController
{
    /** @var  StockMovementRepositoryInterface */
    private $stockMovementRepository;

    /**
     * StockMovementApiController constructor.
     *
     * @param StockMovementRepositoryInterface $stockMovementRepository
     * @return void
     */
    public function __construct(StockMovementRepositoryInterface $stockMovementRepository)
    {
        $this->stockMovementRepository = $stockMovementRepository;
    }

    /**
     * Store a newly created Stock Movement in storage.
     * Place product in stock
     * POST /stock-movements/place
     *
     * @param CreateStockPlacementApiRequest $request
     * @return JsonResponse
     */
    public function place(CreateStockPlacementApiRequest $request): JsonResponse
    {
        $stockMovement = $this->stockMovementRepository->create($request->all());
        return $this->sendResponse($stockMovement->toArray(), 'Stock Movement saved successfully. The product amount has been placed in stock.');
    }

    /**
     * Store a newly created Stock Movement in storage.
     * Remove product from stock
     * POST /stock-movements/remove
     *
     * @param CreateStockRemovalApiRequest $request
     * @return JsonResponse
     */
    public function remove(CreateStockRemovalApiRequest $request): JsonResponse
    {
        $stockMovement = $this->stockMovementRepository->create($request->all());

        return $this->sendResponse($stockMovement->toArray(), 'Stock Movement saved successfully. The product amount has been removed from stock.');
    }
}
