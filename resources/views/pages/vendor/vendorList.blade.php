@extends('layouts.app')
@section('title', 'Vendors Details')
@section('main-content')

    {{-- @include('sweetalert::alert') --}}

    <section class="section leadsection container">
        <div class=" form-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mt-2">Vendor Details</h5>
                        </div>
                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-2">
                            <a href="/add-vendors" class="btn btn-primary d-block add-employee-btn">Add Vendor</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="container mt-5">
        <div class="card">
            <div class="card-header">All Vendors</div>
            <div class="card-body">
                <table id="vendor-table" class="display">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Contact Name</th>
                            <th>Contact Number</th>
                            <th>Gst Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $vendors = App\Models\Vendor::with(["stateData", "cityData"])->get();
                        @endphp
                        @foreach ($vendors as $data)
                            @php
                                $stateName = $data->stateData->state;
                                $cityName = $data->cityData->city_name;
                            @endphp
                            <tr>
                                <td>{{ $data->company_name }}</td>
                                <td>{{ $data->address }}</td>
                                <td>{{ $cityName }}</td>
                                <td>{{ $data->point_of_contact }}</td>
                                <td>{{ $data->contact_number }}</td>
                                <td>{{ $data->gst_number }}</td>
                                <td>
                                    <span class="badge bg-success">{{$data->vendor_status}}</span>
                                </td>
                                <td>
                                    <div class="vendor-action d-flex">
                                        <a href="/edit-vendors"><button class="btn btn-info me-2">Edit</button></a>
                                        <button class="btn btn-danger">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section("scripts")
    <script>
        let table = new DataTable('#vendor-table');
    </script>
@endsection