@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')
@php
$countries = DB::table('countries')->where('id',76)->get(); // Fetching all countries from the database
@endphp
<section class="bg-white" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;border-radius:10px;">
    <div class="container-fluid bg-white pt-4 pb-5">
        <div class="alert alert-warning alert-dismissible fade show d-none myalert" role="alert" id="myalert">
            <span class="error-text"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <div class="row mb-3">
          <div class="col-lg-3 mt-2">
            <div class="form-group">
                <label>Reference No</label>

                <input type="text" name="" placeholder="Quotation No" class="form-control mt-2" readonly style="background-color: #c6cbd0;" value="{{ $lead->lead_id }}">

            </div>
        </div>
        <div class="col-lg-3 mt-2">
            <div class="form-group">
                <label>Client Name </label>
                <input type="text" name="" onblur="namevalidation(this)" style="background-color: #c6cbd0;" placeholder="Client Name" class="form-control mt-2" value="{{ $lead->LeadName }}" readonly>
            </div>
        </div>
        <div class="col-lg-3 mt-2">
            <div class="form-group">
                <label>Quotation No</label>
                @if ($drop = App\Models\Quotation::where('id_lead', $lead->id)->first())
                <input type="text" name="" placeholder="Quotation No" class="form-control mt-2" readonly style="background-color: #c6cbd0;" value="{{ $drop->quota_id }}">
                @endif
            </div>
        </div>
        <div class="col-lg-3 mt-2">
            <div class="form-group">
                <label>Quotation Date</label>
                <input type="text" name="" placeholder="" style="background-color: #c6cbd0;" class="form-control mt-2" value="{{ now()->format('d-m-Y') }}" readonly>
            </div>
        </div>

          </div>

          <form method="POST" action="{{ route('createestimate') }}">
            @csrf

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Create Quotation</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Others</button>
            </li>
            {{-- <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
            </li> --}}
          </ul>


            {{-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> --}}



          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            {{-- <div class="col-lg-12 ">
                <h6 class="mb-3">Create Quotation</h6>
            </div> --}}
            <input type="hidden" name="leadno" value="{{ $lead->id }}" class="form-control mt-2" readonly>
            <div class="col-lg-4 mt-2">
                <div class="form-group">
                    <label>Quotation No</label>
                    @if ($drop = App\Models\Quotation::where('id_lead', $lead->id)->first())
                    <input type="text" name="quotationno" placeholder="Quotation No" class="form-control mt-2" readonly style="background-color: #c6cbd0;" value="{{ $drop->quota_id }}">
                    @endif
                </div>
            </div>
            {{-- <div class="col-lg-3 mt-2">
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="conpamyname" placeholder="Company Name" class="form-control mt-2" value="" readonly>
                </div>
            </div> --}}
            <div class="col-lg-4 mt-2">
                <div class="form-group">
                    <label>Client Name </label>
                    <input type="text" name="clientname" onblur="namevalidation(this)" style="background-color: #c6cbd0;" placeholder="Client Name" class="form-control mt-2" value="{{ $lead->LeadName }}" readonly>
                </div>
            </div>
            <div class="col-lg-4 mt-2">
                <div class="form-group">
                    <label>GST No </label>
                    <input type="text" name="gstnum" style="text-transform:uppercase;background-color: #c6cbd0;"   placeholder="Ex : 33DOXPK5439F1ZI" value="{{ $lead->gst }}" class="form-control mt-2" readonly>
                </div>
            </div>
             {{-- <select class="form-select select2 mt-2" name="placeofsupply" >
                        <option value="">-- Select City --</option>
                                <option value="1">Coimbatore</option>
                                <option value="2">Chennai</option>
                                <option value="3">Bangalore</option>

                    </select> --}}
            <div class="col-lg-5 mt-2">
                <div class="form-group">
                    <label>Billing Address</label>

                    <textarea class="form-control" style="background-color: #c6cbd0;" name="billingad" id="billingAddress" readonly>{{ $lead->billaddress }}</textarea>

                </div>
            </div>
            <div class="col-lg-2 mt-2">
            </div>
            <div class="col-lg-5 mt-2">
                <div class="form-group">
                    <label>Shipping Address</label>
                    <textarea class="form-control" name="placeofsupply" id="shippingAddress"></textarea>
                </div>
            </div>


            <div class="col-lg-5" >
                <div class="form-group mt-4">
                    <label for="exampleFormControlInput1"
                        class="form-label">Billing Country <span
                        style="color:red">*</span></label>
                        <select class="form-select " style="background-color: #c6cbd0;" name="billingcountry" id="country" disabled>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ $country->id == 76 ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach

                        </select>
                </div>
            </div>
            <div class="col-lg-2 mt-2">
            </div>
            <div class="col-lg-5" >
                <div class="form-group mt-4">
                    <label for="exampleFormControlInput1"
                        class="form-label">Shipping Country <span
                        style="color:red">*</span></label>
                        <select class="form-select " name="shippingcountry" id="shipcountry" >
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ $country->id == 76 ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach

                        </select>
                </div>
            </div>

            <div class="col-lg-5" >
                <div class="form-group mt-4">
                    <label for="exampleFormControlInput1"
                        class="form-label">Billing State <span
                        style="color:red">*</span></label>
                        <select class="form-select " name="state_id" id="state_list" style="background-color: #c6cbd0;" disabled>
                            <option value=""> -- Choose State -- </option>
                            @if($product = App\Models\Statelist::get())
                            @foreach ($product as $p)
                                <option value="{{ $p->id }}"
                                    {{ $p->id == $lead->state_id ? 'selected' : '' }}>
                                    {{ $p->state }}
                                </option>
                            @endforeach
                        @endif

                        </select>
                </div>
            </div>
            <div class="col-lg-2 mt-2" style="text-align: center;">
                <button type="button" class="btn btn-primary mt-2" style="font-size: 12px;" onclick="copyAddress()">Same as Billing Address</button>
            </div>
            <div class="col-lg-5" >
                <div class="form-group mt-4">
                    <label for="exampleFormControlInput1"
                        class="form-label">Shipping State <span
                        style="color:red">*</span></label>
                        <select class="form-select " name="shistate_id" id="state_listsh" >
                            <option value=""> -- Choose State -- </option>
                            @if($product = App\Models\Statelist::get())
                            @foreach ($product as $p)

                                <option value="{{ $p->id }}">{{ $p->state }}</option>
                            @endforeach
                        @endif

                        </select>
                </div>
            </div>

            <div class="col-lg-5" >
                <div class="form-group mt-4">
                    <label for="exampleFormControlInput1"
                        class="form-label">Billing City <span
                        style="color:red">*</span></label>
                        <select class="form-select " name="citylist" id="city_list" style="background-color: #c6cbd0;" disabled>
                            <option value=""> -- Choose City -- </option>
                            @if($product = App\Models\Citylist::get())
                            @foreach ($product as $p)
                                <option value="{{ $p->id }}"
                                    {{ $p->id == $lead->citylist ? 'selected' : '' }}>
                                    {{ $p->city_name }}
                                </option>
                            @endforeach
                        @endif

                        </select>
                </div>
            </div>
            <div class="col-lg-2 mt-2">
            </div>
            <div class="col-lg-5" >
                <div class="form-group mt-4">
                    <label for="exampleFormControlInput1"
                        class="form-label">Shipping City <span
                        style="color:red">*</span></label>
                        <select class="form-select " name="shcitylist" id="shicity_list" required>
                            <option value=""> -- Choose City -- </option>

                        </select>
                </div>
            </div>

            <div class="col-lg-5" >
                <div class="form-group mt-4">
                    <label for="exampleFormControlInput1"
                        class="form-label">Billing Postal Code <span
                        style="color:red">*</span></label>
                        <input type="decimal" name="postalcode" value="{{ $lead->postalcode }}" id="postalcode" class="form-control" style="background-color: #c6cbd0;" placeholder="Postal Code"  readonly >
                </div>
            </div>
            <div class="col-lg-2 mt-2">
            </div>
            <div class="col-lg-5" >
                <div class="form-group mt-4">
                    <label for="exampleFormControlInput1"
                        class="form-label">Shipping Postal Code <span
                        style="color:red">*</span></label>
                        <input type="decimal" name="shippostalcode" id="shippostalcode" class="form-control" placeholder="Postal Code"   >
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Product Category</label>
                    @if ($drop = App\Models\ProductCategory::where('id', $lead->category)->first())
                    <input type="text" name="catepro" class="form-control" value="{{ $drop->category_name }}" placeholder="" style="background-color: #c6cbd0;" readonly  >
                    @endif
                </div>
            </div>
            {{-- <div class="col-lg-3 mt-2">
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="conpamyname" placeholder="Company Name" class="form-control mt-2" value="" readonly>
                </div>
            </div> --}}
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Product </label>
                    <input type="hidden" name="product" class="form-control" style="background-color: #c6cbd0;" value="{{ $lead->products }}" placeholder="" readonly   >

                    @if ($prod = App\Models\Product::where('id', $lead->products)->first())
                                            <input type="text" name="" class="form-control" style="background-color: #c6cbd0;" value="{{ $prod->productname }}" placeholder="" readonly   >
                                        @endif
                </div>
            </div>

            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Part No </label>
                    @if ($prod = App\Models\Product::where('id', $lead->products)->first())
                    <input type="text" name="part_no" class="form-control" value="{{ $prod->partno }}" placeholder="" style="background-color: #c6cbd0;" readonly   >
                @endif
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Qty </label>
                    <input type="text" name="quanty" style="text-transform:uppercase;" value="{{ $quotations ? $quotations->quantitys : '' }}"  class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Allowed Discount % </label>
                    <input type="text" name="allowdis" style="text-transform:uppercase;background-color: #c6cbd0;" readonly  class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Requested Discount % </label>
                    <input type="text" name="requestdis" style="text-transform:uppercase"   class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Rate</label>
                    @if ($prod = App\Models\Product::where('id', $lead->products)->first())


                    <input type="text" name="ratee" style="text-transform:uppercase;background-color: #c6cbd0;"  value="{{ $prod->rate }}"  class="form-control mt-2" readonly>
                    @endif
                </div>
            </div>
            {{-- <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>(+/-)Price (%)</label>
                    <input type="text" name="price" style="text-transform:uppercase"   class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>(+/-)Price Amount</label>
                    <input type="text" name="priceamt" style="text-transform:uppercase"   class="form-control mt-2" >
                </div>
            </div> --}}
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Line Basic Total</label>
                    <input type="text" name="lbt" style="text-transform:uppercase;background-color: #c6cbd0;" readonly   class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Tax(%)</label>
                    @if ($prod = App\Models\Product::where('id', $lead->products)->first())
                    <input type="text" name="tax" style="text-transform:uppercase;background-color: #c6cbd0;"  value="{{ $prod->gst }}"  readonly class="form-control mt-2" >
                    @endif
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Tax Amount</label>
                    <input type="text" name="taxamt" style="text-transform:uppercase;background-color: #c6cbd0;" readonly class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Grand Total</label>
                    <input type="text" name="grandtotal" style="text-transform:uppercase;background-color: #c6cbd0;" readonly class="form-control mt-2" >
                </div>
            </div>

        </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-4" style="display: flex;flex-direction: column;">
                            <label for="termSelect" class="form-label">
                                Terms and Conditions <span style="color:red">*</span>
                            </label>

                            <!-- Select2 dropdown -->
                            <select id="termSelect" name="termscondition" class="form-control" required>
                                <option value="">Select Term</option>
                                <option value="new">New Term</option>

                                @php
                                    $terms = App\Models\Term::where('termtype', 1)->get();
                                @endphp

                                @foreach($terms as $term)
                                    <option value="{{ $term->id }}" data-id="{{ $term->id }}">
                                        {{ $term->content }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- New Term Content Input (Hidden initially) -->
                            <textarea id="newTermContent" name="newtermscondition" class="form-control mt-2" placeholder="Enter New Term Content" style="display: none;"></textarea>
                        </div>

                        {{-- <div class="form-group mt-2">
                            <label>Terms and Conditions</label>
                            <select class="form-control" name="termscondition">
                                <option value=""> -- choose -- </option>
                                <option value="1">100% advance</option>
                            </select>
                        </div> --}}
                        <div class="form-group mt-2">
                            <label>Date of Validity</label>
                            <input type="date" class="form-control" name="dov" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label>Freight/Transportation</label>
                            <select class="form-control" name="freight">
                                <option value=""> -- choose -- </option>
                                <option value="1">Mecuri</option>
                                <option value="2">Customer</option>
                            </select>
                        </div>
                        <div class="form-group mt-2 d-flex" style="gap:10px;">
                            <select class="form-control" name="exwrok">
                                <option value=""> -- choose -- </option>
                                <option value="1">Ex-works</option>
                            </select>
                            <select class="form-control ml-2" name="freightextra">
                                <option value=""> -- choose -- </option>
                                <option value="1">Freight extra at actuals</option>
                            </select>
                            {{-- <input type="text" class="form-control ml-2" name value="Freight extra at actuals"> --}}
                        </div>
                        <div class="form-group mt-2">
                            <label>Unloading at site</label>
                            <select class="form-control" name="unloading">
                                <option value=""> -- choose -- </option>
                                <option value="1">Mecuri</option>
                                <option value="2">Customer</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>Remarks</label>
                            <textarea class="form-control" name="remarks"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label>Currency</label>
                            <select class="form-control" name="currency">
                                <option value=""> -- choose -- </option>
                                <option value="1">INR</option>
                            </select>
                        </div>
                        <div class="form-group mt-4" style="display: flex;flex-direction: column;">
                            <label for="warrantySelect" class="form-label">
                                Warranty Terms <span style="color:red">*</span>
                            </label>

                            <!-- Select2 dropdown -->
                            <select id="warrantySelect" name="warranty" class="form-control" required>
                                <option value="">Select Warranty Term</option>
                                <option value="new">New Warranty Term</option>

                                @php
                                    $terms = App\Models\Term::where('termtype', 2)->get();
                                @endphp

                                @foreach($terms as $term)
                                    <option value="{{ $term->id }}" data-id="{{ $term->id }}">
                                        {{ $term->content }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- New Term Content Input (Hidden initially) -->
                            <textarea id="newwarContent" name="newwarcondition" class="form-control mt-2" placeholder="Enter New Warranty Term Content" style="display: none;"></textarea>
                        </div>
                        {{-- <div class="form-group mt-2">
                            <label>Warranty Terms</label>
                            <select class="form-control" name="warranty">
                                <option value=""> -- choose -- </option>
                                <option value="1">12 Months from the date of commissioning</option>
                                <option value="2">12 Months or 2000 Hrs from the date of commissioning Whichever is earlier</option>
                                <option value="3">24 Months or 4000 Hrs from the date of commissioning Whichever is earlier</option>
                            </select>
                        </div> --}}
                        <div class="form-group mt-2">
                            <label>Installation Scope</label>
                            <select class="form-control" name="installation">
                                <option value=""> -- choose -- </option>
                                <option value="1">Included</option>
                                <option value="2">Not Included</option>
                            </select>
                        </div>
                        {{-- <div class="form-group mt-2">
                            <input type="checkbox"> <label>Budgetary</label>
                        </div> --}}
                        <div class="form-group mt-2">
                            <label>Agent/Partner</label>
                            <select class="form-control" name="agent">
                                <option value=""> -- choose -- </option>
                                <option value="1">Yes</option>
                                <option value="2">None</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label>Amount</label>
                            <input type="number" class="form-control" name="ammt">
                        </div>
                    </div>
                </div>
            </div>
          </div>

        <div class="mt-2">
            <button type="submit" class="btn btn-warning float-end">Create Quotation</button>
        </div>
    </form>
    </div>
</section>
@endsection
