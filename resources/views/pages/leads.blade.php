@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')

    {{-- @include('sweetalert::alert') --}}

    <section class="section leadsection container" >
        <div class=" form-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mt-2">Lead Enquires</h5>
                        </div>
                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-2">
                            <a href="/addleads" class="btn btn-primary d-block add-employee-btn" >Add Lead Enquiry</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <form method="POST" action="/saveleads">
                <div class="row mb-4">
                    @csrf
                    @if ($fields = App\Models\Field::where('categoryid', '1')->where('visibility', 1)->get())
                        @foreach ($fields as $f)
                            @if ($f->fieldtype == 1)
                                <div class="col-lg-3">
                                    <div class="form-group mt-4">

                                        <label for="exampleFormControlInput1" class="form-label">{{ $f->fieldname }}
                                            @if ($f->mandatory == 1)
                                                <span style="color:red">*</span>
                                            @endif
                                        </label>
                                        <input type="text"
                                            @if ($f->fieldname == 'Client Name') onblur="namevalidation(this)" @else onblur="textboxvalidation(this)" @endif
                                            name="{{ str_replace(' ', '', $f->fieldname) }}" class="form-control"
                                            placeholder="{{ $f->fieldname }}"
                                            @if ($f->mandatory == 1) required @endif>
                                    </div>
                                </div>
                            @endif
                            @if ($f->fieldtype == 2)
                                <div class="col-lg-3">
                                    <div class="form-group mt-4">
                                        <label for="exampleFormControlInput1" class="form-label">{{ $f->fieldname }}
                                            @if ($f->mandatory == 1)
                                                <span style="color:red">*</span>
                                            @endif
                                        </label>
                                        <input type="text" onblur="numbersonlyvalidation(this)"
                                            name="{{ str_replace(' ', '', $f->fieldname) }}" class="form-control"
                                            placeholder="{{ $f->fieldname }}"
                                            @if ($f->mandatory == 1) required @endif>
                                    </div>
                                </div>
                            @endif
                            @if ($f->fieldtype == 3)
                                <div class="col-lg-3">
                                    <div class="form-group mt-4">
                                        <label for="exampleFormControlInput1" class="form-label">{{ $f->fieldname }}
                                            @if ($f->mandatory == 1)
                                                <span style="color:red">*</span>
                                            @endif
                                        </label>
                                        <input type="text" onblur="decimalnumvalidation(this)"
                                            name="{{ str_replace(' ', '', $f->fieldname) }}" class="form-control "
                                            placeholder="{{ $f->fieldname }}"
                                            @if ($f->mandatory == 1) required @endif>
                                    </div>
                                </div>
                            @endif
                            @if ($f->fieldtype == 4)
                                <div class="col-lg-3">
                                    <div class="form-group mt-4">
                                        <label for="exampleFormControlInput1" class="form-label">{{ $f->fieldname }}
                                            @if ($f->mandatory == 1)
                                                <span style="color:red">*</span>
                                            @endif
                                        </label>
                                        <input type="text" onblur="emailvalidation(this)"
                                            name="{{ str_replace(' ', '', $f->fieldname) }}" class="form-control"
                                            placeholder="{{ $f->fieldname }}"
                                            @if ($f->mandatory == 1) required @endif>
                                    </div>
                                </div>
                            @endif
                            @if ($f->fieldtype == 5)
                                <div class="col-lg-3">
                                    <div class="form-group mt-4">
                                        <label for="exampleFormControlInput1" class="form-label">{{ $f->fieldname }}
                                            @if ($f->mandatory == 1)
                                                <span style="color:red">*</span>
                                            @endif
                                        </label>
                                        <input type="number" id="productname"
                                            name="{{ str_replace(' ', '', $f->fieldname) }}"
                                            onblur="mobilenumvalidation(this)" class="form-control mblduplicatecheck"
                                            placeholder="{{ $f->fieldname }}"
                                            @if ($f->mandatory == 1) required @endif>
                                    </div>
                                </div>
                            @endif
                            @if ($f->fieldtype == 6)
                                <div class="col-lg-3">
                                    <div class="form-group mt-4">
                                        <label for="exampleFormControlInput1" class="form-label">{{ $f->fieldname }}
                                            @if ($f->mandatory == 1)
                                                <span style="color:red">*</span>
                                            @endif
                                        </label>
                                        <input type="date" class="form-control"
                                            name="{{ str_replace(' ', '', $f->fieldname) }}"
                                            placeholder="{{ $f->fieldname }}" min=""
                                            @if ($f->mandatory == 1) required @endif>
                                    </div>
                                </div>
                            @endif
                            @if ($f->fieldtype == 7)
                                <div class="col-lg-3">
                                    <div class="form-group mt-4">
                                        <label for="exampleFormControlInput1" class="form-label">{{ $f->fieldname }}
                                            @if ($f->mandatory == 1)
                                                <span style="color:red">*</span>
                                            @endif
                                        </label>
                                        <select class="form-select" @if ($f->mandatory == 1) required @endif
                                            name="{{ str_replace(' ', '', $f->fieldname) }}">
                                            <option value="">Choose {{ $f->fieldname }}</option>
                                            @if ($dropdowndatas = App\Models\Dropdowndata::where('formid', $f->id)->orderBy('orderno', 'asc')->get())
                                                @foreach ($dropdowndatas as $data)
                                                    <option value="{{ $data->id }}">{{ $data->dropdowndata }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif

                    <div class="col-lg-3" >
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1"
                                class="form-label">Products</label>
                                <select class="form-select " name="products" required>
                                    <option value=""> Choose Product </option>
                                    @if ($product = App\Models\Product::get())
                                        @foreach ($product as $dataproduct)
                                            <option value="{{ $dataproduct->id }}"
                                                >
                                                {{ $dataproduct->productname }}</option>
                                        @endforeach
                                    @endif

                                </select>
                        </div>
                    </div>

                    <div class="col-lg-3" >
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1"
                                class="form-label">Assigned to</label>
                            <select class="form-select" name="assigned_to" id="assigned_to">
                                <option value="">  Choose User  </option>
                                @if ($users = App\Models\User::where('id', '!=', Auth::user()->id)->get())
                                    @foreach ($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                </div>
                <button type="submit" class="btn btn-primary m-auto d-block add-employee-btn">Save Details</button>
            </form> --}}
        </div>
    </section>

    {{-- <div class="container bg-white form-card mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="mt-2 mb-4">All Leads</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">All Lead Enquires</div>
            <div class="card-body">
                {{ $dataTable->table() }}
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

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
{{-- @section('scripts')

@endsection --}}
