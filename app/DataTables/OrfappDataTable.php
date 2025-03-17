<?php

namespace App\DataTables;

use App\Models\AdditionalPOOrder;
use App\Models\Lead;
use App\Models\Orf;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrfappDataTable extends DataTable
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
    ->addColumn('approval_status', function ($query) {
        return $query->approval_status == 1 ? 'Approved' : ($query->approval_status ?? "-");
    })
    ->addColumn('cs_status', function ($query) {
        return $query->cs_status == 1 ? 'Approved' : ($query->cs_status ?? "-");
    })
    ->addColumn('LeadName', function ($query) {
        return $query->LeadName ?? "-";
    })

    ->addColumn('view', function ($query) {
        $quotUrl = url('/quotation/view/' . $query->quoproid);
        $orfUrl = url('/orfdetail/view/' . $query->quoproid);

        $cpoUrl = !empty($query->attcuspo) ? url('assets/images/' . ltrim(str_replace('assets/images/', '', $query->attcuspo), '/')) : '#';
$sigdrawUrl = !empty($query->sigdraw) ? url('assets/images/' . ltrim(str_replace('assets/images/', '', $query->sigdraw), '/')) : '#';



        $cpoButton = $query->attcuspo ? "<a href='{$cpoUrl}' download>
                    <button style='color:#fff;background:#28a745;border:none;padding:5px 10px;border-radius:4px;cursor:pointer;'>
                        C-PO
                    </button>
                </a>" : '';

        $sigdrawButton = $query->sigdraw ? "<a href='{$sigdrawUrl}' download>
                    <button style='color:#fff;background:#6c757d;border:none;padding:5px 10px;border-radius:4px;cursor:pointer;'>
                        C-DRAW
                    </button>
                </a>" : '';

        return "
            <div style='display: flex; gap: 5px;'>
                <a href='{$quotUrl}' target='_blank'>
                    <button style='color:#fff;background:#1b5583;border:none;padding:5px 10px;border-radius:4px;cursor:pointer;'>
                        Quot
                    </button>
                </a>
                <a href='{$orfUrl}' target='_blank'>
                    <button style='color:#fff;background:#fe6502;border:none;padding:5px 10px;border-radius:4px;cursor:pointer;'>
                        ORF
                    </button>
                </a>
                {$cpoButton}
                {$sigdrawButton}
            </div>";
    })


    ->addColumn('action', function ($query) {
        return "
            <div class='dropdown'>
                <button style='color:#fff;background:#000;' class='btn px-18 py-11 text-primary-light' type='button' data-bs-toggle='dropdown'>
                    <i class='mdi mdi-chevron-down'></i>
                </button>
                <ul class='dropdown-menu'>
                    <li><a class='dropdown-item orf-status-btn' href='/invoice' >Generate Invoice</a></li>
                </ul>
            </div>";
    })

    ->filterColumn('LeadName', function ($query, $keyword) {
        $query->where('leads.LeadName', 'like', "%{$keyword}%");
    })
    ->filterColumn('orfref', function ($query, $keyword) {
        $query->where('orf.orfref', 'like', "%{$keyword}%");
    })
    // ->filterColumn('cs_status', function ($query, $keyword) {
    //     $query->where('orf.cs_status', 'like', "%{$keyword}%");
    // })
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
        ->where('orf.approval_status','=', 1)
        ->where('orf.cs_status','=', 1)
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
            // 'responsive'   => true,
            // 'autoWidth'    => false,
            // 'scrollX'      => true,
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
