@extends('layouts.app')
@section('main-content')
    <style>

    </style>
    <div class="container bg-white form-card mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="mt-2 mb-5">Product Categories</h5>
                    </div>
                    <div class="col-lg-6" style="text-align: end;">
                        <a data-bs-target="#add_category_modal" data-bs-toggle="modal"
                            class="btn btn-primary  waves-effect waves-light">
                            <i class="mdi mdi-plus"></i> Add Category
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th style="text-align: center;">S.No</th>
                            <th style="text-align: center;">Category</th>
                            <!-- <th style="text-align: center;">Sub Category</th>
                            <th style="text-align: center;">Type</th> -->
                            <th style="text-align: center;">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @php $i = 1; @endphp

                        @foreach ($productCategory as $data)
                            <tr style="text-align: center;">
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->category_name}}</td>
                                <!-- <td>{{ $data->sub_category }}</td>
                                <td>{{ $data->type }}</td> -->
                                <td>
                                    <div class="buttons_td">
                                        <button type="button" class="btn btn-bull_yellow edit-cat-btn waves-effect waves-light"
                                            data-bs-toggle="modal" data-bs-target="#edit_category_modal"
                                            data-catid="{{ $data->id }}" data-categoryname="{{ $data->category_name }}"
                                            data-subcatname="{{ $data->sub_category }}" data-type="{{ $data->type }}">
                                            <i class="mdi mdi-lead-pencil"></i>
                                        </button>

                                        <a href="/delete-category/{{ $data->id }}" onclick="return confirm('Are you sure, You want to delete this?')">
                                        <button type="button" class="me-3 btn btn-bull_red waves-effect waves-light">
                                            Delete
                                        </button>
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

    <div class="modal fade modal-lg" id="add_category_modal" aria-hidden="true" aria-labelledby="add_po_modalLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_po_modalLabel">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/add-category-action">
                        <div class="row mb-4">
                            @csrf

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="customerSelect" class="form-label">
                                        Category <span style="color:red">*</span>
                                    </label>

                                    <input type="text" name="category_name" class="form-control" placeholder="Type here..."
                                        required>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Sub Category<span
                                            style="color:red">*</span></label>
                                            <select class="form-select " name="type" required>
                                                <option value="">-- Choose  --</option>
                                                        <option value="mhe">MHE</option>
                                                        <option value="rack">RACK</option>
                                                        <option value="pallet">Pallet</option>
                                            </select>
                                    {{-- <input type="text" name="type" class="form-control" placeholder="Type here..." required> --}}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Type<span
                                            style="color:red">*</span></label>
                                    {{-- <input type="text" name="sub_category" class="form-control" placeholder="Type here..."
                                        required> --}}
                                        <select class="form-select " name="sub_category" required>
                                            <option value="">-- Choose Type --</option>
                                                    <option value="special">Special</option>
                                                    <option value="standard">Standard</option>
                                        </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary m-auto d-block add-employee-btn mt-4 mb-2">Add
                            Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade modal-lg" id="edit_category_modal" aria-hidden="true" aria-labelledby="add_po_modalLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add_po_modalLabel">Edit Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit-category-action">
                        <div class="row mb-4">
                            @csrf

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="customerSelect" class="form-label">
                                        Category <span style="color:red">*</span>
                                    </label>
                                    <input type="hidden" name="catid" id="catId">
                                    <input type="text" id="edit_category_name" name="edit_category_name"
                                        class="form-control" placeholder="Type here..." required>
                                </div>
                            </div>



                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Sub Category<span
                                            style="color:red">*</span></label>
                                            <select class="form-select " id="edit_type" name="edit_type" required>
                                                <option value="">-- Choose  --</option>
                                                        <option value="mhe">MHE</option>
                                                        <option value="rack">RACK</option>
                                                        <option value="pallet">Pallet</option>
                                            </select>
                                    {{-- <input type="text" id="edit_type" name="edit_type" class="form-control"
                                        placeholder="Type here..." required> --}}
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Type<span
                                            style="color:red">*</span></label>
                                    {{-- <input type="text" id="edit_sub_category_name" name="edit_sub_category_name"
                                        class="form-control" placeholder="Type here..." required> --}}
                                        <select class="form-select " id="edit_sub_category_name" name="edit_sub_category_name" required>
                                            <option value="">-- Choose Type --</option>
                                                    <option value="special">Special</option>
                                                    <option value="standard">Standard</option>
                                        </select>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary m-auto d-block add-employee-btn mt-4 mb-2">Edit
                            Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $(document).on("click", ".edit-cat-btn", function () {
                var catId = $(this).data('catid');
                var categoryName = $(this).data('categoryname');
                var subCatName = $(this).data('subcatname');
                var type = $(this).data('type');

                $("#catId").val(catId);
                $("#edit_category_name").val(categoryName);
                $("#edit_sub_category_name").val(subCatName);
                $("#edit_type").val(type);
            });
        });
    </script>

@endsection
