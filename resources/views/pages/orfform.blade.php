@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')
<section class="bg-white">
    <div class="container-fluid bg-white pt-4 pb-5">
        <div class="alert alert-warning alert-dismissible fade show d-none myalert" role="alert" id="myalert">
            <span class="error-text"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <form method="POST" action="{{ route('orf.store') }}" enctype="multipart/form-data">
            @csrf

        <div class="row">
            <div class="col-lg-12 ">
                <h6 class="mb-3">Add Order Review</h6>
            </div>
            <input type="hidden" name="quoproid" value="{{ $quto->id }}" class="form-control mt-2" readonly>
            <input type="hidden" name="leano" value="{{ $quto->leadno }}" class="form-control mt-2" readonly>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Transaction Reference</label>

                    <input type="text" name="tranref" placeholder="Transaction Reference" class="form-control mt-2" readonly style="background-color: #c6cbd0;" value="{{ $quto->lead->lead_id ?? 'N/A' }}">

                </div>
            </div>

            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Quotation Number </label>
                    <input type="text" name="quono" onblur="namevalidation(this)" style="background-color: #c6cbd0;" placeholder="Quotation Number" class="form-control mt-2" value="{{ $quto->quotationno }} ({{ count($estimates) }})" readonly>
                </div>
            </div>

            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Customer </label>
                    <input type="text" name="custo" onblur="namevalidation(this)" style="background-color: #c6cbd0;" placeholder="Customer" class="form-control mt-2" value="{{ $quto->lead->LeadName ?? 'N/A' }}" readonly>
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Quotation Date</label>
                    <input type="text" name="quotadate" style="text-transform:uppercase;background-color: #c6cbd0;"   placeholder="Quotation Date" value="{{ $quto->created_at->format('d-m-Y') }}" class="form-control mt-2" readonly>
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>ORF Reference #</label>

                    <input type="text" name="orfref" class="form-control" value="{{ 'ORF/' . $quto->quotationno . ' (' . count($estimates) . ')' }}" placeholder="" style="background-color: #c6cbd0;" readonly  >

                </div>
            </div>

            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>ORF Date </label>
                    <input type="date" name="orfdate" class="form-control" style="" value="{{ old('orfdate', \Carbon\Carbon::now()->format('Y-m-d')) }}" placeholder=""    >


                </div>
            </div>

            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label> Customer PO ref# </label>

                    <input type="text" name="cusporef" class="form-control" value="" placeholder="" style=""    >

                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>PO Date </label>
                    <input type="date" name="podate" style="text-transform:uppercase;" value=""  class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Attachment Customer PO</label>
                    <input type="file" name="attcuspo" style="text-transform:uppercase;"   class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Attachment Signed Drawing</label>
                    <input type="file" name="sigdraw" style="text-transform:uppercase"   class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>CRD Date</label>



                    <input type="date" name="crddate" style="text-transform:uppercase;"  value=""  class="form-control mt-2" >

                </div>
            </div>

            <div class="col-lg-12 mt-2">
                <div class="form-group">
                    <label>Special Instructions</label>
                   <textarea name="specialins" class="form-control"></textarea>
                </div>
            </div>

        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-warning float-end">Add ORF</button>
        </div>
    </form>
    </div>
</section>
@endsection
