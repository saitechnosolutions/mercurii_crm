<?php

namespace App\Http\Controllers;

use App\DataTables\OrfappDataTable;
use App\DataTables\OrfDataTable;
use App\Models\Orf;
use App\Models\QuotationProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrfController extends Controller
{
    public function store(Request $request)
    {

        // Convert date format from DD-MM-YYYY to YYYY-MM-DD
    $quotadate = Carbon::createFromFormat('d-m-Y', $request->quotadate)->format('Y-m-d');
    $orfdate = $request->orfdate ? Carbon::parse($request->orfdate)->format('Y-m-d') : null;
    $podate = $request->podate ? Carbon::parse($request->podate)->format('Y-m-d') : null;
    $crddate = $request->crddate ? Carbon::parse($request->crddate)->format('Y-m-d') : null;

    // Handle file uploads and store in public/assets/images/
    $attcuspoPath = null;
    $sigdrawPath = null;

    if ($request->hasFile('attcuspo')) {
        $file = $request->file('attcuspo');
        $filename = time() . '_attcuspo_' . $file->getClientOriginalName();
        $destinationPath = public_path('assets/images/');
        $file->move($destinationPath, $filename);
        $attcuspoPath = 'assets/images/' . $filename;
    }

    if ($request->hasFile('sigdraw')) {
        $file = $request->file('sigdraw');
        $filename = time() . '_sigdraw_' . $file->getClientOriginalName();
        $destinationPath = public_path('assets/images/');
        $file->move($destinationPath, $filename);
        $sigdrawPath = 'assets/images/' . $filename;
    }

    // Insert data into the ORF table
    Orf::create([
        'quoproid' => $request->quoproid,
        'leano' => $request->leano,
        'tranref' => $request->tranref,
        'quono' => $request->quono,
        'custo' => $request->custo,
        'quotadate' => $quotadate,
        'orfref' => $request->orfref,
        'orfdate' => $orfdate,
        'cusporef' => $request->cusporef,
        'podate' => $podate,
        'attcuspo' => $attcuspoPath,
        'sigdraw' => $sigdrawPath,
        'crddate' => $crddate,
        'specialins' => $request->specialins,
    ]);

    return redirect()->route('single.quota', ['leadid' => $request->leano])
    ->with('success', 'ORF added successfully!');
    }

    public function vieworf(OrfDataTable $dataTable)
    {
        return $dataTable->render('pages.vieworf');
    }
    public function vieworfapp(OrfappDataTable $dataTable)
    {
        return $dataTable->render('pages.vieworfapp');
    }

    public function insertStatusorf(Request $request)
{
    // Find the lead
    $lead = orf::find($request->orfid);

    if ($lead) {
        // Update lead details
        $lead->approval_status = $request->approval_status ?? $lead->approval_status;
        $lead->cs_status = $request->cssta ?? $lead->cs_status;
        $lead->save();

        return response()->json(['success' => true, 'message' => 'ORF Approval updated successfully']);
    }

    return response()->json(['success' => false, 'message' => 'ORF not found']);
}

public function updatecsStatusorf(Request $request)
{
    // Find the lead
    $lead = orf::find($request->orfid);

    if ($lead) {
        // Update lead details
        $lead->cs_status = $request->cs_status ?? $lead->cs_status;
        $lead->approval_status = $request->appsta ?? $lead->approval_status;
        $lead->save();

        return response()->json(['success' => true, 'message' => 'ORF Approval updated successfully']);
    }

    return response()->json(['success' => false, 'message' => 'ORF not found']);
}

public function vieworfinvoice($id)
{
    $quotation = QuotationProduct::with(['lead', 'product'])
    ->where('id', $id)
    ->firstOrFail();
    // dd($quotation->toArray());
    return view('quotations.orfinvoice', compact('quotation'));
}

}
