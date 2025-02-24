@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')
<section class="bg-white">
    <div class="container-fluid bg-white pt-4 pb-5">
        <div class="alert alert-warning alert-dismissible fade show d-none myalert" role="alert" id="myalert">
            <span class="error-text"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <form method="POST" action="{{ route('createestimate') }}">
            @csrf

        <div class="row">
            <div class="col-lg-12 ">
                <h6 class="mb-3">Create Quotation</h6>
            </div>
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
                        {{-- @if($city = App\Models\Citie::get())
                            @foreach ($city as $c)
                                <option value="{{ $c->city_id }}">{{ $c->city_name }}</option>
                            @endforeach
                        @endif --}}

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
            {{-- <div class="col-lg-4 mt-2">
                <div class="form-group">
                    <label>Bill To <span style="color:red">*</span>&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-warning" style="background-color: #fe6601;font-size:12px;padding:0px 10px;border-radius:50px" id="leadaddresscopy">Copy of Ship to</button></label>
                    <textarea class="form-control mt-2" name="billto" id="billtoaddress" required></textarea>
                </div>
            </div>
            <div class="col-lg-4 mt-2">
                <div class="form-group">
                    <label>Ship To <span style="color:red">*</span></label>
                    <textarea class="form-control mt-2" id="shipaddress" name="shipto"></textarea>
                </div>
            </div> --}}
            {{-- <div class="col-lg-3 mt-2">
                <div class="form-group">
                    <label>Bank Detail <span style="color:red">*</span></label>
                    <select class="form-select select2 mt-2" name="whichbank" required >

                    </select>
                </div>
    </div> --}}
            {{-- <div class="col-lg-12">
                <table class="table mt-3" >
                    <thead>
                        <tr>
                            <th style="width:250px">Item Description <span style="color:red">*</span></th>
                            <th>HSN Code <span style="color:red">*</span></th>
                            <th>Qty <span style="color:red">*</span></th>
                            <th>Rate <span style="color:red">*</span></th>
                            <th>GST <span style="color:red">*</span></th>

                            <th>Amount <span style="color:red">*</span></th>
                            <th>Action <span style="color:red">*</span></th>
                        </tr>
                    </thead>
                    <tbody id="appendstageparent">
                        <tr class="appendstage">
                            <td>
                                <select class="form-select js-example-basic-single prname" name="productname[]" required>
                                    <option>-- Select Products --</option>
                                        @if ($products = App\Models\Product::get())
                                            @foreach ($products as $p)
                                                <option value="{{ $p->id }}">{{ $p->productname }}</option>
                                            @endforeach
                                        @endif

                                </select>
                                <textarea class="form-control mt-2" placeholder="Enter Description" name="productdesc[]"></textarea>
                            </td>
                            <td>
                                <input type="text" class="form-control hsncode" required name="hsncode[]"  placeholder="HSN Code" >
                            </td>
                            <td>
                                <input type="text" class="form-control qty" required name="qty[]" placeholder="Qty">
                            </td>
                            <td>
                                <input type="text" class="form-control rate" required name="rate[]" placeholder="Rate" >
                            </td>
                            <td>
                                <input type="text" class="form-control gst" required name="gst[]" placeholder="GST" >
                            </td>

                            <td>
                                <input type="text" class="form-control amt" required name="amount[]" placeholder="Amount">
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn-sm btn btn-warning addstage m-1"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                <button type="button" class="btn-sm btn btn-danger removestage m-1" style="visibility: hidden"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div> --}}
            {{-- <div class="col-lg-8"></div> --}}
            {{-- <div class="col-lg-4 ">
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">Subtotal</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control totprice" id="inputPassword" name="subtotal" readonly>
                    </div>
                  </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-4 col-form-label">SGST</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control totalsgst" id="inputPassword" name="totalsgst" readonly>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword1" class="col-sm-4 col-form-label">CGST</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control totalcgst" id="inputPassword1" name="totalcgst" readonly>
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword1" class="col-sm-2 col-form-label">Discount</label>

                    <select class="col-sm-2 discounttype" name="discounttype">
                        <option value="0">Type</option>
                        <option value="1">₹</option>
                        <option value="2">%</option>
                    </select>
                    <div class="col-sm-8">
                      <input type="number" class="form-control discount" id="inputPassword1" name="discount" value="0">
                      <input type="hidden" class="form-control discountamt" id="inputPassword1" name="discountamt">
                    </div>
                  </div>
                  <div class="mb-3 row">
                    <label for="inputPassword2" class="col-sm-4 col-form-label">Total</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control finalamt" id="inputPassword2" name="totprice" readonly>
                      <input type="hidden" class="form-control wodiscounttotprice" id="inputPassword2" name="wodiscounttotprice" readonly>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-warning float-end">Create Estimate</button>
            </div> --}}
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-warning float-end">Create Quotation</button>
        </div>
    </form>
    </div>
</section>
@endsection
