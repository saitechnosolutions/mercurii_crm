<?php

namespace App\Http\Controllers;

use App\DataTables\ConvertedDataTable;
use App\DataTables\LeadDataTable;
use App\DataTables\QuotationDataTable;
use App\Mail\DesignUploadedMail;
use App\Mail\LeadCreatedMail;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Design;
use App\Models\Dropdowndata;
use App\Models\Field;
use App\Models\Freight;
use App\Models\Lead;
use App\Models\LeadDesign;
use App\Models\LeadProduct;
use App\Models\ProductCategory;
use App\Models\Quotation;
use App\Models\QuotationProduct;
use App\Models\Term;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function saveleads(Request $request)
    {

        $data = $request->except('_token', 'newCustomerName');

        if ($request->LeadName === 'new' && $request->newCustomerName) {
            // Store the entered new customer name
            $data['LeadName'] = $request->newCustomerName;
        } else {
            // Store the selected existing customer name
            $data['LeadName'] = $request->LeadName;
        }

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

        $leadrt = Lead::with(['assignedTo', 'leadstatus'])->find($lastInsertId);

        $adminEmail = 'nvikram.sts@gmail.com'; // Replace with your admin email
        $assignedUserEmail = User::find($assignto)->email ?? null;

        // Mail::to($adminEmail)->send(new LeadCreatedMail($leadrt));

        // if ($assignedUserEmail) {
        //     Mail::to($assignedUserEmail)->send(new LeadCreatedMail($leadrt));
        // }

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
        $quotations = DB::table('quotations')
        ->where('id_lead', $leadid)
        ->first();

        // Pass lead data to the view
        return view('pages.createestimate', compact('lead', 'leadProducts', 'quotations'));
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

    public function viewquota(QuotationDataTable $dataTable)
    {
        return $dataTable->render('pages.viewquotation');
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

public function shifandfreports(Request $request)
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
        'shcitylist' => $districtOptions  // Return the options as a response
    ]);
}

public function getfandfrepor(Request $request)
{
    $state = $request->input('state');  // Make sure the variable matches the one from AJAX

    // Fetch districts based on state_id
    $districts = DB::table('city_list')->where('state_code', $state)
        ->select('id', 'city_name')->get();

    // Build the HTML for the city options
    $districtOptions = '<option value="">-- Choose City --</option>';
    foreach ($districts as $district) {
        $districtOptions .= "<option value='" . $district->id . "'>" . $district->city_name . "</option>";
    }

    return response()->json([
        'city' => $districtOptions  // Return the options as a response
    ]);
}


public function getfandfrep(Request $request)
{
    $category = $request->input('category');  // Make sure the variable matches the one from AJAX

    // Fetch districts based on state_id
    $products = DB::table('products')->where('Productcategory', $category)
        ->select('id', 'productname')->get();

    // Build the HTML for the city options
    $productOptions = '<option value="">-- Choose  Products --</option>';
    foreach ($products as $produ) {
        $productOptions .= "<option value='" . $produ->id . "'>" . $produ->productname . "</option>";
    }

    return response()->json([
        'products' => $productOptions  // Return the options as a response
    ]);
}


public function storedesign(Request $request)
{
    $request->validate([
        'drawing.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        'offer.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
    ]);

    $commonData = [
        'leadiid' => $request->leadiid,
        'catename' => $request->catename,
        'proname' => $request->proname,
        'design' => $request->design,
        'assignee' => auth()->id(),
        'reverse' => (auth()->id() == ($request->assigneeto ?? null)) ? 1 : 0,
    ];

    $drawingFiles = $request->file('drawing');
    $offerFiles = $request->file('offer');
    $basicsupplies = $request->basicsupply;

    // If basicsupply is provided (Design Login)
    if ($basicsupplies && is_array($basicsupplies)) {
        foreach ($basicsupplies as $index => $basicsupply) {
            $data = $commonData;

            // Handle Drawing File
            if (isset($drawingFiles[$index])) {
                $drawingFile = $drawingFiles[$index];
                $drawingFilename = time() . '_drawing_' . $drawingFile->getClientOriginalName();
                $drawingFile->move(public_path('assets/images/'), $drawingFilename);
                $data['drawing'] = 'assets/images/' . $drawingFilename;
            }

            // Handle Offer File
            if (isset($offerFiles[$index])) {
                $offerFile = $offerFiles[$index];
                $offerFilename = time() . '_offer_' . $offerFile->getClientOriginalName();
                $offerFile->move(public_path('assets/images/'), $offerFilename);
                $data['offer'] = 'assets/images/' . $offerFilename;
            }

            // Assign Other Inputs
            $data['basicsupply'] = $basicsupply;
            $data['freightvalue'] = $request->freightvalue[$index] ?? null;
            $data['installvalue'] = $request->installvalue[$index] ?? null;
            $data['pricevalue'] = $request->pricevalue[$index] ?? null;

            LeadDesign::create($data);
        }
    }
    // If only GA Drawing is provided (Non-Design Login)
    elseif ($drawingFiles) {
        foreach ($drawingFiles as $index => $drawingFile) {
            $data = $commonData;
            $drawingFilename = time() . '_drawing_' . $drawingFile->getClientOriginalName();
            $drawingFile->move(public_path('assets/images/'), $drawingFilename);
            $data['drawing'] = 'assets/images/' . $drawingFilename;

            LeadDesign::create($data);
        }
    }

    return redirect()->back()->with('success', 'Designs saved successfully!');
}



