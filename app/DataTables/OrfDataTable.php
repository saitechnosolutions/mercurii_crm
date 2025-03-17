<?php

namespace App\DataTables;

use App\Models\AdditionalPOOrder;
use App\Models\Lead;
use App\Models\Orf;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrfDataTable extends DataTable
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

    ->addColumn('cat_name', function ($query) {
        return $query->cat_name ?? "-";
    })

    ->addColumn('orfref', function ($query) {
        return $query->orfref ?? "-";
    })

    ->addColumn('assigned_to', function ($query) {
        return $query->name ?? "-";
    })
    ->addColumn('cs_status', function ($query) {
        return $query->cs_status == 1 ? 'Approved' : 'Pending';
    })
    ->addColumn('approval_status', function ($query) {
        return $query->approval_status == 1 ? 'Approved' : 'Pending';
    })

    ->addColumn('LeadName', function ($query) {
        return $query->LeadName ?? "-";
    })

    ->addColumn('view', function ($query) {
        $quotUrl = url('/quotation/view/' . $query->quoproid);
        $viewUrl = url('/orfdetail/view/' . $query->quoproid); // Adjust this route as needed

        return "
            <div style='display: flex; gap: 5px; align-items: center;'>
                <a href='{$quotUrl}' target='_blank'>
                    <button style='color:#fff;background:#1b5583;border:none;padding:5px 10px;border-radius:4px;cursor:pointer;'>
                        Quot
                    </button>
                </a>
                <a href='{$viewUrl}' target='_blank'>
                    <button style='color:#fff;background:#fe6502;border:none;padding:5px 10px;border-radius:4px;cursor:pointer;'>
                        <i class='fas fa-eye'></i>
                    </button>
                </a>
            </div>";
    })

    ->addColumn('action', function ($query) {
        if (Auth::user()->role == 'Cs') {
            // Different button for CS role
            return "
                <div class='dropdown'>
                    <button style='color:#fff;background:#007bff;' class='btn px-18 py-11 text-primary-light' type='button' data-bs-toggle='dropdown'>
                        <i class='mdi mdi-chevron-down'></i>
                    </button>
                    <ul class='dropdown-menu'>
                        <li><a class='dropdown-item orf-csstatus-btn' href='javascript:void(0)' data-bs-toggle='modal' data-bs-target='#statusModalcs' data-appsta='{$query->approval_status}' data-rid='{$query->id}'>CS Approval</a></li>
                    </ul>
                </div>";
        } else {
            // Default button for other roles
            return "
                <div class='dropdown'>
                    <button style='color:#fff;background:#000;' class='btn px-18 py-11 text-primary-light' type='button' data-bs-toggle='dropdown'>
                        <i class='mdi mdi-chevron-down'></i>
                    </button>
                    <ul class='dropdown-menu'>
                        <li><a class='dropdown-item orf-status-btn' href='javascript:void(0)' data-bs-toggle='modal' data-bs-target='#statusModal' data-cssta='{$query->cs_status}' data-id='{$query->id}' >Proceed Approval</a></li>
                    </ul>
                </div>";
        }
    })

    ->filterColumn('LeadName', function ($query, $keyword) {
        $query->where('leads.LeadName', 'like', "%{$keyword}%");
    })
    ->filterColumn('orfref', function ($query, $keyword) {
        $query->where('orf.orfref', 'like', "%{$keyword}%");
    })
    ->filterColumn('cat_name', function ($query, $keyword) {
        $query->where('cate.dropdowndata', 'LIKE', "%{$keyword}%");
    })
    ->filterColumn('assigned_to', function ($query, $keyword) {
        $query->where('users.name', 'LIKE', "%{$keyword}%");
    })
    ->rawColumns(['LeadName','action','view'])
    ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Orf $model): QueryBuilder
    {
        return $model->newQuery()
        ->select([
            'orf.*',
            'leads.LeadName',
            'leads.assigned_to',
            'cate.category_name as cat_name',
            // 'leads.category',
            'users.name'
        ])
        ->where(function ($query) {
            $query->where('orf.approval_status', 0)
                  ->where('orf.cs_status', 0)
                  ->orWhere(function ($subQuery) {
                      $subQuery->where('orf.approval_status', 1)
                               ->where('orf.cs_status', 0);
                  });
        })
        ->leftJoin('leads', 'orf.leano', '=', 'leads.id')
        ->leftJoin('product_categories_tb as cate', 'cate.id', '=', 'leads.category')
        ->leftJoin('users', 'users.id', '=', 'leads.assigned_to');

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
        ->setTableId('orf')
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
            Column::make('LeadName')->title('Customer Name'),
            Column::make('cat_name')->title('Product Category'),
            Column::make('orfref')->title('ORF No'),
            Column::make('assigned_to')->title('Sales Executive'),
            Column::make('approval_status')->title('ORF Sales Status'),
            Column::make('cs_status')->title('ORF CS Status'),
            Column::computed('view')->title('View')->exportable(false)->printable(false)->width(60)->addClass('text-center'),
            Column::computed('action')->title('Action')->exportable(false)->printable(false)->width(60)->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Orf_' . date('YmdHis');
 }
}
