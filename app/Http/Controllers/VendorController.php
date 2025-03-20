<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\PurchaseEntry;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\DataTables\VendorDataTable;

class VendorController extends Controller
{
    public function viewVendors(VendorDataTable $dataTable)
    {
        return $dataTable->render('pages.vendor.vendorList');
    }

    public function saveVendors(Request $request)
    {
        $vendor = new Vendor();

        $vendor->company_name = $request->input('company_name');
        $vendor->alternate_name = $request->input('alternate_name');
        $vendor->point_of_contact = $request->input('poc_name');
        $vendor->contact_number = $request->input('contact_number');
        $vendor->email = $request->input('email');
        $vendor->gst_number = $request->input('gst_number');
        $vendor->address = $request->input('address');
        $vendor->country_id = $request->input('address');
        $vendor->state_id = $request->input('state_id');
        $vendor->city_id = $request->input('city_id');
        $vendor->postal_code = $request->input('postal_code');
        $vendor->vendor_status = $request->input('vendor_status');
        $vendor->product_cat_id = json_encode($request->input('pro_cat_id'), true);



        // to generate vendorId
        function incrementCode($code)
        {
            // Split the code into parts
            $parts = explode('-', $code);

            // Get the numeric part and increment it
            $number = (int) $parts[2] + 1;

            // Format back with leading zeros
            return sprintf('%s-%s-%03d', $parts[0], $parts[1], $number);
        }

        $lastInserted = Vendor::latest()->first();

        if ($lastInserted == null) {
            $vendorId = incrementCode("MIS-VEN-000");
        } else {
            $vendorId = incrementCode($lastInserted->vendor_id);
        }


        $vendor->vendor_id = $vendorId;

        $isVendorInsert = $vendor->save();
        $lastInserted = Vendor::latest()->first();



        // to find existing category to insert vendorid



        foreach ($request->input('pro_cat_id') as $key => $value) {
            $category = ProductCategory::find($value);
            $vendorIdArray = [];
            if ($isVendorInsert) {
                if ($category->vendor_id == null) {
                    array_push($vendorIdArray, (int) $lastInserted->id);
                } else {
                    $vendorIdArray = json_decode($category->vendor_id);
                    array_push($vendorIdArray, $lastInserted->id);
                }
                $category->vendor_id = json_encode($vendorIdArray);
                $category->update();


            } else {

            }
        }

        if ($isVendorInsert) {
            return redirect()->route('pages.vendor.vendorList')->with('success', 'Vendor Details successfully!');
        } else {
            return redirect()->route('pages.vendor.addVendors')->with('error', 'Something went wrong, Please try again');
        }




    }

    // delete po function

    public function deletePO($poId)
    {
        $deletePo = PurchaseOrder::where('id', $poId)->delete();
        if ($deletePo) {
            return back()->with('delete-success', 'Purchase order deleted successfully');
        } else {
            return back()->with('delete-error', 'Something went wrong');
        }
    }

    public function viewPurchaseOrder()
    {
        $poDetails = PurchaseOrder::with(['vendorDetails', 'productDetails', 'categoryDetails'])->orderBy('id', 'desc')->get();

        return view('pages.vendor.purchaseOrder', compact('poDetails'));
    }

    public function viewPOInvoice($invoiceId)
    {
        $poDetails = PurchaseOrder::with(['vendorDetails', 'productDetails', 'categoryDetails'])->where('id', $invoiceId)->first();

        return view('pages.vendor.po_invoice', compact('poDetails'));
    }

