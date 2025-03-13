<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function addCategoryFunction(Request $request)
    {
        $category = new ProductCategory;

        $category->category_name = $request->category_name;
        $category->sub_category = $request->sub_category;
        $category->type = $request->type;

        if ($category->save()) {
            return redirect()->route('product-categories')->with('success', 'Category Added Successfully!');
        } else {
            return redirect()->route('product-categories')->with('error', 'Something went wrong, Please try again');
        }

    }

    public function editCategoryFunction(Request $request)
    {

        $category = ProductCategory::find($request->catid);

        $category->category_name = $request->edit_category_name;
        $category->sub_category = $request->edit_sub_category_name;
        $category->type = $request->edit_type;

        if ($category->update()) {
            return redirect()->route('product-categories')->with('success', 'Category Edited Successfully!');
        } else {
            return redirect()->route('product-categories')->with('error', 'Something went wrong, Please try again');
        }

    }

    public function deleteCategoryFunction($catId)
    {
        $category = ProductCategory::find($catId);

        if ($category->delete()) {
            return redirect()->route('product-categories')->with('success', 'Category Deleted Successfully!');
        } else {
            return redirect()->route('product-categories')->with('error', 'Something went wrong, Please try again');
        }

    }

}
