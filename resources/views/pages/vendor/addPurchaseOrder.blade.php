@extends('layouts.app')
@section('title', 'Add Vendor Details')
@section('main-content')


    <div class="container">
        <h4 class="mt-4 mb-5 text-center">Create Purchase Order</h4>
    </div>
    <section class="section leadsection">

        <div class="container form-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-2 mt-3">
                            <a href="/purchase-order-details" class="btn btn-primary d-block add-employee-btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="/save-po" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4 po-form-box position-relative">
                    <!-- product category drop -->
                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="customerSelect" class="form-label">
                                        Product Category <span style="color:red">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select class="form-select product_category_po" id="product_category_po" name="catId[]"
                                    required>
                                    <option value="">-- Choose Category --</option>
                                    @if ($status = App\Models\ProductCategory::get())
                                        @foreach ($status as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->category_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- products drop -->
                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="customerSelect" class="form-label">
                                        Products <span style="color:red">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select class="form-select products_dropdown_po" name="proId[]" required>
                                    <!-- comes from ajax -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Vendor Name dropdwon -->
                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="customerSelect" class="form-label">
                                        Vendor <span style="color:red">*</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <select class="form-select vendor_dropdown_po" name="vendorId[]" required>
                                    <!-- comes from ajax -->
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Existing Quantity<span
                                    style="color:red">*</span></label>
                            <input type="text" name="existQty[]" class="form-control po_exist_qty" id="po_exist_qty"
                                required readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Unit Price <span
                                    style="color:red">*</span></label>
                            <input type="text" name="unit_price[]" class="form-control po_unit_price" id="po_unit_price"
                                required readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Required Quantity<span
                                    style="color:red">*</span></label>
                            <input type="text" name="qty[]" class="form-control po_qty" id="po_qty" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">GST<span
                                    style="color:red">*</span></label>
                            <input type="text" name="gst[]" class="form-control po_gst" id="po_gst" required readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Product Total <span
                                            style="color:red">*</span></label>
                                    <input type="decimal" name="product_total[]" id="pro_tot_amt"
                                        class="form-control pro_tot_amt" required readonly>
                                    <input type="hidden" name="sub_total[]" class="product_subtotal">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group mt-4 d-flex" style="align-items: center;height: 100%">
                                    <input type="checkbox" class="roundoffCheckbox">
                                    <span class="ms-2"><label for="roundoff" style="margin:0">Round off</label></span>
                                    <input type="hidden" name="roundoff[]" class="roundoff" value="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Product Description</label>
                            <textarea name="pro_des[]" class="form-control pro_des" id="pro_des"></textarea>
                        </div>
                    </div>

                </div>

                <div class="multi-field-btn">
                    <button type="button" class="btn btn-warning my-4" id="po_add_product_plus">Add Another
                        Product</button>
                    <div class="po-remove-btn">
                        <i class="fas fa-trash"></i>
                    </div>
                </div>



                <div class="row">
                    <div class="col-lg-6">
                        <div class="text-start">
                            <label for="exampleFormControlInput1" class="form-label">File Attachment</label>
                            <input type="file" name="po_attachment" style="text-transform:uppercase;" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label for="exampleFormControlInput1" class="form-label">Terms and Condition</label>
                        <select class="form-select terms_condition_id" name="terms_condition_id" required>
                            <option value="">-- Choose Category --</option>
                            @if ($status = App\Models\Term::get())
                                @foreach ($status as $data)
                                    <option value="{{ $data->id }}">
                                        {{ $data->content }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary m-auto d-block mt-5 mb-3 form-submit-btn">Create</button>
            </form>

        </div>
    </section>
@endsection