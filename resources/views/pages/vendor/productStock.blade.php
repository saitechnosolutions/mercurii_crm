@extends('layouts.app')
@section('title', 'Product Stock Details')
@section('main-content')

    {{-- @include('sweetalert::alert') --}}

    <section class="section leadsection container">
        <div class=" form-card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mt-2">Product Stock Details</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <div class="container mt-5">
        <div class="card">
            <div class="card-header">Product Stock Details</div>
            <div class="card-body">
                <table id="purchase-entry-table" class="display">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Product Category</th>
                            <th>Products</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $products = App\Models\Product::with('category')->get();
                            $i=1;
                        @endphp
                        @foreach ($products as $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $data->category->category_name }}</td>
                                <td>{{ $data->productname }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>
                                    <a href="#"><button class="btn btn-info me-2">Edit</button></a>
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
        let table = new DataTable('#purchase-entry-table');
    </script>
@endsection