@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')

    <div class="container">
    <h4 class="mt-3 mb-4 text-center">Edit Product</h4>
    </div>

    <section class="section leadsection">
        <div class="container form-card">
            <form class="myForm" method="POST" action="{{ route('products.update') }}">
                <div class="row mb-4 mt-4">
                    @csrf
                    <input type="hidden" value="{{ $productData->id }}" name="productId">
                    <div class="col-lg-6">
                        <div class="form-group mb-2">
                            <label for="exampleFormControlInput1" class="form-label">Product Category <span
                                    style="color:red">*</span></label>
                            <select id="product_category_select" class="form-select " name="Productcategory" required>
                                <option value="">-- Choose Category --</option>
                                @if ($status = App\Models\ProductCategory::get())
                                    @foreach ($status as $data)
                                        <option value="{{ $data->id }}" @if ($data->id == $productData->Productcategory) selected @endif>
                                            {{ $data->category_name }}
                                        </option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Product Name <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="productname" placeholder="Productname" value="{{ $productData->productname }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Quantity<span class="mandatory">*</span></label>
                            <input type="text" class="form-control " name="quantity" placeholder="Type here.." value="{{ $productData->quantity }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Part NO <span class="mandatory">*</span></label>
                            <input type="text" class="form-control " name="partno" placeholder="Part no" value="{{ $productData->partno }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">Rate <span class="mandatory">*</span></label>
                            <input type="text" class="form-control " name="rate" placeholder="Rate" value="{{ $productData->rate }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">HSN <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="hsn" placeholder="HSN" value="{{ $productData->hsn }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label class="form-label">GST <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="gst" placeholder="GST" value="{{ $productData->gst }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Product Description</label>
                            <textarea name="productdes" class="form-control" placeholder="Product Description">{{ $productData->productdes }}</textarea>
                        </div>
                    </div>


                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mb-3">Update</button>
                </div>
            </form>
        </div>
    </section>

@endsection