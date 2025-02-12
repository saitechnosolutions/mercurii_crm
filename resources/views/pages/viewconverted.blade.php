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
                            <h5 class="mt-2">Coverted Enquires</h5>
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

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