// public function updateStatusdf(Request $request)
// {
//     // Find the lead
//     $lead = Lead::find($request->lead_id);

//     if ($lead) {
//         // Update lead details
//         $lead->Leadstatus = $request->status;
//         $lead->category = $request->category;
//         $lead->products = $request->products;
//         // $lead->remarks = $request->remarks;
//         $lead->save();

//         // Check if status is 'CONVERTED'
//         if ($request->status == '343') {
//             // Check if the mobile number already exists in the customer table
//             $existingCustomer = Customer::where('contact_no', $lead->phonumber)->first();

//             if (!$existingCustomer) {
//                 // Insert data into customer table only if the customer does not exist
//                 $customer = new Customer();
//                 $customer->customername = $lead->LeadName;
//                 $customer->contact_name = $lead->contactname;
//                 $customer->cus_email = $lead->email;
//                 $customer->country_code = $lead->countrycode;
//                 $customer->contact_no = $lead->phonumber;
//                 $customer->department = $lead->department;
//                 $customer->designation = $lead->designation;
//                 $customer->address = $lead->billaddress;
//                 $customer->country = $lead->billingcountry;
//                 $customer->city = $lead->citylist;
//                 $customer->state = $lead->state_id;
//                 $customer->postalcode = $lead->postalcode;
//                 $customer->gstno = $lead->gst;
//                 $customer->save();

//                 // Generate cusid after saving customer
//                 $customer->cusid = 'CUS' . str_pad($customer->id, 4, '0', STR_PAD_LEFT);
//                 $customer->save();

//                 // Update the 'customeriid' in the leads table
//                 $lead->customeriid = $customer->cusid;
//                 $lead->save();
//             } else {
//                 // If the customer already exists, update the lead with the existing customer ID
//                 $lead->customeriid = $existingCustomer->cusid;
//                 $lead->save();
//             }
//         }

//         return response()->json(['success' => true, 'message' => 'Lead and products updated successfully']);
//     }

//     return response()->json(['success' => false, 'message' => 'Lead not found']);
// }


