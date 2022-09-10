<?php

namespace App\DataTables;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LuckyDrawDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'lucky_draws.action')
            ->rawColumns(['donor','action'])
            ->editColumn('created_at', function ($query){
                return \Carbon\Carbon::parse($query->created_at)->toDayDateTimeString();
            })
            ->editColumn('updated_at', function ($query){
                return \Carbon\Carbon::parse($query->updated_at)->toDayDateTimeString();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Invoice $model
     * @return Builder
     */
    public function query(Invoice $model)
    {
        return $model->newQuery()
            ->with('user')
            ->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('luckydrawdatatable-table')
                    ->responsive('true')
                    ->autoWidth('false')
                    ->rowReorder(['selector'=>'td:nth-child(2)'])
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
//            'id' => ['data'=>'id', 'title'=> __('lucky.lucky id')],
            'invoice_number' => ['data'=> 'invoice_number','title'=>__('lucky.lucky id')],
            'lucky_no' => ['data'=>'lucky_no', 'title'=> __('lucky.lucky no')],
            'amount' => ['data' => 'amount','title' =>__('lucky.amount')],
            'mtl' => ['data' => 'mtl','title' =>__('lucky.material')],
            'mtl_value' => ['data' => 'mtl_value','title' =>__('lucky.material amount')],
            'donor' => ['data' => 'donor','title' =>__('lucky.donor name')],
            'address' => ['data' => 'address','title' =>__('lucky.address')],
//            'times' => ['data' => 'times','title' =>__('lucky.times')],
            'created by' => ['data'=>'user.name','title' =>__('lucky.created by')],
            'created_at' => ['data'=>'created_at','title' =>__('lucky.created at')],
            'updated_at' => ['data'=>'updated_at','title' =>__('lucky.updated at')],
            'action' => ['data'=>'action','title' =>__('lucky.action')],
//            Column::make('created_at'),
//            Column::make('updated_at'),
//            Column::computed('action')
//                ->exportable(false)
//                ->printable(false)
//                ->width(100)
//                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'LuckyDraw_' . date('YmdHis');
    }
}
