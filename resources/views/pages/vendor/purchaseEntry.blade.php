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
            <div class="card-body details-table">
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
                        @php
                            $peDetails = App\Models\PurchaseEntry::get();
                        @endphp
                        @foreach ($peDetails as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ date('d-m-Y',strtotime($data->poDetails->created_at)) }}</td>
                                <td>{{ $data->categoryDetails->category_name }}</td>
                                <td>{{ $data->productDetails->productname }}</td>
                                <td>{{ $data->vendorDetails->company_name }}</td>
                                <td>{{ $data->requested_qty }}</td>
                                <td>{{ $data->received_qty }}</td>
                                <td>{{ $data->pending_qty }}</td>
                                <td>{{ $data->unit_price }}</td>
                                <td>{{ $data->product_total_price }}</td>
                                <td>
                                    <div class="vendor-action d-flex">
                                        <a href="#"><button class="btn btn-info me-2">Edit</button></a>
                                        <a href="/po-delete/{{ $data->id }}"
                                            onclick="return confirm('Are you sure, You want to delete this?')">
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
        let table = new DataTable('#purchase-entry-table');
    </script>
@endsection