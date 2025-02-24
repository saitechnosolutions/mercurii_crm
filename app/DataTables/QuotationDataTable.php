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

class QuotationDataTable extends DataTable
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
    ->addColumn('citylist', function ($query) {
        return $query->city_name ?? "-";
    })
    ->addColumn('Leadsource', function ($query) {
        return $query->source_name ?? "-";
    })
    ->addColumn('Leadstatus', function ($query) {
        return $query->status_name ?? "-";
    })
    ->addColumn('email', function ($query) {
        return $query->email ?? "-";
    })
    ->addColumn('contactname', function ($query) {
        return $query->contactname ?? "-";
    })
    ->addColumn('phonumber', function ($query) {
        return $query->phonumber ?? "-";
    })
    ->addColumn('assigned_to', function ($query) {
        return $query->name ?? "-";
    })
    ->addColumn('lead_id', function ($query) {
        return $query->lead_id ?? "-";
    })
    ->addColumn('LeadName', function ($query) {
        $url = url('/singlequota/' . $query->id);
        return '<a href="' . $url . '">' . e($query->LeadName) . '</a>';
    })
    // ->addColumn('action', function ($query) {
    //     return "
    //         <div class='dropdown'>
    //             <button style='color:#fff;background:#000;' class='btn px-18 py-11 text-primary-light' type='button' data-bs-toggle='dropdown'>
    //                 <i class='mdi mdi-chevron-down'></i>
    //             </button>
    //             <ul class='dropdown-menu'>
    //                 <li><a class='dropdown-item change-status-btn' href='javascript:void(0)'  data-bs-toggle='modal' data-bs-target='#statusModal' data-id='{$query->id}'>Change Status</a></li>
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
    ->filterColumn('citylist', function ($query, $keyword) {
        $query->where('city_list.city_name', 'like', "%{$keyword}%");
    })
    ->filterColumn('email', function ($query, $keyword) {
        $query->where('leads.email', 'like', "%{$keyword}%");
    })
    ->filterColumn('contactname', function ($query, $keyword) {
        $query->where('leads.contactname', 'like', "%{$keyword}%");
    })
    ->filterColumn('phonumber', function ($query, $keyword) {
        $query->where('leads.phonumber', 'like', "%{$keyword}%");
    })
    ->filterColumn('assigned_to', function ($query, $keyword) {
        $query->where('users.name', 'like', "%{$keyword}%");
    })
    ->filterColumn('lead_id', function ($query, $keyword) {
        $query->where('leads.lead_id', 'like', "%{$keyword}%");
    })
    ->rawColumns(['LeadName','action'])
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
            'status.dropdowndata as status_name',
            'city_list.city_name',
            'users.name'
        ])
        ->leftJoin('dropdowndatas as source', 'source.id', '=', 'leads.Leadsource')
        ->leftJoin('dropdowndatas as status', 'status.id', '=', 'leads.Leadstatus')
        ->leftJoin('city_list', 'city_list.id', '=', 'leads.citylist')
        ->leftJoin('users', 'users.id', '=', 'leads.assigned_to')
        // ->whereIn('leads.category', [353, 356, 357])
        ->where('leads.Leadstatus', '=' , 343 )
        ->where('leads.quota_proceed', '=' , 1 )
        ->orderBy('leads.updated_at', 'desc');
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
            Column::make('LeadName')->title('Customer Name'),
            Column::make('citylist')->title('City'),
            Column::make('email')->title('Email'),
            Column::make('contactname')->title('Contact Name'),
            Column::make('phonumber')->title('Contact No'),
            Column::make('assigned_to')->title('Sales Manager'),
            Column::make('lead_id')->title('Enq Ref No'),
            // Column::make('Leadsource')->title('Enquiry Source'),
            // Column::make('Leadstatus')->title('Enquiry Status'),
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
