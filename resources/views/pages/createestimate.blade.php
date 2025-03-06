@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')
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
            <div class="col-lg-3 mt-2">
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
            <div class="col-lg-3 mt-2">
                <div class="form-group">
                    <label>Client Name </label>
                    <input type="text" name="clientname" onblur="namevalidation(this)" style="background-color: #c6cbd0;" placeholder="Client Name" class="form-control mt-2" value="{{ $lead->LeadName }}" readonly>
                </div>
            </div>

            <div class="col-lg-3 mt-2">
                <div class="form-group">
                    <label>Place Of Supply </label>
                    <select class="form-select select2 mt-2" name="placeofsupply" >
                        <option value="">-- Select City --</option>
                                <option value="1">Coimbatore</option>
                                <option value="2">Chennai</option>
                                <option value="3">Bangalore</option>

                    </select>
                </div>
            </div>
            <div class="col-lg-3 mt-2">
                <div class="form-group">
                    <label>GST No </label>
                    <input type="text" name="gstnum" style="text-transform:uppercase;background-color: #c6cbd0;"   placeholder="Ex : 33DOXPK5439F1ZI" value="{{ $lead->gst }}" class="form-control mt-2" readonly>
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Product Category</label>
                    @if ($drop = App\Models\Dropdowndata::where('id', $lead->category)->first())
                    <input type="text" name="catepro" class="form-control" value="{{ $drop->dropdowndata }}" placeholder="" style="background-color: #c6cbd0;" readonly  >
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
                        <div class="form-group mt-2">
                            <label>Terms and Conditions</label>
                            <select class="form-control" name="termscondition">
                                <option value=""> -- choose -- </option>
                                <option value="1">100% advance</option>
                            </select>
                        </div>
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
                        <div class="form-group mt-2">
                            <label>Warranty Terms</label>
                            <select class="form-control" name="warranty">
                                <option value=""> -- choose -- </option>
                                <option value="1">12 Months from the date of commissioning</option>
                                <option value="2">12 Months or 2000 Hrs from the date of commissioning Whichever is earlier</option>
                                <option value="3">24 Months or 4000 Hrs from the date of commissioning Whichever is earlier</option>
                            </select>
                        </div>
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
