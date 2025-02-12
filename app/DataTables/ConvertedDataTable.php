<?php

namespace App\DataTables;

use App\Models\AdditionalPOOrder;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ConvertedDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
    // ->addColumn('Entrydate', function ($query) {
    //     return $query->Entrydate ?? "-";
    // })
    ->addColumn('Entrydate', function ($query) {
        return $query->Entrydate ? \Carbon\Carbon::parse($query->Entrydate)->format('d-m-Y') : "-";
    })
    ->addColumn('Leadsource', function ($query) {
        return $query->source_name ?? "-";
    })
    ->addColumn('Leadstatus', function ($query) {
        return $query->status_name ?? "-";
    })
    ->addColumn('LeadName', function ($query) {
        $url = url('/singlequota/' . $query->id);
        return '<a href="' . $url . '">' . e($query->LeadName) . '</a>';
    })
    // ->addColumn('action', function ($query) {
    //     return "
    //         <div class='dropdown'>
    //             <button class='btn px-18 py-11 text-primary-light' type='button' data-bs-toggle='dropdown'>
    //                 <iconify-icon icon='entypo:dots-three-horizontal' class='menu-icon'></iconify-icon>
    //             </button>
    //             <ul class='dropdown-menu'>
    //                 <li><a class='dropdown-item' href='javascript:void(0)'>Edit</a></li>
    //                 <li><a class='dropdown-item' target='_blank' href='javascript:void(0)'>View</a></li>
    //                 <li><a class='dropdown-item' href='javascript:void(0)'>Delete</a></li>
    //             </ul>
    //         </div>";
    // })
    ->filterColumn('Entrydate', function ($query, $keyword) {
        $query->where('leads.Entrydate', 'like', "%{$keyword}%");
    })
    ->filterColumn('Leadsource', function ($query, $keyword) {
        $query->where('source.dropdowndata', 'like', "%{$keyword}%");
    })
    ->filterColumn('Leadstatus', function ($query, $keyword) {
        $query->where('status.dropdowndata', 'like', "%{$keyword}%");
    })
    ->filterColumn('LeadName', function ($query, $keyword) {
        $query->where('leads.LeadName', 'like', "%{$keyword}%");
    })
    ->rawColumns(['LeadName'])
    ->setRowId('id');


    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Lead $model): QueryBuilder
    {
        return $model->newQuery()
        ->select([
            'leads.*',
            'source.dropdowndata as source_name',
            'status.dropdowndata as status_name'
        ])
        ->leftJoin('dropdowndatas as source', 'source.id', '=', 'leads.Leadsource')
        ->leftJoin('dropdowndatas as status', 'status.id', '=', 'leads.Leadstatus')
        ->where('leads.Leadstatus', '=' , 343 );
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->setTableId('leads')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->serverSide(true) // Enable server-side processing
        ->processing(true) // Show processing indicator
        ->parameters([
            'dom'          => 'Bfrtip',
            'buttons'      => ['excel', 'print', 'pdf'],
        ])
        ->orderBy(1)
        ->selectStyleSingle()
        ->fixedColumns(true);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('Entrydate')->title('Entry Date'),
            Column::make('LeadName')->title('Lead Name'),
            Column::make('Leadsource')->title('Lead Source'),
            Column::make('Leadstatus')->title('Lead Status'),
            // Column::computed('action')->title('Action')->exportable(false)->printable(false)->width(60)->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Lead_' . date('YmdHis');
 }
}
