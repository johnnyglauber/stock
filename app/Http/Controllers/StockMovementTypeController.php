<?php

namespace App\Http\Controllers;

use App\DataTables\StockMovementTypeDataTable;
use App\Http\Requests\CreateStockMovementTypeRequest;
use App\Http\Requests\UpdateStockMovementTypeRequest;
use App\Repositories\StockMovementTypeRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Response;

/**
 * Class StockMovementTypeController
 *
 */
class StockMovementTypeController extends Controller
{
    /**
     * @var StockMovementTypeRepositoryInterface
     *
     */
    private $stockMovementTypeRepository;

    /**
     * StockMovementTypeController constructor.
     *
     * @param StockMovementTypeRepositoryInterface $stockMovementTypeRepository
     * @return void
     */
    public function __construct(StockMovementTypeRepositoryInterface $stockMovementTypeRepository)
    {
        $this->middleware('auth');
        $this->stockMovementTypeRepository = $stockMovementTypeRepository;
    }

    /**
     * Display a list of the Stock Movement Type.
     *
     * @param StockMovementTypeDataTable $stockMovementTypeDataTable
     * @return View|Response|JsonResponse
     */
    public function index(StockMovementTypeDataTable $stockMovementTypeDataTable)
    {
        return $stockMovementTypeDataTable->render('stock_movement_types.index');
    }

    /**
     * Show the form for creating a new Stock Movement Type.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('stock_movement_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateStockMovementTypeRequest $request
     * @return RedirectResponse
     */
    public function store(CreateStockMovementTypeRequest $request): RedirectResponse
    {
        $this->stockMovementTypeRepository->create($request->all());
        Flash::success('Stock Movement Type saved successfully.');
        return redirect(route('stock-movement-types.index'));
    }

    /**
     * Display the specified Stock Movement Type.
     *
     * @param integer $id
     * @return Renderable|RedirectResponse
     */
    public function show($id)
    {
        $stockMovementType = $this->stockMovementTypeRepository->find($id);
        if (empty($stockMovementType)) {
            Flash::error('Stock Movement Type not found');
            return redirect(route('stock-movement-types.index'));
        }
        return view('stock_movement_types.show')->with('stockMovementType', $stockMovementType);
    }

    /**
     * Show the form for editing the specified Stock Movement Type.
     *
     * @param integer $id
     * @return Renderable|RedirectResponse
     */
    public function edit($id)
    {
        $stockMovementType = $this->stockMovementTypeRepository->find($id);
        if (empty($stockMovementType)) {
            Flash::error('Stock Movement Type not found');
            return redirect(route('stock-movement-types.index'));
        }
        return view('stock_movement_types.edit')->with('stockMovementType', $stockMovementType);
    }

    /**
     * Update the specified Stock Movement Type in storage.
     *
     * @param integer $id
     * @param UpdateStockMovementTypeRequest $request
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateStockMovementTypeRequest $request): RedirectResponse
    {
        $stockMovementType = $this->stockMovementTypeRepository->find($id);
        if (empty($stockMovementType)) {
            Flash::error('Stock Movement Type not found');
            return redirect(route('stock-movement-types.index'));
        }
        $this->stockMovementTypeRepository->update($request->all(), $id);
        Flash::success('Stock Movement Type updated successfully.');
        return redirect(route('stock-movement-types.index'));
    }

    /**
     * Remove the specified Stock Movement Type from storage.
     *
     * @param  integer $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $stockMovementType = $this->stockMovementTypeRepository->find($id);
        if (empty($stockMovementType)) {
            Flash::error('Stock Movement Type not found');
            return redirect(route('stock-movement-types.index'));
        }
        $this->stockMovementTypeRepository->delete($id);
        Flash::success('Stock Movement Type deleted successfully.');
        return redirect(route('stock-movement-types.index'));
    }
}
