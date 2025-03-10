<?php

namespace App\Http\Controllers;

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

        if ($vendor->save()) {
            return redirect()->route('pages.vendor.vendorList')->with('success', 'Vendor Details successfully!');
        } else {
            return redirect()->route('pages.vendor.addVendors')->with('error', 'Something went wrong, Please try again');
        }
    }

    public function viewPurchaseOrder()
    {
        return view('pages.vendor.purchaseOrder');
    }
}