public function updateStatusdf(Request $request)
{
    // Find the lead
    $lead = Lead::find($request->lead_id);

    if ($lead) {
        // Update lead details
        $lead->Leadstatus = $request->status;
        $lead->category = $request->category;
        $lead->products = $request->products;
        $lead->remarks = $request->remarks;
        $lead->converteddate = $request->converteddate;
        $lead->save();

        $customerId = null;

        // Check if status is 'CONVERTED'
        if ($request->status == '343') {
            // Check if the mobile number already exists in the customer table
            $existingCustomer = Customer::where('contact_no', $lead->phonumber)->first();

            if (!$existingCustomer) {
                // Insert data into customer table only if the customer does not exist
                $customer = new Customer();
                $customer->customername = $lead->LeadName;
                $customer->contact_name = $lead->contactname;
                $customer->cus_email = $lead->email;
                $customer->country_code = $lead->countrycode;
                $customer->contact_no = $lead->phonumber;
                $customer->department = $lead->department;
                $customer->designation = $lead->designation;
                $customer->address = $lead->billaddress;
                $customer->country = $lead->billingcountry;
                $customer->city = $lead->citylist;
                $customer->state = $lead->state_id;
                $customer->postalcode = $lead->postalcode;
                $customer->gstno = $lead->gst;
                $customer->save();

                // Generate cusid after saving customer
                $customer->cusid = 'CUS' . str_pad($customer->id, 4, '0', STR_PAD_LEFT);
                $customer->save();

                $customerId = $customer->cusid;
            } else {
                $customerId = $existingCustomer->cusid;
            }

            // Update the 'customeriid' in the leads table
            $lead->customeriid = $customerId;
            $lead->save();
        }

        // Determine the table for insertion
        // $categoriesForDesign = [354, 355, 358];
        $categoriesForDesign = ProductCategory::where('id', $request->category)
                                     ->where('sub_category', 'special')
                                     ->exists();

        // if (in_array($request->category, $categoriesForDesign)) {
            if ($categoriesForDesign) {
            // Insert into `designs` table
            Design::create([
                'idlead' => $lead->id,
                'idcustomer' => $customerId,
                'product' => $request->products,
                'category' => $request->category,
                'ganumber' => $request->ga_number,
                'quantity' => $request->quantity
            ]);
        } else {
            // Insert into `quotations` table
            Quotation::create([
                'id_lead' => $lead->id,
                'id_customer' => $customerId,
                'products' => $request->products,
                'categorys' => $request->category,
                'ga_number' => $request->ga_number,
                'quantitys' => $request->quantity,
                'quota_id' => 'QUTO/' . date('Y') . '/' . str_pad(Quotation::max('id') + 1, 4, '0', STR_PAD_LEFT)
            ]);
            $lead->quota_proceed = 1;
            $lead->save();
        }

        return response()->json(['success' => true, 'message' => 'Lead and products updated successfully']);
    }

    return response()->json(['success' => false, 'message' => 'Lead not found']);
}


public function designapproval(Request $request)
{
 // Validate the request
 $request->validate([
    'quota_doc' => 'nullable|file|mimes:jpg,png,pdf,doc,docx|max:2048', // Adjust file types & size as needed
    // 'quota_proceed' => 'required',
    // 'idle' => 'required|exists:leads,id',
]);

DB::beginTransaction();

try {
    // Handle File Upload
    if ($request->hasFile('quota_doc')) {
        $file = $request->file('quota_doc');
        $filename = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('assets/images/');
        $file->move($destinationPath, $filename);
        $filePath = 'assets/images/' . $filename;
    } else {
        $filePath = null;
    }

    // Update the `leads` table
    Lead::where('id', $request->idle)->update([
        'quota_proceed' => $request->quota_proceed,
        'quota_doc' => $filePath,
    ]);

    // Fetch data from `designs` table where `idle` matches
    $designs = Design::where('idlead', $request->idle)->get();

    // Insert data into `quotations` table
    foreach ($designs as $design) {
        Quotation::create([
            'id_lead' => $design->idlead,
            'id_customer' => $design->idcustomer,
            'products' => $design->product,
            'categorys' => $design->category,
            'ga_number' => $design->ganumber,
            'quantitys' => $design->quantity,
            'quota_id' => 'QUTO/' . date('Y') . '/' . str_pad(Quotation::max('id') + 1, 4, '0', STR_PAD_LEFT)
        ]);
    }

    DB::commit();

    return redirect()->route('pages.viewconverted')->with('success', 'Data successfully updated and inserted.');

} catch (\Exception $e) {
    DB::rollBack();
    return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
}

}

// public function createestimate(Request $request)
// {
//     $quotationProduct = QuotationProduct::create([
//         'leadno' => $request->leadno,
//         'quotationno' => $request->quotationno,
//         'cliname' => $request->clientname,
//         'placeofsupply' => $request->placeofsupply,
//         'gstnum' => $request->gstnum,
//         'catepro' => $request->catepro,
//         'product' => $request->product,
//         'part_no' => $request->part_no,
//         'quanty' => $request->quanty,
//         'allowdis' => $request->allowdis,
//         'requestdis' => $request->requestdis,
//         'ratee' => $request->ratee,
//         'price' => $request->price,
//         'priceamt' => $request->priceamt,
//         'lbt' => $request->lbt,
//         'tax' => $request->tax,
//         'taxamt' => $request->taxamt,
//         'grandtotal' => $request->grandtotal,
//     ]);

