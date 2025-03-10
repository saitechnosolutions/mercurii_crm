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
                            <h5 class="mt-2">Purchase Entry Details</h5>
                        </div>
                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-2">
                            <a href="/add-vendors" class="btn btn-primary d-block add-employee-btn" data-bs-target="#add_pe_modal" data-bs-toggle="modal">Add Purchase Entry</a>
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
                <table id="purchase-entry-table" class="display">
                    <thead>
                        <tr>
                            <th>Entry Date</th>
                            <th>Vendor</th>
                            <th>Products</th>
                            <th>Request Qty</th>
                            <th>Unit Price</th>
                            <th>Product Total</th>
                            <th>Receiving Qty</th>
                            <th>Pending Qty</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                06-03-2025
                            </td>
                            <td>
                                Today Company
                            </td>
                            <td>
                                Wire Decking
                            </td>
                            <td>
                                20
                            </td>
                            <td>
                                ₹2,200
                            </td>
                            <td>
                                ₹44,000
                            </td>
                            <td>
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="₹22,000">10</span>
                            </td>
                            <td>
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="₹22,000">10</span>
                            </td>
                            <td>
                                <div class="vendor-action d-flex">
                                    <button class="btn btn-info me-2"><i class="fa fa-edit" aria-hidden="true"></i>
                                        Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                07-03-2025
                            </td>
                            <td>
                                Yesterday Company
                            </td>
                            <td>
                                Base Plates
                            </td>
                            <td>
                                30
                            </td>
                            <td>
                                ₹1,200
                            </td>
                            <td>
                                ₹18,000
                            </td>
                            <td>
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="₹18,000">15</span>
                            </td>
                            <td>
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="₹18,000">15</span>
                            </td>
                            <td>
                                <div class="vendor-action d-flex">
                                    <button class="btn btn-info me-2"><i class="fa fa-edit" aria-hidden="true"></i>
                                        Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="add_pe_modal" aria-hidden="true" aria-labelledby="add_pe_modalLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="add_pe_modalLabel">Add Purchase Entry Details</h1>
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
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Request Quantity<span
                                            style="color:red">*</span></label>
                                    <input type="text" name="qty" class="form-control"
                                        required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Received Quantity<span
                                            style="color:red">*</span></label>
                                    <input type="text" name="unit_price" class="form-control" placeholder="" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Unit Price</label>
                                    <input type="decimal" name="product_total" id="contact_no" class="form-control"
                                        placeholder="" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">GST</label>
                                    <input type="decimal" name="product_total" id="contact_no" class="form-control"
                                        placeholder="" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Product Total <span
                                            style="color:red">*</span></label>
                                    <input type="decimal" name="product_total" id="contact_no" class="form-control"
                                        placeholder="" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Pending Quantity <span
                                    style="color:red">*</span></label>
                                    <input type="text" name="unit_price" class="form-control" placeholder="" required>
                                </div>
                            </div>


                        </div>

                        <button type="submit" class="btn btn-primary m-auto d-block add-employee-btn mt-4 mb-2">Add</button>
                </form>
            </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
    <script>
        let table = new DataTable('#purchase-entry-table');
    </script>
@endsection