<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalLeads = Lead::count();

        // $leads = DB::table('dropdowndatas')->where('formid', 4)->get();
        $leads = DB::table('dropdowndatas')
        ->where('dropdowndatas.formid', 4)
        ->leftJoin('leads', 'leads.LeadSource', '=', 'dropdowndatas.id') // Left join to include all dropdowndata records
        ->select('dropdowndatas.id', 'dropdowndatas.dropdowndata', DB::raw('count(leads.id) as lead_count'))
        ->groupBy('dropdowndatas.id', 'dropdowndatas.dropdowndata')
        ->get();

        $leadsstatus = DB::table('dropdowndatas')
        ->where('dropdowndatas.formid', 6)
        ->leftJoin('leads', 'leads.Leadstatus', '=', 'dropdowndatas.id') // Left join to include all dropdowndata records
        ->select('dropdowndatas.id', 'dropdowndatas.dropdowndata', DB::raw('count(leads.id) as lead_count'))
        ->groupBy('dropdowndatas.id', 'dropdowndatas.dropdowndata')
        ->get();

        return view('pages.dashboard', compact('totalLeads','leads','leadsstatus'));

    }

    public function getLeads()
    {
        $leads = Lead::leftJoin('dropdowndatas as source', 'leads.Leadsource', '=', 'source.id')
                 ->leftJoin('dropdowndatas as status', 'leads.Leadstatus', '=', 'status.id')
                 ->select(
                    'leads.id',
                     'leads.LeadName',
                     'source.dropdowndata as Leadsource',  // Replacing ID with actual name
                     'leads.Entrydate',
                     'status.dropdowndata as Leadstatus'  // Replacing ID with actual name
                 )
                 ->get();
        // $leads = Lead::select('LeadName', 'Leadsource', 'Entrydate', 'Leadstatus')->get();
        return response()->json(['leads' => $leads]);
    }


}