//     Freight::create([
//         'leadnumber' => $request->leadno,
//         'quotationno' => $request->quotationno,
//         'termscondition' => $request->termscondition,
//         'dov' => $request->dov,
//         'freight' => $request->freight,
//         'exwork' => $request->exwork,
//         'freightextra' => $request->freightextra,
//         'unloading' => $request->unloading,
//         'remarks' => $request->remarks,
//         'currency' => $request->currency,
//         'warranty' => $request->warranty,
//         'installation' => $request->installation,
//         'agent' => $request->agent,
//         'amount' => $request->ammt,
//     ]);

//     return redirect()->route('single.quota', ['leadid' => $quotationProduct->leadno])
//                      ->with('success', 'Estimate created successfully!');
// }

public function createestimate(Request $request)
{
    DB::beginTransaction();

    try {
        // Insert into QuotationProduct
        $quotationProduct = QuotationProduct::create([
            'leadno' => $request->leadno,
            'quotationno' => $request->quotationno,
            'cliname' => $request->clientname,
            'placeofsupply' => $request->placeofsupply,
            'shippingcountry' => $request->shippingcountry,
            'shistate_id' => $request->shistate_id,
            'shippostalcode' => $request->shippostalcode,
            'shcitylist' => $request->shcitylist,
            'gstnum' => $request->gstnum,
            'catepro' => $request->catepro,
            'product' => $request->product,
            'part_no' => $request->part_no,
            'quanty' => $request->quanty,
            'allowdis' => $request->allowdis,
            'requestdis' => $request->requestdis,
            'ratee' => $request->ratee,
            'price' => $request->price,
            'priceamt' => $request->priceamt,
            'lbt' => $request->lbt,
            'tax' => $request->tax,
            'taxamt' => $request->taxamt,
            'grandtotal' => $request->grandtotal,
        ]);

        // Handle Terms Condition
        if ($request->termscondition === 'new' && $request->newtermscondition) {
            $term = Term::create([
                'content' => $request->newtermscondition,
                'termtype' => 1, // 1 for Terms & Conditions
                'term_approve' => 1,
            ]);
            $termsConditionId = $term->id;
        } else {
            $termsConditionId = $request->termscondition;
        }

        // Handle Warranty Condition
        if ($request->warranty === 'new' && $request->newwarcondition) {
            $warrantyTerm = Term::create([
                'content' => $request->newwarcondition,
                'termtype' => 2, // 2 for Warranty Terms
                'term_approve' => 1,
            ]);
            $warrantyId = $warrantyTerm->id;
        } else {
            $warrantyId = $request->warranty;
        }

        // Insert into Freight
        Freight::create([
            'leadnumber' => $request->leadno,
            'quotationno' => $quotationProduct->id,
            'termscondition' => $termsConditionId,
            'dov' => $request->dov,
            'freight' => $request->freight,
            'exwork' => $request->exwork,
            'freightextra' => $request->freightextra,
            'unloading' => $request->unloading,
            'remarks' => $request->remarks,
            'currency' => $request->currency,
            'warranty' => $warrantyId,
            'installation' => $request->installation,
            'agent' => $request->agent,
            'amount' => $request->ammt,
        ]);

        DB::commit();

        return redirect()->route('single.quota', ['leadid' => $quotationProduct->leadno])
                         ->with('success', 'Estimate created successfully!');
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

public function generatePDF($id)
    {
        $quotation = QuotationProduct::with('lead')->findOrFail($id);

        // Replace "/" with "-" in the filename to avoid errors
        $safeFilename = str_replace("/", "-", $quotation->quotationno);

        // $pdf = Pdf::loadView('quotations.pdf', compact('quotation'));

        // Return the PDF with a safe filename
        // return $pdf->stream($safeFilename . '.pdf');
    }

    public function viewQuotation($id)
    {
        $quotation = QuotationProduct::with(['lead', 'product'])
        ->where('id', $id)
        ->firstOrFail();
        // dd($quotation->toArray());
        return view('quotations.pdf', compact('quotation'));
    }


    public function createorf($id){
        $quto = QuotationProduct::with(['lead'])->find($id);

        $estimates = QuotationProduct::where('leadno', $quto->leadno)
                                ->orderBy('id', 'DESC')
                                ->get();

    $i = count($estimates);



        // Pass lead data to the view
        return view('pages.orfform', compact('quto', 'estimates', 'i'));

    }

}
