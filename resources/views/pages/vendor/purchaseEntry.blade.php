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
                            <a href="/add-purchase-entry" class="btn btn-primary d-block add-employee-btn">Add Purchase
                                Entry</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Purchase Entry details</div>
            <div class="card-body">
                <table id="purchase-entry-table" class="display">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>PO Date</th>
                            <th>Product Category</th>
                            <th>Products</th>
                            <th>Vendor</th>
                            <th>Requested Quantity</th>
                            <th>Received Quantity</th>
                            <th>Pending Quantity</th>
                            <th>Unit Price</th>
                            <th>Product Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                17-03-2025
                            </td>
                            <td>
                                Racking Special
                            </td>
                            <td>
                                Selective Pallet Racking System
                            </td>
                            <td>
                            TMTE Metal Tech Pvt Ltd
                            </td>
                            <td>
                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="₹60000">3</span>
                            </td>
                            <td>
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="₹40000">2</span>
                            </td>
                            <td>
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="₹20000">1</span>
                            </td>
                            <td>
                                ₹20000
                            </td>
                            <td>
                                ₹70800
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

@endsection

@section("scripts")
    <script>
        let table = new DataTable('#purchase-entry-table');
    </script>
@endsection