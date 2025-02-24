@extends('layouts.app')
@section('main-content')
    <style>

    </style>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="container bg-white form-card mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="mt-2 mb-4">All Customers</h5>
                    </div>
                    <div class="col-lg-6" style="text-align: end;">
                        <a  href="/addcustomer" class="btn btn-primary  waves-effect waves-light"
                                        >
                                        <i class="mdi mdi-plus"></i> Add Customer
                    </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th style="text-align: center;">S.No</th>
                            <th style="text-align: center;">Customer ID</th>
                            <th style="text-align: center;">Customer Name</th>
                            <th style="text-align: center;">Email</th>
                            <th style="text-align: center;">Contact No</th>
                            <th style="text-align: center;">Action</th>

                        </tr>
                    </thead>
                    <tbody>

@php $i = 1; @endphp

@foreach ($customer as $c)
    <tr style="text-align: center;">
        <td>{{ $i++ }}</td>
        <td>{{ $c->cusid }}</td>
        <td>{{ $c->customername }}</td>
        <td>{{ $c->cus_email }}</td>
        <td>{{ $c->contact_no }}</td>
        <td>
            <div class="buttons_td">
                <button type="button" class="btn btn-bull_yellow edit-btn waves-effect waves-light"
                data-bs-toggle="modal" data-bs-target=".bs-example-modal-center"
                data-id="" data-productname=""  data-rate="" data-hsn="" data-gst="" >
                <i class="mdi mdi-lead-pencil"></i>
            </button>
            </div>

        </td>
    </tr>
@endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>








    </div>

@endsection

@section('scripts')
    <script src="/assets/js/pages/pass-addon.init.js"></script>


<script>
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var productname = $(this).data('productname');
        var gst = $(this).data('gst');
        var hsn = $(this).data('hsn');
        var rate = $(this).data('rate');


        $('.id').val(id);
        $('.productname').val(productname);
        $('.hsn').val(hsn);
        $('.gst').val(gst);
        $('.rate').val(rate);
    });
</script>

<script>
    $(document).on('click', '.pass_edit', function() {
        var id = $(this).data('id');

        $('.id').val(id);
    })
</script>

@endsection


