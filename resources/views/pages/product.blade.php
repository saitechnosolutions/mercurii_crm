@extends('layouts.app')
@section('main-content')
    <style>

    </style>
    <div class="container bg-white form-card mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="mt-2 mb-4">Products</h5>
                    </div>
                    <div class="col-lg-6" style="text-align: end;">
                        <a href="/addproduct" class="btn btn-primary  waves-effect waves-light">
                            <i class="mdi mdi-plus"></i> Add Product
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th style="text-align: center;">S.No</th>
                            <th style="text-align: center;">Part No</th>
                            <th style="text-align: center;">HSN</th>
                            <th style="text-align: center;">Product Category</th>
                            <th style="text-align: center;">Product Name</th>
                            <th style="text-align: center;">Rate</th>
                            <th style="text-align: center;">Qty</th>
                            <th style="text-align: center;">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @php $i = 1; @endphp

                        @foreach ($products as $data)

                            <tr style="text-align: center;">
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->partno ?? '-' }}</td>
                                <td>{{ $data->hsn }}</td>
                                <td>{{ $data->category->category_name ?? '-' }}</td>
                                <td>{{ $data->productname }}</td>
                                <td>₹{{ $data->rate }}</td>
                                <td>
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="">{{ $data->quantity }}</span>
                                </td>
                                <td>
                                    <div class="buttons_td">
                                        <a href="/updateProductData/{{ $data->id }}"><button type="button" class="btn btn-bull_yellow edit-btn waves-effect waves-light">
                                            <i class="mdi mdi-lead-pencil"></i>
                                        </button></a>
                                    </div>

                                </td>
                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-center2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="myForm" method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="form-label">Product Name <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="productname" placeholder="Productname" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Rate <span class="mandatory">*</span></label>
                            <input type="text" class="form-control " name="rate" placeholder="Rate" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">HSN <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="hsn" placeholder="HSN" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">GST <span class="mandatory">*</span></label>
                            <input type="text" class="form-control" name="gst" placeholder="GST" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('products.update') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <input type="hidden" class="id" name="id">
                            <label for="" class="form-label">Product Name <span class="mandatory">*</span></label>
                            <input type="text" class="form-control productname" placeholder="Productname" name="productname"
                                required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="form-label">Rate <span class="mandatory">*</span></label>
                            <input type="text" class="form-control rate" name="rate" placeholder="Rate" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="input4" class="form-label">HSN <span class="mandatory">*</span></label>
                            <input type="text" class="form-control hsn" name="hsn" placeholder="HSN" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="input4" class="form-label">GST <span class="mandatory">*</span></label>
                            <input type="text" class="form-control gst" name="gst" placeholder="GST" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    </div>

@endsection

@section('scripts')
    <script src="/assets/js/pages/pass-addon.init.js"></script>
    <script>
        $('.country').on('change', function () {
            var country = $(this).val();

            $('.state').empty();
            $('.state').append(`<option value="" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'GET',
                url: '/GetState/' + country,
                success: function (response) {
                    $('.state').empty();
                    $('.state').append(
                        `<option value="" disabled selected>Select State</option>`
                    );
                    response.forEach(element => {
                        $('.state').append(
                            `<option value="${element['id']}">${element['name']}</option>`
                        );
                    });
                }
            })
        });

        $('.state').on('change', function () {
            var state = $(this).val();

            $('.district').empty();
            $('.district').append(`<option value="" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'GET',
                url: '/Getdistrict/' + state,
                success: function (response) {
                    $('.district').empty();
                    $('.district').append(
                        `<option value="" disabled selected>Select District</option>`
                    );
                    response.forEach(element => {
                        $('.district').append(
                            `<option value="${element['id']}">${element['district']}</option>`
                        );
                    });
                }
            })
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.confirmpassword').on('keyup', function () {
                const password = $('.password').val();
                const confirmPassword = $('.confirmpassword').val();
                const errorMsg = $('.confpassword-error');
                const submitButton = $('.add-employee-btn');

                if (!password) {
                    errorMsg.text('Enter the password first').css('color', 'red');
                    submitButton.attr('type', 'button'); // Change to button to prevent form submission
                } else if (password !== confirmPassword) {
                    errorMsg.text('Confirm password is wrong').css('color', 'red');
                    submitButton.attr('type', 'button'); // Change to button to prevent form submission
                } else {
                    errorMsg.text('Password is correct').css('color', 'green');
                    submitButton.attr('type', 'submit'); // Change to submit to allow form submission
                }
            });

            $('.password').on('keyup', function () {
                $('.confpassword-error').text('');
                $('.add-employee-btn').attr('type', 'button'); // Reset to button on typing in password
            });
        });
    </script>

    <script>
        $(document).on('click', '.edit-btn', function () {
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
        $(document).on('click', '.pass_edit', function () {
            var id = $(this).data('id');

            $('.id').val(id);
        })
    </script>

@endsection