@extends('layouts.app')
@section('title', 'Lead Entry')
@section('main-content')
<div class="container-fluid">
    <div class="row">
        <!-- Pending Tasks -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header  text-white  d-flex align-items-center" style="background-color: #f2ebe1;">
                    <span class="icon-box text-white me-2" style="background-color: #205680;">
                        <i class="fas fa-tasks"></i>
                    </span>
                    <h5 class="mb-0">Equipment Sales Booking Value</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered display responsive nowrap" id="pendingTasks">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Customer</th>
                                <th>Transaction</th>
                                <th>Activity Owner</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Special Approval</td>
                                <td>Hyundai Motor India Ltd. Tamil Nadu</td>
                                <td>CMBM/2024/218</td>
                                <td>D SHRIDHAR</td>
                                <td>Pending with Engg Head</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pending Enquiry -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white d-flex align-items-center" style="background-color: #f2ebe1;">
                    <span class="icon-box text-white me-2" style="background-color: #fb6605;">
                        <i class="fas fa-envelope-open-text"></i>
                    </span>
                    <h5 class="mb-0">Spares & Service Sales Booking Value</h5>
                </div>
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

    <div class="row mt-3">
        <!-- Business Requirement -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header  text-white  d-flex align-items-center" style="background-color: #f2ebe1;">
                    <span class="icon-box text-white me-2" style="background-color: #fb6605;">
                        <i class="fas fa-briefcase"></i>
                    </span>
                    <h5 class="mb-0">Equipment Billing Value</h5>
                </div>
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

        <!-- Technical Closure -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-white  d-flex align-items-center" style="background-color: #f2ebe1;">
                    <span class="icon-box text-white me-2" style="background-color: #205680;">
                        <i class="fas fa-cogs"></i>
                    </span>
                    <h5 class="mb-0">Spares & Service Billing Value</h5>
                </div>
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
@endsection
