@extends('layouts.app')
@section('title', 'Vendors Details')
@section('main-content')

    {{-- @include('sweetalert::alert') --}}

    <section class="section leadsection container" >
        <div class=" form-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mt-2">Vendor Details</h5>
                        </div>
                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-2">
                            <a href="/add-vendors" class="btn btn-primary d-block add-employee-btn" >Add Vendor</a>
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
            <table id="vendor-table" class="display">
                <thead>
                    <tr>
                        <th>Company Name</th>
                        <th>Point Of Contact</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                        <th>Gst Number</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $vendors = App\Models\Vendor::all();
                @endphp
                    @foreach ($vendors as $data)
                        <tr>
                            <td>{{ $data->company_name }}</td>
                            <td>{{ $data->point_of_contact }}</td>
                            <td>{{ $data->contact_number }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->gst_number }}</td>
                            <td>
                                <span class="badge bg-success">{{$data->vendor_status}}</span>
                            </td>
                            <td>
                                <div class="vendor-action d-flex">
                                    <a href="/edit-vendors"><button class="btn btn-info me-2">Edit</button></a>
                                    <button class="btn btn-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

<!-- Status Change Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Change Enquiry Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changeStatusForm">
                    @csrf
                    <input type="hidden" id="lead_id" name="lead_id">

                    <div class="mb-3">
                        <label for="status" class="form-label">Select Status <span
                            style="color:red">*</span></label>
                        <select class="form-control" id="status" name="status" required>

                            <option value="">-- Choose Status --</option>
                            @foreach (App\Models\Dropdowndata::where('formid', 6)->orderBy('orderno', 'asc')->get() as $data)
                                <option value="{{ $data->id }}" data-status="{{ $data->dropdowndata }}">{{ $data->dropdowndata }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" id="convertedOptionsDiv" style="display: none;">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1"
                                class="form-label">Categories <span
                                style="color:red">*</span></label>
                                <select class="form-select " name="category" id="catepro" required>
                                    <option value=""> Choose Category </option>
                                    @if ($status = App\Models\Dropdowndata::where('formid', 7)->orderBy('orderno', 'asc')->get())
                                    @foreach ($status as $data)
                                        <option value="{{ $data->id }}"
                                            >
                                            {{ $data->dropdowndata }}</option>
                                    @endforeach
                                @endif

                                </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1"
                                class="form-label">Products <span
                                style="color:red">*</span></label>
                                <select class="form-select " name="products" required>
                                    <option value=""> Choose Product </option>

                                </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="quantity" class="form-label">Quantity <span style="color:red">*</span></label>
                            <input type="number" class="form-control" name="quantity" id="quantity" required placeholder="Enter Quantity">
                        </div>

                        <div class="form-group mt-4">
                            <label for="ga_number" class="form-label">GA Number <span style="color:red">*</span></label>
                            <select class="form-select" name="ga_number" id="ga_number" >
                                <option value="">Choose GA Number</option>
                                <!-- Add options dynamically -->
                            </select>
                        </div>
                </div>


                        {{-- <label for="convertedOptions" class="form-label">Select Conversion Type</label>
                        <select class="form-control" id="convertedOptions" name="convertedOptions">
                            <option value="">-- Choose Option --</option>
                            <option value="Option 1">Option 1</option>
                            <option value="Option 2">Option 2</option>
                            <option value="Option 3">Option 3</option>
                        </select> --}}


                    <div class="mb-3">
                        <label for="remarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("scripts")
<script>
    let table = new DataTable('#vendor-table');
</script>
@endsection
