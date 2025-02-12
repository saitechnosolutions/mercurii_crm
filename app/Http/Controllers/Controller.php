<?php

namespace App\Http\Controllers;

use App\DataTables\ConvertedDataTable;
use App\DataTables\LeadDataTable;
use App\Models\Country;
use App\Models\Field;
use App\Models\Lead;
use App\Models\LeadProduct;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function saveleads(Request $request)
    {

        $data = $request->except('_token');


        if($request->assigned_to != '')
        {
            $assignto = $request->assigned_to;
        }
        else
        {
            $assignto = Auth::user()->id;
        }

        // Insert the data into the leads table
        // Lead::create($data);
        $lead = Lead::create($data);
        $lastInsertId = $lead->id;

        $leadproduct = DB::table('leadproducts')
        ->insertGetId([
            "singleproduct"=>$request->products,
            "leadid"=>$lastInsertId,
            "statuslead"=>$request->Leadstatus,
            "enquirydate"=>$request->Entrydate,
        ]);
        $maxValue =  $lastInsertId;
        $invID = $maxValue;
        $invID = str_pad($invID, 4, '0', STR_PAD_LEFT);
        $leadID = "LEAD" . $invID;

        DB::table('leads')
        ->where('id',$lastInsertId)
        ->update([
            "lead_id" => $leadID,
            "assigned_to" => $assignto,

        ]);

        return redirect()->route('pages.leads')->with('success', 'Lead saved successfully!');


    }


    public function singleLead($leadid)
    {
        // Fetch lead details using the ID
        $lead = Lead::find($leadid);

        // Check if lead exists
        if (!$lead) {
            return redirect()->back()->with('error', 'Lead not found');
        }

        $leadProducts = DB::table('leadproducts')
        ->where('leadid', $leadid)
        ->get();

        // Pass lead data to the view
        return view('pages.singlelead', compact('lead', 'leadProducts'));
    }

    public function singlequota($leadid)
    {
        // Fetch lead details using the ID
        $lead = Lead::find($leadid);

        // Check if lead exists
        if (!$lead) {
            return redirect()->back()->with('error', 'Lead not found');
        }

        $leadProducts = DB::table('leadproducts')
        ->where('leadid', $leadid)
        ->get();

        // Pass lead data to the view
        return view('pages.singlequota', compact('lead', 'leadProducts'));
    }

    public function createquota($leadid)
    {
        // Fetch lead details using the ID
        $lead = Lead::find($leadid);

        // Check if lead exists
        if (!$lead) {
            return redirect()->back()->with('error', 'Lead not found');
        }

        $leadProducts = DB::table('leadproducts')
        ->where('leadid', $leadid)
        ->get();

        // Pass lead data to the view
        return view('pages.createestimate', compact('lead', 'leadProducts'));
    }




    public function updateStatus(Request $request)
{

    // Update lead table
    Lead::where('id', $request->leadid)->update([
        'Leadstatus' => $request->statuslead,

    ]);

    // Update leadproducts table (only if productid is provided)
    if (!empty($request->productid)) {
        LeadProduct::where('id', $request->productid)->update([
            'statuslead' => $request->statuslead,
            'coverteddate' => $request->converteddate,
        ]);
    }

    return redirect()->back()->with('success', 'Status updated successfully.');
}


    public function Leadedit($leadid)
    {
        // Fetch lead details using the ID
        $row = Lead::find($leadid);

        // Check if lead exists
        if (!$row) {
            return redirect()->back()->with('error', 'Lead not found');
        }

        // Pass lead data to the view
        return view('pages.lead-edit', compact('row'));
    }


    public function updatelead(Request $request)
    {
        $id = $request->id;
        if($request->assigned_to != '')
        {
            $assignto = $request->assigned_to;
        }
        else
        {
            $assignto = Auth::user()->id;
        }
        $data = $request->except('_token');

        $lead = Lead::find($id);


        DB::table('leads')
        ->where('id',$id)
        ->update([
            "assigned_to" => $assignto,

        ]);

   DB::table('leadproducts')
        ->where('leadid',$id)
        ->update([
            "singleproduct"=>$request->products,
            "statuslead"=>$request->Leadstatus,
            "enquirydate" => $request->Entrydate,

        ]);

        $updatedata = $lead->update($data);
        if ($updatedata) {
            return redirect()->route('single.lead', ['leadid' => $id])
                ->with('message', 'Lead Updated Successfully...');
        }
        return redirect()->route('single.lead', ['leadid' => $id])
        ->with('message', 'Lead Updated Successfully...');

        // return redirect()->back()->with('message','Lead Updated Successfully...');
    }


    public function index(LeadDataTable $dataTable)
    {
        return $dataTable->render('pages.leads');
    }

    public function viewconvert(ConvertedDataTable $dataTable)
    {
        return $dataTable->render('pages.viewconverted');
    }



    public function saveleadsproduct(Request $request)
    {
        $statuslead = $request->statuslead;
        $singleproduct = $request->singleproduct;
        $leadid = $request->leadid;
        $enquirydate = $request->enquirydate;
        $coverteddate = $request->coverteddate;

        $productid=DB::table('leadproducts')
        ->insert([
            "statuslead"=>$statuslead,
            "singleproduct"=>$singleproduct,
            "leadid"=>$leadid,
            "enquirydate"=>$enquirydate,
            "coverteddate"=>$coverteddate,
        ]);

        return response()->json([
            'status'=>'200',
            'message'=>'Product Added SuccessFully'
        ]);

    }

    public function getfandfreports(Request $request)
{
    $state_id = $request->input('state_id');  // Make sure the variable matches the one from AJAX

    // Fetch districts based on state_id
    $districts = DB::table('city_list')->where('state_code', $state_id)
        ->select('id', 'city_name')->get();

    // Build the HTML for the city options
    $districtOptions = '<option value="">-- Choose City --</option>';
    foreach ($districts as $district) {
        $districtOptions .= "<option value='" . $district->id . "'>" . $district->city_name . "</option>";
    }

    return response()->json([
        'citylist' => $districtOptions  // Return the options as a response
    ]);
}

}
