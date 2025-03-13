<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Vendor;
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
            'rate' => $request->rate,
            'partno' => $request->partno,
            'Productcategory' => $request->Productcategory,
            'productdes' => $request->productdes,
            'quantity' => $request->quantity,
        ]);

        if ($product) {
            return redirect()->route('products')->with('success', 'Product added successfully!');
        } else {
            return redirect()->back()->with('error', 'Product insert error, Please try again.');
        }

    }

    public function updateProductData($productId)
    {
        $productData = Product::with(['category'])->where('id', $productId)->first();



        return view('pages.masters.editProducts', compact('productData'));
    }

    public function updateProduct(Request $request)
    {
        $product = Product::find($request->productId);
        $product->update([
            'productname' => $request->productname,
            'hsn' => $request->hsn,
            'gst' => $request->gst,
            'rate' => $request->rate,
            'partno' => $request->partno,
            'Productcategory' => $request->Productcategory,
            'productdes' => $request->productdes,
            'quantity' => $request->quantity,
        ]);

        if ($product) {
            return redirect()->route('products')->with('success', 'Product Updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Product update error, Please try again.');
        }

    }



    public function productCategoryList()
    {
        $productCategory = ProductCategory::get();
        return view('pages.masters.productCategory', compact('productCategory'));

    }

    public function products()
    {
        $products = Product::with(['category'])->get();
        return view('pages.product', compact('products'));

    }

    public function getProductData($catId)
    {
        $productData = Product::where('Productcategory', $catId)->get();

        $category = ProductCategory::find($catId);

        $vendors = [];

        if($category->vendor_id != null){
            $vendorIds = json_decode($category->vendor_id, true);
            $vendors = Vendor::whereIn('id', $vendorIds)->get();
        }

        

        return response()->json(['productData' => $productData, 'vendors' => $vendors],200);
    }

}
