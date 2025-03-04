@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')

    {{-- @include('sweetalert::alert') --}}

    <section class="section leadsection container" >
        <div class=" form-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mt-2">Order Review Form (ORF)Sales Approval</h5>
                        </div>
                        <div class="col-lg-6">

                        </div>
                        {{-- <div class="col-lg-2">
                            <a href="/addleads" class="btn btn-primary d-block add-employee-btn" >Add Lead Enquiry</a>
                        </div> --}}
                    </div>
                </div>
            </div>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>


    <div class="modal fade" id="statusModale" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Change ORF Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="orfstatus">
                        @csrf
                        <input type="hidden" id="orfid" name="orfid">
                        <input type="hidden" id="cssta" name="cssta">

                            <div class="form-group mt-4 mb-3">
                                <label for="exampleFormControlInput1"
                                    class="form-label">Approval Proceed <span
                                    style="color:red">*</span></label>
                                    <select class="form-select " name="approval_status" required>
                                        <option value="0"> No </option>
                                        <option value="1"> Yes </option>

                                    </select>
                            </div>

                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="statusModalcs" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Change ORF CS Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="orfcsstatus">
                        @csrf
                        <input type="hidden" id="orfidcs" name="orfid">
                        <input type="hidden" id="appsta" name="appsta">

                            <div class="form-group mt-4 mb-3">
                                <label for="exampleFormControlInput1"
                                    class="form-label">Approval Proceed <span
                                    style="color:red">*</span></label>
                                    <select class="form-select " name="cs_status" required>
                                        <option value="0"> No </option>
                                        <option value="1"> Yes </option>

                                    </select>
                            </div>

                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

