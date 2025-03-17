@extends('layouts.app')
@section('title', 'Enquiry/Lead Entry')
@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4">
                    <h4>{{ $lead->LeadName }}</h4>
                </div>
                <div class="col-lg-8 d-flex justify-content-end ">


{{--
                    <button class="btn btn-success  btn-sm me-2 schedulebtns" data-bs-toggle="modal"
                    data-bs-target="#ScheduleMeet" title="Schedule Meet"><i class="fa fa-database"
                        aria-hidden="true"></i>&nbsp;&nbsp;Schedule Meet</button>



                        <button class="btn btn-success  btn-sm me-2 schedulebtns" data-bs-toggle="modal"
                            data-bs-target="#ScheduleCall" title="Schedule Call"><i class="fa fa-phone"
                                aria-hidden="true"></i>&nbsp;&nbsp;Schedule Call</button> --}}
                                @if (Auth::user()->role == 'Super Admin')
                    {{-- <button class="btn btn-warning  btn-sm me-2" data-bs-toggle="modal" data-bs-target="#addleadproduct"
                        title="Add Payment"><i class="fa fa-database" aria-hidden="true"></i>&nbsp;&nbsp;Add
                        Product</button> --}}
                        @endif


                </div>
            </div>

        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-4 ">
            <div class="leadinfo mt-3 p-3 sticky-top" style="top:13%;border-radius:5px;z-index:0;box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;">

                <table class="table  table-hover  ">

                    <div class="row">
                        <div class="col-lg-6">
                            <h6>Enquiry Info</h6>
                        </div>
                        @if (Auth::user()->role == 'Super Admin')
                        {{-- <div class="col-lg-6 d-flex justify-content-end">

                            <a href="/lead-edit/{{ $lead->id }}" class="btn btn-danger btn-sm"><i
                                    class="mdi mdi-lead-pencil" aria-hidden="true"></i></a>
                        </div> --}}
                        @endif
                    </div>
                    <tr>
                        <th>Customer Name</th>
                                <td>{{ $lead->LeadName }}</td>
                    </tr>
                    @php
                                            $dropdownValue = App\Models\Dropdowndata::where('id', $lead->Leadsource)->value('dropdowndata');
                                        @endphp
                    <tr>
                        <th>Source of Enquiry</th>
                                <td>{{ $dropdownValue ?? '-' }}</td>
                    </tr>
                    @php
                    $dropdownValue = App\Models\Dropdowndata::where('id', $lead->Leadstatus)->value('dropdowndata');
                @endphp
<tr>
<th>Enquiry Status</th>
        <td>{{ $dropdownValue ?? '-' }}</td>
