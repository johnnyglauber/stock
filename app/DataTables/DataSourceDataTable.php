<?php

namespace App\DataTables;

use App\Models\DataSource;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\DataTableAbstract;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Yajra\DataTables\Html\Builder as DataTablesBuilder;

/**
 * Class DataSourceDataTable
 *
 */
class DataSourceDataTable extends DataTable
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
        return $dataTable->addColumn('action', 'data_sources.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param DataSource $model
     * @return EloquentBuilder
     */
    public function query(DataSource $model): EloquentBuilder
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
            'name'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function filename(): string
    {
        return 'data_sources_' . time();
    }
}
