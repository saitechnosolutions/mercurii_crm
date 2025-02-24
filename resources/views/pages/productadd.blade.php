@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')

<section class="section leadsection" >
    <div class="container form-card">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6 mb-2">
                        <h5 class="mt-2 ">Add Product</h5>
                    </div>
                </div>
            </div>
        </div>
<form class="myForm" method="POST" action="{{ route('products.store') }}">
    <div class="row mb-4">
    @csrf
    <div class="col-lg-6" >
        <div class="form-group mb-2">
        <label for="exampleFormControlInput1" class="form-label">Product Category <span
                style="color:red">*</span></label>
        <select class="form-select " name="Productcategory" required>
            <option value="">-- Choose Category --</option>
            @if ($status = App\Models\Dropdowndata::where('formid', 7)->orderBy('orderno', 'asc')->get())
                @foreach ($status as $data)
                    <option value="{{ $data->id }}"
                        >
                        {{ $data->dropdowndata }}</option>
                @endforeach
            @endif

        </select>

    </div>
    </div>
    <div class="col-lg-6" >
        <div class="form-group mb-2">
            <label class="form-label">Product Name <span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="productname" placeholder="Productname" required>
        </div>
    </div>
    <div class="col-lg-6" >
        <div class="form-group mb-2">
            <label class="form-label">Part NO <span class="mandatory">*</span></label>
            <input type="text" class="form-control " name="partno" placeholder="Part no" required>
        </div>
    </div>
    <div class="col-lg-6" >
        <div class="form-group mb-2">
            <label class="form-label">Rate <span class="mandatory">*</span></label>
            <input type="text" class="form-control " name="rate" placeholder="Rate" required>
        </div>
    </div>
    <div class="col-lg-6" >
        <div class="form-group mb-2">
            <label class="form-label">HSN <span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="hsn" placeholder="HSN" required>
        </div>
    </div>
    <div class="col-lg-6" >
        <div class="form-group mb-2">
            <label class="form-label">UOM <span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="uom" placeholder="UOM" required>
        </div>
    </div>
    <div class="col-lg-6" >
        <div class="form-group mb-2">
            <label class="form-label">GST <span class="mandatory">*</span></label>
            <input type="text" class="form-control" name="gst" placeholder="GST" required>
        </div>
    </div>
    <div class="col-lg-6" >
        <div class="form-group mb-2">
            <label for="exampleFormControlInput1"
                class="form-label">Product Description <span
                style="color:red">*</span></label>
                <textarea name="productdes" class="form-control" placeholder="Product Description"  required ></textarea>
        </div>
    </div>


    </div>
    <button type="submit" class="btn btn-primary">Add product</button>
</form>
    </div>
</section>

@endsection
