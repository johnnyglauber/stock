<?php

namespace App\Http\Controllers;

use App\DataTables\StockMovementDataTable;
use App\Http\Requests\CreateStockMovementRequest;
use App\Http\Requests\UpdateStockMovementRequest;
use App\Repositories\StockMovementRepositoryInterface;
use App\Repositories\StockMovementTypeRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Response;

/**
 * Class StockMovementController
 *
 */
class StockMovementController extends Controller
{
    /**
     * @var StockMovementRepositoryInterface
     *
     */
    private $stockMovementRepository;

    /**
     * @var StockMovementTypeRepositoryInterface
     *
     */
    private $stockMovementTypeRepository;

    /**
     * @var ProductRepositoryInterface
     *
     */
    private $productRepository;

    /**
     * StockMovementController constructor.
     *
     * @param StockMovementRepositoryInterface $stockMovementRepository
     * @param StockMovementTypeRepositoryInterface $stockMovementTypeRepository
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function __construct(
        StockMovementRepositoryInterface $stockMovementRepository,
        StockMovementTypeRepositoryInterface $stockMovementTypeRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->middleware('auth');
        $this->stockMovementRepository = $stockMovementRepository;
        $this->stockMovementTypeRepository = $stockMovementTypeRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a list of the Stock Movement.
     *
     * @param StockMovementDataTable $stockMovementDataTable
     * @return View|Response|JsonResponse
     */
    public function index(StockMovementDataTable $stockMovementDataTable)
    {
        return $stockMovementDataTable->render('stock_movements.index');
    }

    /**
     * Show the form for creating a new Stock Movement.
     *
     * @param null|integer $stockMovementTypeId
     * @param null|integer $productId
     * @return Renderable
     */
    public function create($stockMovementTypeId = null, $productId = null): Renderable
    {
        return view('stock_movements.create')->with($this->getRelationshipData($stockMovementTypeId, $productId));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateStockMovementRequest $request
     * @return RedirectResponse
     */
    public function store(CreateStockMovementRequest $request): RedirectResponse
    {
        $this->stockMovementRepository->create($request->all());
        Flash::success('Stock Movement saved successfully.');
        return redirect(route('stock-movements.index'));
    }

    /**
     * Display the specified Stock Movement.
     *
     * @param integer $id
     * @return Renderable|RedirectResponse
     */
    public function show($id)
    {
        $stockMovement = $this->stockMovementRepository->find($id);
        if (empty($stockMovement)) {
            Flash::error('Stock Movement not found');
            return redirect(route('stock-movements.index'));
        }
        return view('stock_movements.show')->with('stockMovement', $stockMovement);
    }

    /**
     * Show the form for editing the specified Stock Movement.
     *
     * @param integer $id
     * @return Renderable|RedirectResponse
     */
    public function edit($id)
    {
        $stockMovement = $this->stockMovementRepository->find($id);
        if (empty($stockMovement)) {
            Flash::error('Stock Movement not found');
            return redirect(route('stock-movements.index'));
        }
        return view('stock_movements.edit')->with('stockMovement', $stockMovement)->with($this->getRelationshipData());
    }

    /**
     * Update the specified Stock Movement in storage.
     *
     * @param integer $id
     * @param UpdateStockMovementRequest $request
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateStockMovementRequest $request): RedirectResponse
    {
        $stockMovement = $this->stockMovementRepository->find($id);
        if (empty($stockMovement)) {
            Flash::error('Stock Movement not found');
            return redirect(route('stock-movements.index'));
        }
        $this->stockMovementRepository->update($request->except(['user_id', 'data_source_id']), $id);
        Flash::success('Stock Movement updated successfully.');
        return redirect(route('stock-movements.index'));
    }

    /**
     * Remove the specified Stock Movement from storage.
     *
     * @param  integer $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $stockMovement = $this->stockMovementRepository->find($id);
        if (empty($stockMovement)) {
            Flash::error('Stock Movement not found');
            return redirect(route('stock-movements.index'));
        }
        $this->stockMovementRepository->delete($id);
        Flash::success('Stock Movement deleted successfully.');
        return redirect(route('stock-movements.index'));
    }

    /**
     * Get data from relationship tables for fill the options of the inputs.
     *
     * @param  null|integer $stockMovementTypeId
     * @param  null|integer $productId
     * @return array
     */
    public function getRelationshipData($stockMovementTypeId = null, $productId = null): array
    {
        return [
            'stockMovementTypes' => $stockMovementTypeId>0 ? $this->stockMovementTypeRepository->all()->where('id', $stockMovementTypeId) : $this->stockMovementTypeRepository->all(),
            'products' => $productId>0 ? $this->productRepository->all()->where('id', $productId) : $this->productRepository->all(),
        ];
    }
}