</tr>
                    <tr>
                        <th>Enquiry Date</th>
                                <td>{{ $lead->Entrydate }}</td>
                    </tr>
                    <tr>
                        <th>Enquiry Details</th>
                                <td>{{ $lead->enquirydetail }}</td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                                <td>
                                <a href="mailto:{{ $lead->email }}" target="_blank">
                                    {{ $lead->email }} <i class="fa fa-envelope" aria-hidden="true"></i>
                                </a>
                                </td>
                    </tr>
                    <tr>
                        <th>Contact Number</th>
                            <td><a href="tel:{{ $lead->phonumber }}"
                                    style="color:#000" target="_blank">{{ $lead->phonumber }}</a>&nbsp;&nbsp;<a
                                    target="_blank" style="color:green"
                                    href="https://api.whatsapp.com/send?phone=91{{ $lead->phonumber }}"><i
                                        class="mdi mdi-whatsapp" aria-hidden="true"></i></a></td>
                    </tr>
                    <tr>
                        <th>Sales Manager</th>
                            @if ($username = App\Models\User::where('id', $lead->assigned_to)->first())
                                <td>{{ $username->name }}</td>
                            @endif
                    </tr>
                    {{-- @if ($fieldinfo = App\Models\Field::where('categoryid', '1')->where('singlepageview', '1')->get())
                        @foreach ($fieldinfo as $info)
                            @if ($info->fieldname == 'Mobile Number')
                                <tr>
                                    <th>{{ $info->fieldname }}</th>
                                    @if ($leadinfo = App\Models\Lead::where('id', $lead->id)->first())
                                        <td><a
                                                style="color:#000">{{ $leadinfo->MobileNumber }}</a>&nbsp;&nbsp;<a
                                                target="_blank" style="color:green"
                                                href="https://api.whatsapp.com/send?phone=91{{ $leadinfo->MobileNumber }}"><i
                                                    class="fa fa-whatsapp" aria-hidden="true"></i></a></td>
                                    @endif
                                </tr>
                            @else
                                <tr>
                                    <th>{{ $info->fieldname }}</th>
                                    @if ($leadinfo = App\Models\Lead::where('id', $lead->id)->first())
                                        <td>
                                            @if ($info->fieldtype == '6')
                                                @if ($leadinfo->{str_replace(' ', '', $info->fieldname)})
                                                    @php echo date("d-m-Y", strtotime($leadinfo->{ str_replace(' ', '', $info->fieldname) })) @endphp
                                                @endif
                                            @elseif($info->fieldtype == '7')
                                            @php
                                            $dropdownValue = App\Models\Dropdowndata::where('id', $leadinfo->{str_replace(' ', '', $info->fieldname)})->value('dropdowndata');
                                        @endphp
                                        {{ $dropdownValue ?? 'N/A' }}
                                            @else
                                                {{ $leadinfo->{str_replace(' ', '', $info->fieldname)} }}
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endif



                        @endforeach
                    @endif --}}

                    {{-- <tr>
                        <th>Assigned From</th>
                        @if ($leadinfo = App\Models\Lead::where('id', $lead->id)->first())
                            @if ($username = App\Models\User::where('id', $lead->id)->first())
                                <td>{{ $username->name }}</td>
                            @endif
                        @endif
                    </tr>
                    <tr>
                        <th>Assigned to</th>
                        @if ($leadinfo = App\Models\Lead::where('id', $lead->id)->first())
                            @if ($username = App\Models\User::where('id', $lead->id)->first())
                                <td>{{ $username->name }}</td>
                            @endif
                        @endif
                    </tr> --}}

                </table>
            </div>
        </div>
        <div class="col-lg-8">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                {{-- <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Call Updates</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Reminders</button>
                </li> --}}
                @if($lead->quota_proceed != 1)
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Design</button>
                </li>
                @endif
                @if($lead->quota_proceed == 1)
                <li class="nav-item" role="presentation">
                    <button class="nav-link " id="pills-payhis-tab" data-bs-toggle="pill" data-bs-target="#pills-payhis" type="button" role="tab" aria-controls="pills-payhis" aria-selected="false">Create Quotation</button>
                  </li>
                  @endif
                  @if (Auth::user()->role == 'Super Admin' && (isset($lead) && $lead->quota_proceed != 1))
                  <li class="nav-item" role="presentation">
                    <button class="nav-link " id="pills-quota-tab" data-bs-toggle="pill" data-bs-target="#pills-quota" type="button" role="tab" aria-controls="pills-quota" aria-selected="false">Move To Quotation</button>
                  </li>
                  @endif
                  {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-Products-tab" data-bs-toggle="pill" data-bs-target="#pills-Products" type="button" role="tab" aria-controls="pills-Products" aria-selected="false">Enquiry Products</button>
                  </li> --}}
              </ul>
              <div class="tab-content" id="pills-tabContent">
                {{-- <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


                    <form action="" enctype="multipart/form-data">
                        <div class="bg-white container-fluid" style="padding:10px;box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;">
                            <div class="row">

                                <div class="col-lg-6 justify-content-center">
                                    <div class="form-group">

                                        <textarea class="form-control callinfodetails" rows="3"
                                            placeholder="+ Add a Followup Notes"></textarea>

                                    </div>
                                </div>
                                <div class="col-lg-4 justify-content-center">
                                    <div class="form-group">
                                        <input type="file"
                                            class="mb-2 mt-2 form-control form-control-sm fileupload"
                                            >
                                        <select class="form-select form-select-sm callinfo" name="callinfo"
                                           >
                                            <option value=""> Choose Call Status *</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-2 justify-content-center">
                                    <div class="form-group">
                                        <input type="hidden"
                                            value="">
                                        <button type="submit" class="mt-2 btn btn-success btn-sm w-100"
                                            style="color:#fff;">Add</button>

                                        <button type="button" class="mt-2 btn btn-warning btn-sm"
                                            style="padding:5px 10px;color:#fff;"
                                            data-bs-toggle="modal" data-bs-target="#callstatusupdate">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    <div class="notes-form-details">
                        <div class="notes-form-box ">
                            <div class="button-box">

                                    <a class="btn btn-success p-2" target="_blank" href="/images/uploads/"
                                        download ><i class="fa fa-download"
                                            aria-hidden="true"></i></a>

                                <button class="btn text-primary notesedit p-2"
                                    data-id="" data-bs-toggle="modal" data-bs-target="#leadeditModal"><i class="mdi mdi-lead-pencil"
                                        aria-hidden="true"></i></button>
                                <button class="btn text-danger notesdelete p-2"
                                    data-id=""><i class="fa fa-trash"
                                        aria-hidden="true"></i></button>
                            </div>
                            <p>Note Datas</p>

                                <span style="background-color:#fbbd54">leadid</span>


                            <span style="background-color:#2ab57d">Date</span>

                                <span style="background-color:#fd625e">username</span>


                                <span style="background-color:#00CFF4">duration</span>

                        </div>
                    </div>


                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">


                    <div class="notes-card mt-3" style="box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;">
                        <form action="" >
                            <div class="container-fluid bg-white " style="padding:10px;">
                                <div class="row">
                                    <div class="col-lg-8 justify-content-center">
                                        <div class="form-group">
                                            <input type="text" class="form-control p-3 "
                                                placeholder="+ Add Task to inbox on Today" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 justify-content-center">
                                        <div class="form-group">
                                            <input type="date" class="form-control  p-3 "
                                                name="activitydate" style="background-color:#fff"
                                                placeholder="YYYY/MM/DD"   required min='@php echo date("Y-m-d") @endphp'>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 justify-content-center">
                                        <div class="form-group">
                                            <input type="hidden"
                                                value="">
                                            <button type="submit" class="btn btn-success btn-sm w-100 mt-3"
                                                style="color:#fff;">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                                <div class="notes-form-details">
                                    <div class="notes-form-box ">
                                        <div class="button-box">
                                            <button class="btn text-primary remainderedit p-2"
                                                data-id="" data-bs-toggle="modal" data-bs-target="#remaindereditModal"><i class="mdi mdi-lead-pencil"
                                                    aria-hidden="true"></i></button>
                                            <button class="btn text-danger remainderdelete p-2"
                                                data-id=""><i class="fa fa-trash"
                                                    aria-hidden="true"></i></button>
                                        </div>
                                        <p>remainder_details</p>

                                            <span style="background-color:#fbbd54">leadid</span>


                                        <span style="background-color:#2ab57d">date</span>

                                            <span style="background-color:#fd625e">username</span>



                                            <span style="background-color:#fbbd54">Call</span>





                                            <span
                                                style="background-color:#fd625e">reminder date</span>



                                            <span
                                                style="background-color:#fbbd54">meet & call time</span>



                                    </div>
                                </div>
                            <div class="notes-form-details shadow mt-3 bg-white">
                                <img src="/images/nodata.png" class="img-fluid m-auto d-block"
                                    style="width:250px;padding:50px;opacity:0.3">
                            </div>

                </div> --}}
                @if($lead->quota_proceed != 1)
                <div class="tab-pane fade show active" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

                    <form action="{{ route('leaddesigns.storedesign') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white container-fluid" style="padding:10px;box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;">
                            <div class="row">

                                <div class="col-lg-6" >
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1"
                                            class="form-label">Category Name </label>
                                            <input type="hidden" name="catename" class="form-control" value="{{ $lead->category }}" placeholder=""   >
                                            <input type="hidden" name="leadiid" class="form-control" value="{{ $lead->id }}" placeholder=""   >
                                            @if ($drop = App\Models\ProductCategory::where('id', $lead->category)->first())
                                            <input type="text" name="" class="form-control" value="{{ $drop->category_name }}" placeholder=""  disabled >
                                            @endif

                                            <input type="hidden" name="assigneeto" class="form-control" value="{{ $lead->assigned_to }}" placeholder=""   >
                                    </div>
                                </div>
                                <div class="col-lg-6" >
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1"
                                            class="form-label">Product Name </label>
                                            <input type="hidden" name="proname" class="form-control" value="{{ $lead->products }}" placeholder=""   >
                                            @if ($prod = App\Models\Product::where('id', $lead->products)->first())
                                            <input type="text" name="" class="form-control" value="{{ $prod->productname }}" placeholder=""  disabled >
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2 justify-content-center">
                                    <div class="form-group">
                                        <textarea name="design" id="summernote" class="summernote"></textarea>


                                    </div>
                                </div>
                                @php
                                // use App\Models\ProductCategory;
                                $breakdown = App\Models\ProductCategory::where('id', $lead->category)->where('type', 'rack')->first();
                            @endphp
                                <div id="dynamic-fields">
                                    <div class="row field-group">
                                        @if (Auth::user()->role == 'Design' && $breakdown)
                                        <div class="col-lg-10 mt-2">
                                        </div>

                                        <div class="col-lg-1 mt-2">

                                        </div>
                                        <div class="col-lg-1 mt-2">
                                            <button type="button" class="btn btn-success add-more">+</button>
                                        </div>
                                        @endif
                                        <div class="col-lg-3 mt-2">
                                            <label for="document" class="form-label">GA Drawing</label>
                                            <input type="file" class="form-control" name="drawing[]">
                                        </div>

                                        @if (Auth::user()->role == 'Design' && $breakdown)
                                        <div class="col-lg-3 mt-2">
                                            <label for="document" class="form-label">Offer</label>
                                            <input type="file" class="form-control" name="offer[]">
                                        </div>
                                        <div class="col-lg-3 mt-2">
                                            <label for="document" class="form-label">Basic Supply</label>
                                            <input type="text" class="form-control basicsupply" name="basicsupply[]" placeholder="" min="0" step="any" required>
                                        </div>
                                        <div class="col-lg-3 mt-2">
                                            <label for="document" class="form-label">Freight/Transportation</label>
                                            <input type="text" class="form-control freightvalue" name="freightvalue[]" placeholder="" min="0" step="any" required>
                                        </div>
                                        <div class="col-lg-3 mt-2">
                                        </div>
                                        <div class="col-lg-3 mt-2">
                                        </div>
                                        <div class="col-lg-3 mt-2">
                                            <label for="document" class="form-label">Installation</label>
                                            <input type="text" class="form-control installvalue" name="installvalue[]" placeholder="" min="0" step="any" required>
                                        </div>
                                        <div class="col-lg-3 mt-2">
                                            <label for="document" class="form-label">Price Value</label>
                                            <input type="text" class="form-control pricevalue" name="pricevalue[]" placeholder="">
                                        </div>
                                        <div class="col-lg-11 mt-2">
                                        </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-lg-10 mt-2">
                                </div>
                                <div class="col-lg-2 mt-2 justify-content-center">
                                    <div class="form-group">
                                        <input type="hidden"
                                            value="">
                                        <button type="submit" class="mt-2 btn btn-success btn-sm w-100"
                                            style="color:#fff;">Add</button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>

                    @if ($designs = App\Models\LeadDesign::where('leadiid','=', $lead->id )->orderBy('id', 'desc')->get())
                        @foreach ($designs as $de)
                    <div class="notes-form-details">
                        <div class="notes-form-box " style="border-left: 8px solid {{ $de->reverse == 1 ? '#ff6501' : '#1b5683' }};">
                            <div class="button-box">
                                {{-- Offer Download --}}
                    @if($de->offer)
                    <a class="btn btn-primary p-2" target="_blank" href="{{ asset($de->offer) }}" download>
                        <i class="fa fa-download"></i> Offer
                    </a>
                @endif

                {{-- Drawing Download --}}
                @if($de->drawing)
                    <a class="btn btn-warning p-2" target="_blank" href="{{ asset($de->drawing) }}" download>
                        <i class="fa fa-download"></i> Drawing
                    </a>
                @endif

                {{-- View Price Value --}}
                @if($de->pricevalue)
                    <a class="btn btn-info p-2" >
                       {{ $de->pricevalue }}
                    </a>
                @endif
                @if($de->pricevalue)
    <div class="dropdown d-inline-block">
        <button class="btn btn-info p-2 dropdown-toggle" type="button" id="priceDropdown{{ $de->id }}" data-bs-toggle="dropdown" aria-expanded="false">
            View Breakdown
        </button>
        <ul class="dropdown-menu" aria-labelledby="priceDropdown{{ $de->id }}">
            <li><a class="dropdown-item" href="#">Basic Supply: {{ $de->basicsupply ?? 'N/A' }}</a></li>
            <li><a class="dropdown-item" href="#">Freight Value: {{ $de->freightvalue ?? 'N/A' }}</a></li>
            <li><a class="dropdown-item" href="#">Installation Value: {{ $de->installvalue ?? 'N/A' }}</a></li>
        </ul>
    </div>
