@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')

<section class="section leadsection" >
    <div class="container form-card">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="mt-2">Update Lead</h5>
                    </div>
                    <div class="col-lg-4">

                    </div>
                    <div class="col-lg-2 " style="text-align: -webkit-right;">
                        <a href="/singlelead/{{ $row->id }}" class="btn btn-primary d-block add-employee-btn" >Back</a>
                            {{-- onclick="window.history.back();" --}}
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="/updatelead">
            <div class="row mb-4">
                @csrf
                {{-- @if ($fields = App\Models\Field::where('categoryid', '1')->where('visibility', 1)->get())
                    @foreach ($fields as $f)
                        @if ($f->fieldtype == 1)
                            <div class="col-lg-3">
                                <div class="form-group mt-4">

                                    <label for="exampleFormControlInput1" class="form-label">{{ $f->fieldname }}
                                        @if ($f->mandatory == 1)
                                            <span style="color:red">*</span>
                                        @endif
                                    </label>
                                    <input type="text" value="{{ $row->{str_replace(' ', '', $f->fieldname)} }}"
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
                                    <input type="text" value="{{ $row->{str_replace(' ', '', $f->fieldname)} }} onblur="numbersonlyvalidation(this)"
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
                                    <input type="text" value="{{ $row->{str_replace(' ', '', $f->fieldname)} }} onblur="decimalnumvalidation(this)"
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
                                    <input type="text" value="{{ $row->{str_replace(' ', '', $f->fieldname)} }} onblur="emailvalidation(this)"
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
                                    <input type="number" value="{{ $row->{str_replace(' ', '', $f->fieldname)} }} id="productname"
                                        name="{{ str_replace(' ', '', $f->fieldname) }}"
                                        onblur="mobilenumvalidation(this)" class="form-control mblduplicatecheck"
                                        placeholder="{{ $f->fieldname }}"
                                        @if ($f->mandatory == 1) required @endif>
                                </div>
                            </div>
                        @endif
                        @if ($f->fieldtype == 6)
                        @if ($f->fieldname == 'Entrydate')
                                        @php
                                            $dateformat = date('Y-m-d', strtotime($row->Entrydate));
                                        @endphp
                                    @else
                                        @php
                                            $dateformat = $row->{str_replace(' ', '', $f->fieldname)};
                                        @endphp
                                    @endif
                            <div class="col-lg-3">
                                <div class="form-group mt-4">
                                    <label for="exampleFormControlInput1" class="form-label">{{ $f->fieldname }}
                                        @if ($f->mandatory == 1)
                                            <span style="color:red">*</span>
                                        @endif
                                    </label>
                                    <input type="date" value="{{ $dateformat }}"  class="form-control"
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
                                                <option value="{{ $data->id }}" @if ($row->{str_replace(' ', '', $f->fieldname)} == $data->id) selected @endif>{{ $data->dropdowndata }}
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
                                        <option value="{{ $dataproduct->id }}" @if ($row->products == $dataproduct->id) selected @endif
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
                                    <option value="{{ $u->id }}" @if ($row->assigned_to == $u->id) selected @endif>{{ $u->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div> --}}

                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Customer Name <span
                            style="color:red">*</span></label>
                            <input type="text" name="LeadName" value="{{ $row->LeadName }}" class="form-control" placeholder="Customer Name"  required >
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
                                <option value="{{ $data->id }}" @if ($row->Leadsource == $data->id) selected @endif>
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
                            <textarea name="billaddress" class="form-control"  placeholder="Billing Address"  required >{{ $row->billaddress }}</textarea>
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Enquiry Details <span
                            style="color:red">*</span></label>
                            <textarea name="enquirydetail" class="form-control" placeholder="Enquiry Details"  required >{{ $row->enquirydetail }}</textarea>
                    </div>
                </div>
                @php
$countries = DB::table('countries')->where('id',76)->get(); // Fetching all countries from the database
@endphp
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
                            <input type="text" name="contactname" class="form-control" value="{{ $row->contactname }}" placeholder="Contact Name"  required >
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

                                    <option value="{{ $p->id }}" @if ($row->state_id == $p->id) selected @endif>{{ $p->state }}</option>
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
                            <input type="email" name="email" class="form-control" value="{{ $row->email }}" placeholder="E-mail"  required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing City <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="citylist" required>
                                <option value=""> -- Choose City -- </option>
                                @if($city = App\Models\Citylist::get())
                                @foreach ($city as $c)
                                    <option value="{{ $c->id }} " @if($row->citylist == $c->id) selected @endif>{{ $c->city_name }}</option>
                                @endforeach
                            @endif
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
                            <input type="decimal" name="phonumber" class="form-control" value="{{ $row->phonumber }}"  placeholder="Contact Number"  required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Billing Postal Code <span
                            style="color:red">*</span></label>
                            <input type="decimal" name="postalcode" class="form-control" value="{{ $row->postalcode }}" placeholder="Postal Code"  required >
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
                            <input type="decimal" name="gst" class="form-control" value="{{ $row->gst }}" placeholder="GST NO"  required >
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
                                    <option value="{{ $u->id }}" @if($row->assigned_to == $u->id) selected @endif >{{ $u->name }}</option>
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
                                        <option value="{{ $dataproduct->id }}" @if($row->products == $dataproduct->id) selected @endif>
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
                                <option value="{{ $data->id }}" @if($row->Leadstatus == $data->id) selected @endif>
                                    {{ $data->dropdowndata }}</option>
                            @endforeach
                        @endif

                    </select>

                </div>
                </div>
                @php
                                            $dateformat = date('Y-m-d', strtotime($row->Entrydate));
                                        @endphp
                <div class="col-lg-6">
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1" class="form-label">Enquiry Date <span style="color:red">*</span></label>
                        <input type="date" class="form-control" name="Entrydate" value="{{ $dateformat }}" placeholder="Enquiry Date" min=""required >
                    </div>
                </div>
                <div class="col-lg-6" >
                    <div class="form-group mt-4">
                        <label for="exampleFormControlInput1"
                            class="form-label">Proceed <span
                            style="color:red">*</span></label>
                            <select class="form-select " name="proceed" required>
                                <option value="1" {{ $row->proceed == 1 ? 'selected' : '' }}> Yes </option>
            <option value="2" {{ $row->proceed == 2 || $row->proceed == 0 || is_null($row->proceed) ? 'selected' : '' }}> No </option>
                            </select>
                    </div>
                </div>



                <input type="hidden" name="id" value="{{ $row->id }}">


                </div>
            </div>
            <button type="submit" class="btn btn-primary m-auto d-block add-employee-btn">Update Lead</button>
        </form>
    </div>
</section>
@endsection
