<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function customer()
    {
        $customer = Customer::get();
        return view('pages.customer', compact('customer'));

    }

    public function savecustomer(Request $request)
    {
        $customer = Customer::create($request->all());

    // Generate cusid based on the ID
    $customer->cusid = 'CUS' . str_pad($customer->id, 4, '0', STR_PAD_LEFT);
    $customer->save();

        return redirect()->route('pages.customer')->with('success', 'Customer saved successfully!');

    }

    public function getCustomerData($id)
{
    $customer = Customer::find($id);
    if ($customer) {
        return response()->json([
            'contactname' => $customer->contact_name,
            'contact_no' => $customer->contact_no,
            'address' => $customer->address,
            'postalcode' => $customer->postalcode,
            'country_code' => $customer->country_code,
            'country' => $customer->country,
            'state' => $customer->state,
            'city' => $customer->city,
            'gstno' => $customer->gstno,
            'cus_email' => $customer->cus_email,// Assuming the customer has a 'contactname' column
        ]);
    }
    return response()->json(null);
}



}
