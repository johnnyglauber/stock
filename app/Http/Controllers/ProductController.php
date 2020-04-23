<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Response;

/**
 * Class ProductController
 *
 */
class ProductController extends Controller
{
    /**
     * @var ProductRepositoryInterface
     *
     */
    private $productRepository;

    /**
     * ProductController constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->middleware('auth');
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of Products.
     *
     * @param ProductDataTable $productDataTable
     * @return View|Response|JsonResponse
     */
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('products.index');
    }

    /**
     * Show the form for creating a new Product.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductRequest $request
     * @return RedirectResponse
     */
    public function store(CreateProductRequest $request): RedirectResponse
    {
        $this->productRepository->create($request->all());
        Flash::success('Product saved successfully.');
        return redirect(route('products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param integer $id
     * @return Renderable|RedirectResponse
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);
        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     *
     * @param integer $id
     * @return Renderable|RedirectResponse
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }
        return view('products.edit')->with('product', $product);
    }

    /**
     * Update the specified Product in storage.
     *
     * @param integer $id
     * @param UpdateProductRequest $request
     *
     * @return RedirectResponse
     */
    public function update($id, UpdateProductRequest $request): RedirectResponse
    {
        $product = $this->productRepository->find($id);
        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }
        $this->productRepository->update($request->all(), $id);
        Flash::success('Product updated successfully.');
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @param  integer $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $product = $this->productRepository->find($id);
        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }
        $this->productRepository->delete($id);
        Flash::success('Product deleted successfully.');
        return redirect(route('products.index'));
    }
}
