@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')

@php
$countries = DB::table('countries')->where('id',76)->get(); // Fetching all countries from the database
@endphp
<section class="section leadsection" >
    <div class="container form-card">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="mt-2">Add Lead Enquiry</h5>
                    </div>
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-2">
                        <a href="/viewleads" class="btn btn-primary d-block add-employee-btn" >Back</a>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="/saveleads">
            <div class="row mb-4">
                @csrf
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Customer Name <span
                            style="color:red">*</span></label>
                            <input type="text" name="LeadName" class="form-control" placeholder="Customer Name"  required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                    <label for="exampleFormControlInput1" class="form-label">Source of Enquiry <span
                            style="color:red">*</span></label>
                    <select class="form-select " name="Leadsource" required>
                        <option value="">-- Choose Source --</option>
                        @if ($status = App\Models\Dropdowndata::where('formid', 4)->orderBy('orderno', 'asc')->get())
                            @foreach ($status as $data)
                                <option value="{{ $data->id }}"
                                    >
                                    {{ $data->dropdowndata }}</option>
                            @endforeach
                        @endif

                    </select>

                </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing Address <span
                            style="color:red">*</span></label>
                            <textarea name="billaddress" class="form-control" placeholder="Billing Address"  required ></textarea>
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Enquiry Details <span
                            style="color:red">*</span></label>
                            <textarea name="enquirydetail" class="form-control" placeholder="Enquiry Details"  required ></textarea>
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing Country <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="billingcountry" required>
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ $country->id == 76 ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach

                            </select>
                    </div>
                </div>

                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Contact Name <span
                            style="color:red">*</span></label>
                            <input type="text" name="contactname" class="form-control" placeholder="Contact Name"  required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing State <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="state_id" id="state_list" required>
                                <option value=""> -- Choose State -- </option>
                                @if($product = App\Models\Statelist::get())
                                @foreach ($product as $p)

                                    <option value="{{ $p->id }}">{{ $p->state }}</option>
                                @endforeach
                            @endif

                            </select>
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">E-mail <span
                            style="color:red">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="E-mail"  required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing City <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="citylist" required>
                                <option value=""> -- Choose City -- </option>

                            </select>
                    </div>
                </div>

                <div class="col-lg-3" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Country Code <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="countrycode" required>
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ $country->id == 76 ? 'selected' : '' }}>
                                    {{ $country->code }} ({{ $country->dial_code }})
                                </option>
                            @endforeach
                            </select>
                    </div>
                </div>
                <div class="col-lg-3" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Contact Number <span
                            style="color:red">*</span></label>
                            <input type="decimal" name="phonumber" class="form-control" placeholder="Contact Number"  required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing Postal Code <span
                            style="color:red">*</span></label>
                            <input type="decimal" name="postalcode" class="form-control" placeholder="Postal Code"  required >
                    </div>
                </div>
                <div class="col-lg-3" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Designation <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="designation" >
                                <option value=""> -- Choose Designation -- </option>

                            </select>
                    </div>
                </div>
                <div class="col-lg-3" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Department <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="department" >
                                <option value=""> -- Choose Department -- </option>

                            </select>
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">GST NO <span
                            style="color:red">*</span></label>
                            <input type="decimal" name="gst" class="form-control" placeholder="GST NO"  required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Sales Manager</label>
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
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Products <span
                            style="color:red">*</span></label>
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
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                    <label for="exampleFormControlInput1" class="form-label">Status of Enquiry <span
                            style="color:red">*</span></label>
                    <select class="form-select " name="Leadstatus" required>
                        <option value="">-- Choose Status --</option>
                        @if ($status = App\Models\Dropdowndata::where('formid', 6)->orderBy('orderno', 'asc')->get())
                            @foreach ($status as $data)
                                <option value="{{ $data->id }}"
                                    >
                                    {{ $data->dropdowndata }}</option>
                            @endforeach
                        @endif

                    </select>

                </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1" class="form-label">Enquiry Date <span style="color:red">*</span></label>
                        <input type="date" class="form-control" name="Entrydate" placeholder="Enquiry Date" min=""required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Proceed <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="proceed" required>
                                <option value="1"> Yes </option>
                                <option value="2"> No  </option>
                            </select>
                    </div>
                </div>
                {{-- <div class="col-lg-3" >
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
                </div> --}}


            </div>
            </div>
            <button type="submit" class="btn btn-primary m-auto d-block add-employee-btn">Save Enquiry</button>
        </form>
    {{-- </div> --}}
</section>
@endsection
