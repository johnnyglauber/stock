<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\DataTableAbstract;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Yajra\DataTables\Html\Builder as DataTablesBuilder;

/**
 * Class ProductDataTable
 *
 */
class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);
        $dataTable->addColumn('user_id', function ($model) {
            return $model->user->name;
        });
        $dataTable->addColumn('stock', function ($model) {
            return $model->availableAmount();
        });
        $dataTable->addColumn('action', 'products.datatables_actions');
        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param Product $model
     * @return EloquentBuilder
     */
    public function query(Product $model): EloquentBuilder
    {
        return $model->newQuery();
    }

    /**
     * @inheritDoc
     */
    public function html(): DataTablesBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            'id',
            'name',
            'code' => [
                'title' => 'SKU',
            ],
            'user_id' => [
                'title' => 'User',
            ],
            'stock' => [
                'title' => 'Stock Availability',
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function filename(): string
    {
        return 'products_' . time();
    }
}
