@extends('layouts.app')
@section('title', 'Add Terms Details')
@section('main-content')

    <section class="section leadsection">
        <div class="container form-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mt-2">Add Terms Details</h5>
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-2">
                            <a href="/terms" class="btn btn-primary d-block add-employee-btn">Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="/saveterms">
                <div class="row mb-4">
                    @csrf
                    <div class="col-lg-4">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Invoice Type<span
                                    style="color:red">*</span></label>
                            <select class="form-select " name="whichterm" required>
                                <option value="">-- Choose Invoice --</option>
                                        <option value="1">Sales Quotation</option>
                                        <option value="2">PO Invoice</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Terms Type<span
                                    style="color:red">*</span></label>
                            <select class="form-select " name="termtype" required>
                                <option value="">-- Choose Terms Type --</option>
                                        <option value="1">Terms and Conditions</option>
                                        <option value="2">Warranty Terms</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mt-4">
                            <label for="exampleFormControlInput1" class="form-label">Content <span
                                    style="color:red">*</span></label>
                            <textarea name="content" class="form-control" id="termcontent" placeholder=""
                                required></textarea>
                        </div>
                    </div>


                </div>
        </div>
        <button type="submit" class="btn btn-primary m-auto d-block add-employee-btn mt-4 mb-2">Save Content</button>
        </form>
    </section>
@endsection
