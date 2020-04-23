<?php

namespace App\DataTables;

use App\Models\StockMovement;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\DataTableAbstract;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Yajra\DataTables\Html\Builder as DataTablesBuilder;

/**
 * Class StockMovementDataTable
 *
 */
class StockMovementDataTable extends DataTable
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
        $dataTable->addColumn('stock_movement_type_id', function ($model) {
            return $model->stockMovementType->name;
        });
        $dataTable->addColumn('product_id', function ($model) {
            return $model->product->name;
        });
        $dataTable->addColumn('product_code', function ($model) {
            return $model->product->code;
        });
        $dataTable->addColumn('user_id', function ($model) {
            return $model->user->name;
        });
        $dataTable->addColumn('data_source_id', function ($model) {
            return $model->dataSource->name;
        });
        $dataTable->addColumn('action', 'stock_movements.datatables_actions');
        return $dataTable;
    }

    /**
     * Get query source of dataTable.
     *
     * @param StockMovement $model
     * @return EloquentBuilder
     */
    public function query(StockMovement $model): EloquentBuilder
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
            'stock_movement_type_id' => [
                'title' => 'Type',
            ],
            'product_id' => [
                'title' => 'Product',
            ],
            'product_code' => [
                'title' => 'SKU',
            ],
            'amount' => [
                'title' => 'Amount',
            ],
            'user_id' => [
                'title' => 'User',
            ],
            'data_source_id' => [
                'title' => 'Source',
            ],
            'created_at' => [
                'title' => 'Date/Time',
            ],
        ];
    }

    /**
     * @inheritDoc
     */
    protected function filename(): string
    {
        return 'stock_movements_' . time();
    }
}
