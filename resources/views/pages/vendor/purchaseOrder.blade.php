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
            <div class="card-body details-table">
                <table id="purchase-order-details-table" class="display">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Product Category</th>
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

                        @foreach ($poDetails as $key => $data)
                            <tr style="text-align: center;">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->categoryDetails->category_name }}</td>
                                <td>{{ $data->productDetails->productname }}</td>
                                <td>{{ $data->vendorDetails->company_name }}</td>
                                <td>
                                    <span data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="₹{{ $data->productDetails->quantity * $data->productDetails->rate }}">{{ $data->productDetails->quantity }}</span>
                                </td>
                                <td>
                                    <span data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="₹{{ (int)$data->productDetails->product_qty * $data->productDetails->rate }}">{{ $data->product_qty }}</span>

                                </td>
                                <td>{{ $data->productDetails->rate }}</td>
                                <td>{{ $data->total_amount }}</td>
                                <td>
                                    <a href="/vendor/po-invoice/{{ $data->id }}" target="_blank">
                                        <button class="btn btn-warning">View</button>
                                    </a>
                                </td>
                                <td>
                                    <div class="vendor-action d-flex">
                                        <a href="#"><button class="btn btn-info me-2">Edit</button></a>
                                        <a href="/po-delete/{{ $data->id }}" onclick="return confirm('Are you sure, You want to delete this?')">
                                            <button class="btn btn-danger">Delete</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
    <script>
        let table = new DataTable('#purchase-order-details-table', {
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
    </script>
@endsection