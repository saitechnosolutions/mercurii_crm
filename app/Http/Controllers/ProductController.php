<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // Directly create the user without any validation
        $product = Product::create([
            'productname' => $request->productname,
            'hsn' => $request->hsn,
            'gst' => $request->gst,
            'uom' => $request->uom,
            'rate' => $request->rate,
            'partno' => $request->partno,
            'Productcategory' => $request->Productcategory,
            'productdes' => $request->productdes,
        ]);

        return redirect()->route('products')->with('success', 'Product added successfully!');
        // return redirect()->back()->with('success', 'User added successfully');
    }


    public function products()
    {
        $products = Product::with('category')->get();
        return view('pages.product', compact('products'));

    }

}
