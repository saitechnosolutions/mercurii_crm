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
                        
                    </tbody>
                </table>
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