    public function savePo(Request $request)
    {


        function generatePONumber($lastPONumber = null)
        {
            // Get current date
            $currentYear = date('Y');
            $currentMonth = date('m');

            // Calculate financial year
            if ($currentMonth >= 4) { // From April to December
                $startYear = $currentYear % 100;  // Last two digits of year
                $endYear = ($currentYear + 1) % 100;
            } else { // From January to March (Still in previous financial year)
                $startYear = ($currentYear - 1) % 100;
                $endYear = $currentYear % 100;
            }

            // Format financial year as "24-25"
            $financialYear = sprintf("%02d-%02d", $startYear, $endYear);

            // Determine next PO number
            if ($lastPONumber) {
                $lastNumber = (int) substr($lastPONumber, strrpos($lastPONumber, '/') + 1);
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }

            // Generate PO number
            return "MIS/PO/$financialYear/" . str_pad($nextNumber, 3, "0", STR_PAD_LEFT);
        }

        $catId = $request->catId;
        $proId = $request->proId;
        $vendorId = $request->vendorId;
        $existQty = $request->existQty;
        $unit_price = $request->unit_price;
        $qty = $request->qty;
        $gst = $request->gst;
        $sub_total = $request->sub_total;
        $product_total = $request->product_total;
        $product_description = $request->pro_des;
        $roundoff = $request->roundoff;
        $termsConditionId = $request->terms_condition_id;
        $fileAttach = $request->file("po_attachment");

        $filename = time() . '_po_' . $fileAttach->getClientOriginalName();
        $fileAttach->move(public_path('uploads/'), $filename);




        foreach ($catId as $key => $value) {

            $lastInserted = PurchaseOrder::latest()->first();

            if ($lastInserted == null) {
                $newPONumber = generatePONumber("MIS/PO/24-25/286");
            } else {

                if ($key < 1) {
                    $lastPONumber = $lastInserted->po_no;

                    $newPONumber = generatePONumber($lastPONumber);
                } else {
                    $newPONumber = $lastInserted->po_no;
                }

            }

            PurchaseOrder::create([
                "cat_id" => $value,
                "po_no" => $newPONumber,
                "product_id" => $proId[$key],
                "vendor_id" => $vendorId[$key],
                "product_qty" => $existQty[$key],
                "unit_price" => $unit_price[$key],
                "product_total_price" => $qty[$key],
                "gst_amount" => $gst[$key],
                "sub_total" => $sub_total[$key],
                "total_amount" => $product_total[$key],
                "product_description" => $product_description[$key],
                "roundoff" => $roundoff[$key] ?? 0,
                "files" => $filename,
                "terms_condition_id" => $termsConditionId,
            ]);
        }

        // $lastInserted = PurchaseOrder::latest()->first();

        // PurchaseOrder::where('id',$lastInserted->id)->update(['files',$filename]);

        return redirect()->route('purchase-order-details-page')->with('success', 'Purchase order created successfully');
    }

    // get po details

    public function getPoDetails(Request $request)
    {
        $poNo = $request->poNo;
        $poDetails = PurchaseOrder::with(['categoryDetails','vendorDetails'])->where("po_no", $poNo)->get();
        if ($poDetails) {
            return response()->json(['status'=>'success','poDetails' => $poDetails], 200);
        }else{
            return response()->json(['status' => "error"], 500);
        }
    }

    public function getPoProDetails(Request $request)
    {
        $poNo = $request->poNo;
        $proId = $request->proId;
        $poDetails = PurchaseOrder::where("po_no", $poNo)->where('product_id',$proId)->first();
        if ($poDetails) {
            return response()->json(['status'=>'success','poDetails' => $poDetails], 200);
        }else{
            return response()->json(['status' => "error"], 500);
        }
    }

    public function savePE(Request $request)
    {

        $catId = $request->catId;
        $proId = $request->proId;
        $poNumber = $request->po_number;
        $vendorId = $request->vendorId;
        $pe_req_qty = $request->pe_req_qty;
        $pe_received_qty = $request->pe_received_qty;
        $pe_pending_qty = $request->pe_pending_qty;
        $unit_price = $request->unit_price;
        $gst = $request->gst;
        $sub_total = $request->sub_total;
        $product_total = $request->product_total;

        foreach ($catId as $key => $value) {

            PurchaseEntry::create([
                "cat_id" => $value,
                "po_no" => $poNumber[$key],
                "product_id" => $proId[$key],
                "vendor_id" => $vendorId[$key],
                "requested_qty" => $pe_req_qty[$key],
                "received_qty" => $pe_received_qty[$key],
                "pending_qty" => $pe_pending_qty[$key],
                "unit_price" => $unit_price[$key],
                "product_total_price" => $product_total[$key],
                "gst_amount" => $gst[$key],
                "sub_total" => 0,
                "total_amount" => 0,
            ]);
        }

        // $lastInserted = PurchaseOrder::latest()->first();

        // PurchaseOrder::where('id',$lastInserted->id)->update(['files',$filename]);

        return redirect()->route('purchase-entry-details')->with('success', 'Purchase entry created successfully');
    }
}
