<?php

namespace App\DataTables;

use App\Models\Pathan;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PathanDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'pathans.action')
            ->rawColumns(['donor','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Pathan $model
     * @return Builder
     */
    public function query(Pathan $model)
    {
        return $model->newQuery()->with('user')->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('pathandatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->responsive('true')
                    ->autoWidth('false')
                    ->rowReorder(['selector'=>'td:nth-child(2)'])
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['data'=>'id', 'title'=> __('pathan.pathan id')],
            'amount' => ['data'=>'amount', 'title'=> __('pathan.amount')],
            'material' => ['data'=>'material', 'title'=> __('pathan.material')],
            'mtl_value' => ['data'=>'mtl_value', 'title'=> __('pathan.material amount')],
            'donor' => ['data'=>'donor', 'title'=> __('pathan.donor name')],
            'address' => ['data'=>'address', 'title'=> __('pathan.address')],
            'created by' => ['data'=>'user.name','title' => __('pathan.created by')],
            'created_at' => ['data'=>'created_at','title'=> __('pathan.created at')],
            'updated_at' => ['data'=>'updated_at','title'=> __('pathan.updated at')],
            'action' => ['data'=> 'action' , 'title' => __('pathan.action')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pathan_' . date('YmdHis');
    }
}