@endif

                                    {{-- <a class="btn btn-success p-2" target="_blank" href="{{ asset($de->document) }}"
                                        download ><i class="fa fa-download"
                                            aria-hidden="true"></i> Design</a> --}}
                                            @if(auth()->id() == $de->assignee)
                                <button class="btn text-primary notesedit p-2"
                                    data-id="" data-bs-toggle="modal" data-bs-target="#leadeditModal"><i class="mdi mdi-lead-pencil"
                                        aria-hidden="true"></i></button>
                                <button class="btn text-danger notesdelete p-2"
                                    data-id=""><i class="fa fa-trash"
                                        aria-hidden="true"></i></button>
                                        @endif
                            </div>
                            <p>{!! $de->design !!}</p>
                            <span style="background-color:{{ $de->reverse == 1 ? '#ff6501' : '#1b5683' }};">{{ \DB::table('users')->where('id', $de->assignee)->value('name') ?? 'Unknown' }}</span>

                                {{-- <span style="background-color:#fbbd54">leadid</span>


                            <span style="background-color:#2ab57d">Date</span>

                                <span style="background-color:#fd625e">username</span>


                                <span style="background-color:#00CFF4">duration</span> --}}

                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
                @endif
                @if($lead->quota_proceed == 1)
                <div class="tab-pane fade " id="pills-payhis" role="tabpanel" aria-labelledby="pills-payhis-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 mt-3">
                                <a href="/createquota/{{ $lead->id }}">
                                    <div class="bg-white estimatecreate">
                                        <div class="es">
                                        <i style="font-size:75px" class="fa fa-plus" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @php

                            $estimates = App\Models\QuotationProduct::where('leadno', $lead->id)
                                        ->orderBy('id', 'DESC')
                                        ->get();

                            $i = count($estimates);
                            $lastQuotationId = $estimates->first()->id ?? null;
                        @endphp



                        @if($estimates->isNotEmpty())
                            @foreach ($estimates as $e)
                            @php
                            // Fetch the related freight record
                            $freight = App\Models\Freight::where('quotationno', $e->id)->first();

                            // Check for term approval
                            $isApproved = false;
                            if ($freight) {
                                $isApproved = App\Models\Term::where(function($query) use ($freight) {
                                    $query->where('id', $freight->termscondition)
                                          ->orWhere('id', $freight->warranty);
                                })
                                ->where('term_approve', 1)
                                ->exists();
                            }
                        @endphp
                                <div class="col-lg-3 mt-3">

                                    <div class="bg-white estimatecreate">
                                        @if($e->id != $lastQuotationId)
                                        <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Revision" class="badge bg-danger ms-1">R</span>
                                    @endif
                                    @if($isApproved)
                    <span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Terms Approval Pending" class="badge bg-info ms-1">AP</span>
                @endif

                                        <div class="es text-center">


                                            <i class="mdi mdi-file-document" style="color:#fe6600;font-size:45px" aria-hidden="true"></i>
                                            <p class=" text-dark mb-0">{{ $e->quotationno }}({{ $i-- }})</p>
                                            <p class="text-dark">₹ {{ $e->grandtotal }}</p>
                                        </div>

                                        <ul class="estimatelist">
                                            <li style="margin:0px 5px">
                                                {{-- {{ route('quotation.pdf', $e->id) }} --}}
                                                <a style="color:#000;" href="/quotation/view/{{ $e->id }}">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            {{-- <li style="margin:0px 11px">
                                                <a style="color:#000;" href="/editestimate/{{ $e->id }}">
                                                    <i class="mdi mdi-lead-pencil" aria-hidden="true"></i>
                                                </a>
                                            </li>
                                            <li style="margin:0px 11px">
                                                <i class="fa fa-trash deleteestimate" aria-hidden="true"></i>
                                            </li>
                                            <li style="margin:0px 11px">
                                                <a href="https://api.whatsapp.com/send?phone=">
                                                    <i class="mdi mdi-whatsapp text-dark" aria-hidden="true"></i>
                                                </a>
                                            </li> --}}
                                            {{-- <li style="margin:0px 11px">
                                                <a style="color:#000;" download href="/estimates/{{ $e->id }}">
                                                    <i class="fa fa-download" aria-hidden="true"></i>
                                                </a>
                                            </li> --}}
                                            <li style="margin:0px 11px">
                                                <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i> <!-- Three-dot icon -->
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <a class="dropdown-item" href="/estimates/{{ $e->id }}" download>
                                                            <i class="fa fa-download" aria-hidden="true"></i> Download
                                                        </a>
                                                    </li>
                                                    @if($e->id == $lastQuotationId)
                                                    <li>
                                                        <a class="dropdown-item" href="/orf/{{ $e->id }}">
                                                            <i class="fa fa-arrow-right" aria-hidden="true"></i> Move to ORF
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @endif


                            {{-- <div class="col-lg-4 ">3</div> --}}
                        </div>
                    </div>
                </div>
                @endif
                <div class="tab-pane fade " id="pills-quota" role="tabpanel" aria-labelledby="pills-quota-tab">

                    <form action="{{ route('document.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="bg-white container-fluid" style="padding:10px;box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;">
                            <div class="row">
                                <div class="col-lg-6 mt-2">
                                    <div class="form-group">
                                        <label for="document" class="form-label">Document / File</label>
                                        <input type="file" class="form-control" name="quota_doc" id="">
                                    </div>
                                </div>
                                <div class="col-lg-4 mt-2">
                                    <div class="form-group">
                                        <label for="document" class="form-label">Proceed</label>
                                        <select id="" name="quota_proceed" class="form-control" required>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 mt-2 justify-content-center">
                                    <div class="form-group">
                                        <input type="hidden" name="idle" value="{{ $lead->id }}">
                                        <button type="submit" class="mt-2 btn btn-success btn-sm w-100"
                                            style="color:#fff;">Add</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>

                {{-- <div class="tab-pane fade show active" id="pills-quota" role="tabpanel" aria-labelledby="pills-quota-tab">
                    <div class="container bg-white pt-3 " style="box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Status</th>
                                            <th>Enquiry Date</th>
                                            <th>Converted Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
        $leadproduct = App\Models\LeadProduct::where('leadid', $lead->id)->get();
    @endphp

    @if ($leadproduct->count() > 0)
        @foreach ($leadproduct as $product)
            <tr>
                <td>  @if ($prod = App\Models\Product::where('id', $product->singleproduct)->first())
                    {{ $prod->productname }}
                @endif</td>
                <td>@if ($drop = App\Models\Dropdowndata::where('id', $product->statuslead)->first())
                    {{ $drop->dropdowndata }}
                @endif</td>
                          <td>{{ $product->enquirydate ?? '-' }}</td>
                <td>{{ $product->coverteddate ?? '-' }}</td>
                <td>
                    <div class="buttons_td">
                        <button type="button" class="btn btn-bull_yellow edit-btnb waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#statusedit"
                        data-productid="{{ $product->id }}" data-status="{{ $product->statuslead }}"  data-leadid="{{ $product->leadid }}"  >
                        <i class="mdi mdi-lead-pencil"></i>
                    </button>
                    </div>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5" class="text-center">No Products Found</td>
        </tr>
    @endif


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="tab-pane fade" id="pills-Products" role="tabpanel" aria-labelledby="pills-Products-tab">
                    <div class="container bg-white pt-3 " style="box-shadow: rgba(0, 0, 0, 0.15) 0px 5px 15px 0px;">
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Status</th>
                                            <th>Enquiry Date</th>
                                            <th>Converted Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
        $leadproduct = App\Models\LeadProduct::where('leadid', $lead->id)->get();
    @endphp

    @if ($leadproduct->count() > 0)
        @foreach ($leadproduct as $product)
            <tr>
                <td>  @if ($prod = App\Models\Product::where('id', $product->singleproduct)->first())
                    {{ $prod->productname }}
                @endif</td>
                <td>@if ($drop = App\Models\Dropdowndata::where('id', $product->statuslead)->first())
                    {{ $drop->dropdowndata }}
                @endif</td>
                          <td>{{ $product->enquirydate ?? '-' }}</td>
                <td>{{ $product->coverteddate ?? '-' }}</td>
                <td>
                    <div class="float-btn top">
                        <a href="" class="btn btn-danger btn-sm"> + </a>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5" class="text-center">No Products Found</td>
        </tr>
    @endif


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

                        </div>


                    </div>

                </div>


                {{-- <div class="modal fade" id="ScheduleMeet" tabindex="-1" aria-labelledby="ScheduleMeet" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="/schedulemeet" method="post">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ScheduleMeet">Add ScheduleMeet</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Call for<span
                                                style="color:red">*</span></label>
                                        <div class="form-group">
                                            <input type="hidden" name="leadid" value="">
                                            <input type="hidden" name="schmeetvalue" value="0">
                                            <input type="hidden" name="userid" value="">
                                            <input type="hidden" name="company_login"
                                                value="">
                                            <input type="text" class="form-control p-3" name="schdulemeet" required
                                                placeholder="+ Add Task to inbox on Today">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Date<span
                                                style="color:red">*</span></label>
                                        <div class="form-group">
                                            <input type="date" class="form-control  p-3" required
                                                name="schduledatedate" style="background-color:#fff" placeholder="YYYY/MM/DD" min='@php echo date("Y-m-d") @endphp'>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Time<span
                                                style="color:red">*</span></label>
                                        <div class="form-group">
                                            <input type="time" class="form-control activitytime p-3" required
                                                name="schduletimetime" style="background-color:#fff">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="modal fade" id="ScheduleCall" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="/schedulecall" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Schedule Call</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Call for<span
                                                style="color:red">*</span></label>
                                        <div class="form-group">
                                            <input type="hidden" name="leadid" value="">
                                            <input type="hidden" name="schmeetvalue" value="1">
                                            <input type="hidden" name="userid" value="">
                                            <input type="hidden" name="company_login"
                                                value="">
                                            <input type="text" class="form-control p-3" name="schdulecall" required
                                                placeholder="+ Add Task to inbox on Today">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Date<span
                                                style="color:red">*</span></label>
                                        <div class="form-group">
                                            <input type="date" class="form-control  p-3 mb-3" required
                                                name="schduledate" style="background-color:#fff" placeholder="YYYY/MM/DD" min='@php echo date("Y-m-d") @endphp'>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Time<span
                                                style="color:red">*</span></label>
                                        <div class="form-group">
                                            <input type="time" class="form-control activitytime p-3 mb-3" required
                                                name="schdulecalltime" style="background-color:#fff">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}

            <div class="modal fade" id="statusedit" tabindex="-1" wire:ignore aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="/statusupdate"  enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Status Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Status <span
                                        style="color:red">*</span></label>
                                        <select class="form-select" name="statuslead" id="statuslead" required>
                                            <option value="">-- Choose Status --</option>
                                            @foreach (App\Models\Dropdowndata::where('formid', 6)->orderBy('orderno', 'asc')->get() as $data)
                                                <option value="{{ $data->id }}">{{ $data->dropdowndata }}</option>
                                            @endforeach
                                        </select>

                            </div>


                            <div class="mt-3 form-group">
                                <label>Converted Date <span class="paymentrequiredalert13" style="color:red">*</span></label>
                                <input type="date" class="mt-2 bg-white form-control" name="converteddate" id="converteddate">
                            </div>

                            <input type="hidden" name="leadid" id="leadid">
                            <input type="hidden" name="productid" id="productid">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

                <div class="modal fade" id="addleadproduct" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="javascript:;" id="saveleadsproduct">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Lead Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Status <span
                                            style="color:red">*</span></label>
                                    <select class="form-select " name="statuslead" required>
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

                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Product <span
                                            style="color:red">*</span></label>
                                    <select class="form-select " name="singleproduct" required>
                                        <option value="">-- Choose Product --</option>
                                        @if ($product = App\Models\Product::get())
                                            @foreach ($product as $dataproduct)
                                                <option value="{{ $dataproduct->id }}"
                                                    >
                                                    {{ $dataproduct->productname }}</option>
                                            @endforeach
                                        @endif

                                    </select>

                                </div>

                                {{-- <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Total Cost <span
                                            class="totalcostmandatory" style="color:red">*</span></label>
                                    <input type="number" class="form-control pinvalidation leadproducttotalcost TotalCost"
                                        name="totalcost" id="exampleFormControlInput1" placeholder="Total Cost">

                                </div> --}}

                                <div class="mt-3 form-group">
                                    <label>Enquiry Date <span class="paymentrequiredalert13"
                                            style="color:red">*</span></label>
                                    <input type="date" class="mt-2 bg-white  form-control "
                                        name="enquirydate">
                                </div>

                                <div class="mt-3 form-group">
                                    <label>Converted Date <span class="paymentrequiredalert13"
                                            style="color:red">*</span></label>
                                    <input type="date" class="mt-2 bg-white  form-control "
                                        name="coverteddate">
                                </div>
                                <input type="hidden" class="form-control "
                                name="leadid" value="{{ $lead->id }}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            {{-- <div class="modal fade" id="leadeditModal" tabindex="-1" wire:ignore aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="javascript:;" id="updatenotes" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Notes Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Notes data</label>
                                <textarea class="form-control" name="leadsdata" rows="4" id="leadsdata"  required></textarea>

                            </div>
                            <div class="form-group mt-3">
                                <label>File Upload</label>
                                <input type="file" class="form-control" name="imagename">
                                <input type="hidden" name="oldimage" id="oldimage">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="leadid" value="">
                            </div>
                            <div class="form-group mt-3">
                                <label>Call Status</label>
                                <select class="form-select form-select-sm callinfo" name="callinfo" id="callinfoedit">
                                    <option value=""> Choose Call Status *</option>

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="remaindereditModal" wire:ignore tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="javascript:;" id="updateremainder" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reminder Edit</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Reminder date</label>
                                            <input type="text" class="form-control" name="remainderdata" id="remainderdata" required>
                                            <input type="date" class="form-control mt-3 activitydate bg-white"
                                                placeholder="YYYY-MM-DD" min="@php echo date(" Y-m-d") @endphp" name="reminderdate"
                                                id="reminderdate">
                                        </div>
                                        <div class="form-group mt-3">
                                            <input type="hidden" name="id" id="remainderid">
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}

                @endsection


                @section('scripts')

                @endsection
