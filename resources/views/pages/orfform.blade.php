@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')
<section class="bg-white">
    <div class="container-fluid bg-white pt-4 pb-5">
        <div class="alert alert-warning alert-dismissible fade show d-none myalert" role="alert" id="myalert">
            <span class="error-text"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <form method="POST" action="">
            @csrf

        <div class="row">
            <div class="col-lg-12 ">
                <h6 class="mb-3">Add Order Review</h6>
            </div>
            <input type="hidden" name="leadno" value="" class="form-control mt-2" readonly>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Transaction Reference</label>

                    <input type="text" name="quotationno" placeholder="Transaction Reference" class="form-control mt-2" readonly style="background-color: #c6cbd0;" value="">

                </div>
            </div>

            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Quotation Number </label>
                    <input type="text" name="clientname" onblur="namevalidation(this)" style="background-color: #c6cbd0;" placeholder="Quotation Number" class="form-control mt-2" value="{{ $quto->quotationno }}" readonly>
                </div>
            </div>

            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Customer </label>
                    <input type="text" name="clientname" onblur="namevalidation(this)" style="background-color: #c6cbd0;" placeholder="Customer" class="form-control mt-2" value="" readonly>
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Quotation Data</label>
                    <input type="text" name="gstnum" style="text-transform:uppercase;background-color: #c6cbd0;"   placeholder="Quotation Data" value="" class="form-control mt-2" readonly>
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>ORF Reference #</label>

                    <input type="text" name="catepro" class="form-control" value="" placeholder="" style="background-color: #c6cbd0;" readonly  >

                </div>
            </div>

            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>ORF Date </label>
                    <input type="text" name="product" class="form-control" style="" value="" placeholder=""    >


                                            {{-- <input type="text" name="" class="form-control" style="background-color: #c6cbd0;" value="" placeholder="" readonly   > --}}

                </div>
            </div>

            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label> Customer PO ref# </label>

                    <input type="text" name="part_no" class="form-control" value="" placeholder="" style=""    >

                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>PO Date </label>
                    <input type="text" name="quanty" style="text-transform:uppercase;" value=""  class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Attachment Customer PO</label>
                    <input type="file" name="allowdis" style="text-transform:uppercase;"   class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>Attachment Signed Drawing</label>
                    <input type="file" name="requestdis" style="text-transform:uppercase"   class="form-control mt-2" >
                </div>
            </div>
            <div class="col-lg-6 mt-2">
                <div class="form-group">
                    <label>CRD Date</label>



                    <input type="text" name="ratee" style="text-transform:uppercase;"  value=""  class="form-control mt-2" >

                </div>
            </div>

            <div class="col-lg-12 mt-2">
                <div class="form-group">
                    <label>Special Instructions</label>
                   <textarea  class="form-control"></textarea>
                </div>
            </div>
            {{-- <div class="col-lg-2 mt-2">
                <div class="form-group">
                    <label>Tax(%)</label>

                    <input type="text" name="tax" style="text-transform:uppercase;background-color: #c6cbd0;"  value=""  readonly class="form-control mt-2" >

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
            </div> --}}

        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-warning float-end">Add ORF</button>
        </div>
    </form>
    </div>
</section>
@endsection
