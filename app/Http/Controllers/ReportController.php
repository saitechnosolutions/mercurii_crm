<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\User;
use App\Models\ProductCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    // public function showReports(Request $request)
    // {
    //     $query = Lead::select(
    //                 'leads.lead_id',
    //                 'leads.LeadName',
    //                 'product_categories_tb.category_name',
    //                 'products.productname',
    //                 'leads.converteddate',
    //                 'quotationproduct.grandtotal'
    //             )
    //             ->leftJoin('product_categories_tb', 'leads.category', '=', 'product_categories_tb.id')
    //             ->leftJoin('products', 'leads.products', '=', 'products.id')
    //             ->leftJoin(DB::raw('(SELECT * FROM quotationproduct WHERE id IN (SELECT MAX(id) FROM quotationproduct GROUP BY leadno)) as quotationproduct'), 'leads.id', '=', 'quotationproduct.leadno');

    //     // ✅ Filter by Date Range
    //     if ($request->fromdate && $request->todate) {
    //         $query->whereBetween('leads.converteddate', [
    //             Carbon::parse($request->fromdate)->startOfDay(),
    //             Carbon::parse($request->todate)->endOfDay()
    //         ]);
    //     }

    //     // ✅ Filter by Assigned User
    //     if ($request->assigned_to) {
    //         $query->where('leads.assigned_to', $request->assigned_to);
    //     }

    //     // ✅ Filter by Category
    //     if ($request->category_id) {
    //         $query->where('product_categories_tb.id', $request->category_id);
    //     }

    //     // ✅ Time-Based Filters
    //     if ($request->time_filter) {
    //         switch ($request->time_filter) {
    //             case 'monthly':
    //                 $query->whereMonth('leads.converteddate', Carbon::now()->month);
    //                 break;
    //             case 'weekly':
    //                 $query->whereBetween('leads.converteddate', [
    //                     Carbon::now()->startOfWeek(),
    //                     Carbon::now()->endOfWeek()
    //                 ]);
    //                 break;
    //             case 'quarterly':
    //                 $currentQuarter = ceil(Carbon::now()->month / 3);
    //                 $query->whereRaw('QUARTER(leads.converteddate) = ?', [$currentQuarter]);
    //                 break;
    //             case 'fy':
    //                 $startFy = Carbon::createFromDate(Carbon::now()->year, 4, 1);
    //                 $endFy = Carbon::createFromDate(Carbon::now()->year + 1, 3, 31);
    //                 $query->whereBetween('leads.converteddate', [$startFy, $endFy]);
    //                 break;
    //         }
    //     }

    //     // ✅ Order by Latest Converted Date First
    //     $leads = $query->orderBy('leads.converteddate', 'desc')->get();

    //     // Fetch categories and users for filter dropdowns
    //     $categories = DB::table('product_categories_tb')->get();
    //     $users = DB::table('users')->get(); // Adjust based on your user table

    //     return view('pages.reports', compact('leads', 'categories', 'users'));
    // }
    public function showReports(Request $request)
    {
        $query = Lead::select(
                'leads.lead_id',
                'leads.LeadName',
                'product_categories_tb.category_name',
                'products.productname',
                'leads.converteddate',
                'quotationproduct.grandtotal',
                DB::raw("
                    CASE
                        WHEN orf.leano IS NOT NULL THEN 'ORF'
                        WHEN quotationproduct.leadno IS NOT NULL THEN 'Quotation'
                        WHEN quotations.id_lead IS NOT NULL THEN 'Quotation'
                        WHEN designs.idlead IS NOT NULL THEN 'Design'
                        ELSE 'N/A'
                    END as stage
                ")
            )
            ->leftJoin('product_categories_tb', 'leads.category', '=', 'product_categories_tb.id')
            ->leftJoin('products', 'leads.products', '=', 'products.id')
            ->leftJoin(DB::raw('(SELECT * FROM quotationproduct WHERE id IN (SELECT MAX(id) FROM quotationproduct GROUP BY leadno)) as quotationproduct'), 'leads.id', '=', 'quotationproduct.leadno')
            ->leftJoin('orf', 'leads.id', '=', 'orf.leano')
            ->leftJoin('quotations', 'leads.id', '=', 'quotations.id_lead')
            ->leftJoin('designs', 'leads.id', '=', 'designs.idlead');

        // ✅ Apply Filters (same as before)
        if ($request->fromdate && $request->todate) {
            $query->whereBetween('leads.converteddate', [
                Carbon::parse($request->fromdate)->startOfDay(),
                Carbon::parse($request->todate)->endOfDay()
            ]);
        }

        if ($request->assigned_to) {
            $query->where('leads.assigned_to', $request->assigned_to);
        }

        if ($request->category_id) {
            $query->where('product_categories_tb.id', $request->category_id);
        }

        if ($request->time_filter) {
            switch ($request->time_filter) {
                case 'monthly':
                    $query->whereMonth('leads.converteddate', Carbon::now()->month);
                    break;
                case 'weekly':
                    $query->whereBetween('leads.converteddate', [
                        Carbon::now()->startOfWeek(),
                        Carbon::now()->endOfWeek()
                    ]);
                    break;
                case 'quarterly':
                    $currentQuarter = ceil(Carbon::now()->month / 3);
                    $query->whereRaw('QUARTER(leads.converteddate) = ?', [$currentQuarter]);
                    break;
                case 'fy':
                    $startFy = Carbon::createFromDate(Carbon::now()->year, 4, 1);
                    $endFy = Carbon::createFromDate(Carbon::now()->year + 1, 3, 31);
                    $query->whereBetween('leads.converteddate', [$startFy, $endFy]);
                    break;
            }
        }

        $leads = $query->orderBy('leads.converteddate', 'desc')->get();

        $categories = DB::table('product_categories_tb')->get();
        $users = DB::table('users')->get();

        return view('pages.reports', compact('leads', 'categories', 'users'));
    }


}
