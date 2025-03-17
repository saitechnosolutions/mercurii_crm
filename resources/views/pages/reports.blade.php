@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')

<div class="container-fluid">
    <div class="row">

        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color: #f2ebe1;">
                    <div class="card-header  text-white  d-flex align-items-center" style="background-color: #f2ebe1;">
                        <span class="icon-box text-white me-2" style="background-color: #205680;">
                            <i class="fas fa-tasks"></i>
                        </span>
                        <h5 class="mb-0">Equipment Sales Booking Value</h5>
                    </div>
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <div class="filter-section mb-4">
                                    <form method="GET" action="{{ url('/viewreport') }}">
                                        <div class="row g-3">
                                            <div class="col-md-2">
                                                <label>From Date</label>
                                                <input type="date" name="fromdate" class="form-control" value="{{ request('fromdate') }}">
                                            </div>

                                            <div class="col-md-2">
                                                <label>To Date</label>
                                                <input type="date" name="todate" class="form-control" value="{{ request('todate') }}">
                                            </div>

                                            <div class="col-md-2">
                                                <label>Assigned To</label>
                                                <select name="assigned_to" class="form-control">
                                                    <option value="">All Users</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ request('assigned_to') == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Category</label>
                                                <select name="category_id" class="form-control">
                                                    <option value="">All Categories</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-2">
                                                <label>Time Filter</label>
                                                <select name="time_filter" class="form-control">
                                                    <option value="">No Filter</option>
                                                    <option value="monthly" {{ request('time_filter') == 'monthly' ? 'selected' : '' }}>This Month</option>
                                                    <option value="weekly" {{ request('time_filter') == 'weekly' ? 'selected' : '' }}>This Week</option>
                                                    <option value="quarterly" {{ request('time_filter') == 'quarterly' ? 'selected' : '' }}>This Quarter</option>
                                                    <option value="fy" {{ request('time_filter') == 'fy' ? 'selected' : '' }}>This Financial Year</option>
                                                </select>
                                            </div>

                                            <div class="col-md-2 align-self-end">
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                                <a href="{{ url('/viewreport') }}" class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <table class="table table-bordered display responsive nowrap" id="pendingTasks">
                                        <thead>
                                            <tr>
                                                <th>Lead ID</th>
                                                <th>Lead Name</th>
                                                <th>Category</th>
                                                <th>Products</th>
                                                <th>Converted Date</th>
                                                <th>Total Value</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($leads as $lead)
                                            <tr>
                                                <td>{{ $lead->lead_id }}</td>
                                                <td>{{ $lead->LeadName }}</td>
                                                <td>{{ $lead->category_name ?? 'N/A' }}</td>
                                                <td>{{ $lead->productname ?? 'N/A' }}</td>
                                                <td>{{ $lead->converteddate ? \Carbon\Carbon::parse($lead->converteddate)->format('d-m-Y') : 'N/A' }}</td>
                                                <td>{{ $lead->grandtotal ?? 'N/A' }}</td>
                                                <td>{{ $lead->stage ?? 'N/A' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No leads available</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: #f2ebe1;">
                    <div class="card-header text-white d-flex align-items-center" style="background-color: #f2ebe1;">
                        <span class="icon-box text-white me-2" style="background-color: #fb6605;">
                            <i class="fas fa-envelope-open-text"></i>
                        </span>
                        <h5 class="mb-0">Spares & Service Sales Booking Value</h5>
                    </div>
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <table class="table table-bordered display responsive nowrap" id="pendingEnquiry">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Enq Ref No</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>City</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>DustFilter Pvt Ltd</td>
                                            <td>CMBM/2024/5458</td>
                                            <td>Sakthivel R</td>
                                            <td>sakthi@dustfilter.com</td>
                                            <td>9876543210</td>
                                            <td>Chidambaram</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="background-color: #f2ebe1;">
                    <div class="card-header text-white  d-flex align-items-center" style="background-color: #f2ebe1;">
                        <span class="icon-box text-white me-2" style="background-color: #205680;">
                            <i class="fas fa-cogs"></i>
                        </span>
                        <h5 class="mb-0">Spares & Service Billing Value</h5>
                    </div>
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <table class="table table-bordered display responsive nowrap" id="technicalClosure">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Quotation Number</th>
                                            <th>Basic Value</th>
                                            <th>Gross Value</th>
                                            <th>Business Ref No</th>
                                            <th>Approval By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>AV Thomas Ltd</td>
                                            <td>CMBM/2024/312</td>
                                            <td>₹25000</td>
                                            <td>₹41300</td>
                                            <td>CMBM/2024/5258</td>
                                            <td>Manager</td>
                                        </tr>
                                        <tr>
                                            <td>Thomas</td>
                                            <td>/2024/312</td>
                                            <td>65000</td>
                                            <td>67300</td>
                                            <td>2024/5258</td>
                                            <td>sales Manager</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingfour">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour" style="background-color: #f2ebe1;">
                      <div class="card-header  text-white  d-flex align-items-center" style="background-color: #f2ebe1;">
                          <span class="icon-box text-white me-2" style="background-color: #fb6605;">
                              <i class="fas fa-briefcase"></i>
                          </span>
                          <h5 class="mb-0">Equipment Billing Value</h5>
                      </div>
                  </button>
                </h2>
                <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingfour" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                      <div class="col-md-12">
                          <div class="card">

                              <div class="card-body">
                                  <table class="table table-bordered display responsive nowrap" id="businessRequirement">
                                      <thead>
                                          <tr>
                                              <th>Customer</th>
                                              <th>BR Ref No</th>
                                              <th>Contact</th>
                                              <th>Email</th>
                                              <th>Phone</th>
                                              <th>Special Approval</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>Audi Components India</td>
                                              <td>CMBM/2024/789</td>
                                              <td>Vivek Anand</td>
                                              <td>vivek@audi.com</td>
                                              <td>9898765432</td>
                                              <td>Yes</td>
                                          </tr>
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
</div>
@endsection

