<?php

namespace App\Http\Controllers;

use App\DataTables\DataSourceDataTable;
use App\Http\Requests\CreateDataSourceRequest;
use App\Http\Requests\UpdateDataSourceRequest;
use App\Repositories\DataSourceRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Response;

/**
 * Class DataSourceController
 *
 */
class DataSourceController extends Controller
{
    /**
     * @var DataSourceRepositoryInterface
     *
     */
    private $dataSourceRepository;

    /**
     * DataSourceController constructor.
     *
     * @param DataSourceRepositoryInterface $dataSourceRepository
     * @return void
     */
    public function __construct(DataSourceRepositoryInterface $dataSourceRepository)
    {
        $this->middleware('auth');
        $this->dataSourceRepository = $dataSourceRepository;
    }

    /**
     * Display a list of the Data Source.
     *
     * @param DataSourceDataTable $dataSourceDataTable
     * @return View|Response|JsonResponse
     */
    public function index(DataSourceDataTable $dataSourceDataTable)
    {
        return $dataSourceDataTable->render('data_sources.index');
    }

    /**
     * Show the form for creating a new Data Source.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('data_sources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateDataSourceRequest $request
     * @return RedirectResponse
     */
    public function store(CreateDataSourceRequest $request): RedirectResponse
    {
        $this->dataSourceRepository->create($request->all());
        Flash::success('Data Source saved successfully.');
        return redirect(route('data-sources.index'));
    }

    /**
     * Display the specified Data Source.
     *
     * @param integer $id
     * @return Renderable|RedirectResponse
     */
    public function show($id)
    {
        $dataSource = $this->dataSourceRepository->find($id);
        if (empty($dataSource)) {
            Flash::error('Data Source not found');
            return redirect(route('data-sources.index'));
        }
        return view('data_sources.show')->with('dataSource', $dataSource);
    }

    /**
     * Show the form for editing the specified Data Source.
     *
     * @param integer $id
     * @return Renderable|RedirectResponse
     */
    public function edit($id)
    {
        $dataSource = $this->dataSourceRepository->find($id);
        if (empty($dataSource)) {
            Flash::error('Data Source not found');
            return redirect(route('data-sources.index'));
        }
        return view('data_sources.edit')->with('dataSource', $dataSource);
    }

    /**
     * Update the specified Data Source in storage.
     *
     * @param integer $id
     * @param UpdateDataSourceRequest $request
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateDataSourceRequest $request): RedirectResponse
    {
        $dataSource = $this->dataSourceRepository->find($id);
        if (empty($dataSource)) {
            Flash::error('Data Source not found');
            return redirect(route('data-sources.index'));
        }
        $this->dataSourceRepository->update($request->all(), $id);
        Flash::success('Data Source updated successfully.');
        return redirect(route('data-sources.index'));
    }

    /**
     * Remove the specified Data Source from storage.
     *
     * @param  integer $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $dataSource = $this->dataSourceRepository->find($id);
        if (empty($dataSource)) {
            Flash::error('Data Source not found');
            return redirect(route('data-sources.index'));
        }
        $this->dataSourceRepository->delete($id);
        Flash::success('Data Source deleted successfully.');
        return redirect(route('data-sources.index'));
    }
}
