@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')

@php
$countries = DB::table('countries')->where('id',76)->get(); // Fetching all countries from the database
@endphp
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<section class="section leadsection" >
    <div class="container form-card">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="mt-2">Add Customer</h5>
                    </div>
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-2">
                        <a href="/customer" class="btn btn-primary d-block add-employee-btn" >Back</a>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="/savecustomer">
            <div class="row mb-4">
                @csrf
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Customer Name <span
                            style="color:red">*</span></label>
                            <input type="text" name="customername" class="form-control" placeholder="Customer Name"  required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing Address <span
                            style="color:red">*</span></label>
                            <textarea name="address" class="form-control" placeholder="Billing Address"  required ></textarea>
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing Country <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="country" required>
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
                            <input type="text" name="contact_name" class="form-control" placeholder="Contact Name"  required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing State <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="state" id="state_listt" required>
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
                            <input type="email" name="cus_email" class="form-control" placeholder="E-mail"  required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing City <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="city" required>
                                <option value=""> -- Choose City -- </option>

                            </select>
                    </div>
                </div>

                <div class="col-lg-3" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Country Code <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="country_code" required>
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
                            <input type="decimal" name="contact_no" class="form-control" placeholder="Contact Number"  required >
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
                            <input type="decimal" name="gstno" class="form-control" placeholder="GST NO"  required >
                    </div>
                </div>


            </div>
            </div>
            <button type="submit" class="btn btn-primary m-auto d-block add-employee-btn">Save Customer</button>
        </form>

</section>
@endsection
