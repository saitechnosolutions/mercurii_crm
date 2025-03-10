@extends('layouts.app')
@section('title', 'Edit Vendor Details')
@section('main-content')

    @php
        $countries = DB::table('countries')->where('id', 76)->get(); // Fetching all countries from the database
    @endphp
    <section class="section leadsection">
        <div class="container form-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mt-2">Edit Vendor Details</h5>
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-2">
                            <a href="/vendors" class="btn btn-primary d-block add-employee-btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="/saveVendors">
                <div class="row mb-4">
                    @csrf
                    <!-- Company Name Field -->
                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="customerSelect" class="form-label">
                                Company Name <span style="color:red">*</span>
                            </label>

                            <input type="text" name="company_name" id="company_name" class="form-control"
                                placeholder="Company Name" required>
                        </div>
                    </div>

                    <!-- Alternate Name Field -->
                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="customerSelect" class="form-label">
                                Alternate Name <span style="color:red">*</span>
                            </label>

                            <input type="text" name="alternate_name" id="alternate_name" class="form-control"
                                placeholder="Alternate Name" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="customerSelect" class="form-label">
                                Point of contact <span style="color:red">*</span>
                            </label>

                            <input type="text" name="poc_name" id="poc_name" class="form-control" placeholder="Type here.."
                                required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">E-mail <span
                                    style="color:red">*</span></label>
                            <input type="email" name="email" class="form-control" id="cus_email" placeholder="E-mail"
                                required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Country Code <span
                                            style="color:red">*</span></label>
                                    <select class="form-select " name="countrycode" id="country_code" required>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ $country->id == 76 ? 'selected' : '' }}>
                                                {{ $country->code }} ({{ $country->dial_code }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">Contact Number <span
                                            style="color:red">*</span></label>
                                    <input type="decimal" name="contact_number" id="contact_no" class="form-control"
                                        placeholder="Contact Number" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Address <span
                                    style="color:red">*</span></label>
                            <textarea name="address" class="form-control" id="address" placeholder="Address"
                                required></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Country <span
                                    style="color:red">*</span></label>
                            <select class="form-select " name="country_id" id="country" required>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $country->id == 76 ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">State <span
                                    style="color:red">*</span></label>
                            <select class="form-select state_list" name="state_id" id="vendor_state_list" required>
                                <option value=""> -- Choose State -- </option>
                                @if($product = App\Models\Statelist::get())
                                    @foreach ($product as $p)

                                        <option value="{{ $p->id }}">{{ $p->state }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">City <span
                                    style="color:red">*</span></label>
                            <select class="form-select " name="city_id" id="vendor_city_list" required>
                                <option value=""> -- Choose City -- </option>

                            </select>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Postal Code <span
                                    style="color:red">*</span></label>
                            <input type="decimal" name="postal_code" id="postalcode" class="form-control"
                                placeholder="Postal Code" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">GST NO<span
                                    style="color:red">*</span></label>
                            <input type="decimal" name="gst_number" id="ggst" class="form-control" placeholder="GST NO"
                                required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Vendor Status <span
                                    style="color:red">*</span></label>
                            <select class="form-select " name="vendor_status" required>
                                <option value="active"> Active </option>
                                <option value="inactive"> Inactive </option>
                            </select>
                        </div>
                    </div>


                </div>
                </div>
                <button type="submit" class="btn btn-primary m-auto d-block add-employee-btn mt-4 mb-2">Update Changes</button>
        </form>
        {{-- </div> --}}
    </section>
@endsection