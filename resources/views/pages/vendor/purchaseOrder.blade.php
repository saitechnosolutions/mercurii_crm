@extends('layouts.app')
@section('title', 'Vendors Details')
@section('main-content')

    {{-- @include('sweetalert::alert') --}}

    <section class="section leadsection container">
        <div class=" form-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mt-2">Purchase Order Details</h5>
                        </div>
                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-2">
                            <a href="/create-po" class="btn btn-primary d-block add-employee-btn">Create PO</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="container mt-5">
        <div class="card">
            <div class="card-header">All Vendors</div>
            <div class="card-body">
                <table id="purchase-order-table" class="display">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Prodcut Category</th>
                            <th>Products</th>
                            <th>Vendor</th>
                            <th>Existing Quantity</th>
                            <th>Required Quantity</th>
                            <th>Unit Price</th>
                            <th>Product Total</th>
                            <th>Print</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="add_po_modal" aria-hidden="true" aria-labelledby="add_po_modalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_po_modalLabel">Create Purchase Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        <div class="row mb-4">
                            @csrf
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
                                        <select class="form-select " name="countrycode" id="product_category_po" required>
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
                                        <select class="form-select " name="countrycode" id="products_dropdown_po" required>
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
                                        <select class="form-select " name="vendorId" id="vendor_dropdown_po" required>
                                            <!-- comes from ajax -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Existing Quantity<span
                                            style="color:red">*</span></label>
                                    <input type="text" name="exist_qty" class="form-control" id="po_exist_qty" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Unit Price <span
                                            style="color:red">*</span></label>
                                    <input type="text" name="unit_price" class="form-control" id="po_unit_price" required
                                        readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Required Quantity<span
                                            style="color:red">*</span></label>
                                    <input type="text" name="qty" class="form-control" id="po_qty" value="1" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">GST<span
                                            style="color:red">*</span></label>
                                    <input type="text" name="gst" class="form-control" id="po_gst" required readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Product Total <span
                                            style="color:red">*</span></label>
                                    <input type="decimal" name="product_total" id="pro_tot_amt" class="form-control"
                                        required readonly>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4 d-flex" style="align-items: center;height: 100%">

                                    <input type="checkbox" name="roundoff" id="roundoff">
                                    <span class="ms-2"><label for="roundoff" style="margin:0">Round off</label></span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4 d-flex" style="align-items: center;height: 100%">

                                    <input type="checkbox" name="roundoff" id="roundoff">
                                    <span class="ms-2"><label for="roundoff" style="margin:0">Round off</label></span>
                                </div>
                            </div>


                        </div>

                        <button type="submit"
                            class="btn btn-primary m-auto d-block add-employee-btn mt-4 mb-2">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- edit purchase order -->

    <div class="modal fade modal-lg" id="edit_po_modal" aria-hidden="true" aria-labelledby="edit_po_modalLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edit_po_modalLabel">Edit Purchase Order Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        <div class="row mb-4">
                            @csrf
                            <!-- Company Name Field -->
                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="customerSelect" class="form-label">
                                        Vendor <span style="color:red">*</span>
                                    </label>
                                    <select class="form-select " name="countrycode" id="country_code" required>
                                        <option value="">
                                            Choose Vendor
                                        </option>
                                        <option value="">
                                            Today Company
                                        </option>
                                        <option value="">
                                            Yesterday Company
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="customerSelect" class="form-label">
                                        Products <span style="color:red">*</span>
                                    </label>

                                    <select class="form-select " name="countrycode" id="country_code" required>
                                        <option value="">
                                            Choose Product
                                        </option>
                                        <option value="">
                                            Wire Decking
                                        </option>
                                        <option value="">
                                            Base Plates
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Quantity<span
                                            style="color:red">*</span></label>
                                    <input type="text" name="qty" class="form-control" placeholder="0" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Unit Price <span
                                            style="color:red">*</span></label>
                                    <input type="text" name="unit_price" class="form-control" placeholder="0" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">GST(%)</label>
                                    <input type="text" value="18" name="unit_price" class="form-control" placeholder="0"
                                        required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Product Total <span
                                            style="color:red">*</span></label>
                                    <input type="decimal" name="product_total" id="contact_no" class="form-control"
                                        placeholder="0" required>
                                </div>
                            </div>


                        </div>

                        <button type="submit"
                            class="btn btn-primary m-auto d-block add-employee-btn mt-4 mb-2">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
    <script>
        let table = new DataTable('#purchase-order-table', {
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
    </script>
@endsection