<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="/assets/images/new/">
    <!-- preloader css -->
    <link rel="stylesheet" href="/assets/css/preloader.min.css" type="text/css" />
    <link rel="stylesheet" href="/assets/css/custom.css" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/admin-resources/rwd-table/rwd-table.min.css" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet" />

    

</head>

<body>
    <div id="layout-wrapper">

        @include('layouts.topbar')

        {{-- @include('layouts.sidebar') --}}
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        {{-- <div class="main-content"> --}}

            <div class="page-content">
                <div class="container-fluid">

                    @yield('main-content')

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            {{-- @include('layouts.footer') --}}
            {{--
        </div> --}}
        <!-- end main content-->

    </div>
    @stack('scripts')

    {{-- SCRIPTS --}}

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/jquery/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>
    <script src="/assets/libs/feather-icons/feather.min.js"></script>
    <script src="/assets/libs/app.js"></script>
    <!-- pace js -->
    <script src="/assets/libs/pace-js/pace.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/libs/admin-resources/rwd-table/rwd-table.min.js"></script>

    <!-- Init js -->
    <script src="/assets/js/pages/table-responsive.init.js"></script>

    <!-- Required datatable js -->
    <script src="/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <script src="/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->
    <script src="/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>


    <!-- Datatable init js -->
    <script src="/assets/js/pages/datatables.init.js"></script>

    <script src="/assets/js/app.js"></script>
    <script>
        $(document).ready(function() {
            $('#technicalClosure').DataTable({
                responsive: true,
                autoWidth: false
            });
        });
        </script>
          <script>
            $(document).ready(function() {
                $('#pendingTasks').DataTable({
                    responsive: true,
                    autoWidth: false
                });
            });
            </script>
              <script>
                $(document).ready(function() {
                    $('#pendingEnquiry').DataTable({
                        responsive: true,
                        autoWidth: false
                    });
                });
                </script>
                  <script>
                    $(document).ready(function() {
                        $('#businessRequirement').DataTable({
                            responsive: true,
                            autoWidth: false
                        });
                    });
                    </script>

    <script>
        $(document).ready(function () {
            // Initialize Select2 for searchable dropdown
            $('#customerSelect').select2({
                placeholder: 'Search or Select Customer',
                allowClear: true
            });

            // Show the input field if "New Customer" is selected
            $('#customerSelect').change(function () {
                var customerName = $(this).val();
                if (customerName === 'new') {
                    $('#newCustomerName').show().prop('required', true);
                    $('#contactName').val(''); // Clear the input fields
                } else {
                    $('#newCustomerName').hide().prop('required', false);

                    // Fetch the customer data when an existing customer is selected
                    var customerId = $(this).find(':selected').data('id');
                    if (customerId) {
                        // Perform an AJAX request to fetch the customer's contact information
                        $.ajax({
                            url: '/get-customer-data/' + customerId,  // Route to fetch customer data
                            method: 'GET',
                            success: function (data) {
                                if (data) {
                                    // Populate the input fields with the customer's data
                                    $('#contactName').val(data.contactname);
                                    $('#postalcode').val(data.postalcode);
                                    $('#address').val(data.address);
                                    $('#contact_no').val(data.contact_no);
                                    $('#cus_email').val(data.cus_email);
                                    $('#ggst').val(data.gstno);
                                    $('#country').val(data.country).change();
                                    $('#country_code').val(data.country_code).change();
                                    $('#state_list').val(data.state).change();

                                    // Fetch cities based on the selected state
                                    fetchCities(data.state, data.city);
                                }
                            },
                            error: function () {
                                alert('Unable to fetch customer data.');
                            }
                        });
                    }
                }
            });

            function fetchCities(stateId, selectedCity) {
                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId,  // Fetch cities based on state
                        method: 'GET',
                        success: function (response) {
                            $('#city_list').empty().append('<option value=""> -- Choose City -- </option>');

                            $.each(response, function (index, city) {
                                $('#city_list').append(
                                    `<option value="${city.id}" ${city.id == selectedCity ? 'selected' : ''}>${city.city_name}</option>`
                                );
                            });
                        },
                        error: function () {
                            alert('Unable to fetch cities.');
                        }
                    });
                }
            }

            $(document).on("change",'.state_list',function(){
                
                fetchCitiesVendor($(this).val());
            });

            function fetchCitiesVendor(stateId) {
                if (stateId) {
                    $.ajax({
                        url: '/get-cities/' + stateId,
                        method: 'GET',
                        success: function (response) {
                            $('#vendor_city_list').empty().append('<option value=""> -- Choose City -- </option>');

                            $.each(response, function (index, city) {
                                $('#vendor_city_list').append(
                                    `<option value="${city.id}">${city.city_name}</option>`
                                );
                            });
                        },
                        error: function () {
                            alert('Unable to fetch cities.');
                        }
                    });
                }
            }
        });

    </script>

<script>
    var updatellStatusUrl = "{{ route('lead.updateStatusdf') }}"; // Laravel will process this

    $(document).ready(function() {
        $(document).on('click', '.change-status-btn', function() {
            var leadId = $(this).data('ids');
            $('#lead_id').val(leadId);
            $('#statusModal').modal('show');
        });

        $('#changeStatusForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: updatellStatusUrl, // This will now be parsed correctly
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert("Status Updated Successfully!");
                        $('#statusModal').modal('hide');
                        $('#leads').DataTable().ajax.reload();
                    } else {
                        alert("Something went wrong!");
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

<script>
    var updateorStatusUrl = "{{ route('orf.insertStatusorf') }}"; // Laravel will process this

    $(document).ready(function() {
        $(document).on('click', '.orf-status-btn', function() {
            var leadId = $(this).data('id');
            var cssta = $(this).data('cssta');
            $('#orfid').val(leadId);
            $('#cssta').val(cssta);
            $('#statusModale').modal('show');
        });

        $('#orfstatus').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: updateorStatusUrl,
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert("Status Updated Successfully!");
                        $('#statusModale').modal('hide');
                        $('#orf').DataTable().ajax.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

<script>
    var updateCsStatusUrl = "{{ route('orf.updatecsStatusorf') }}";

    $(document).ready(function() {
        $(document).on('click', '.orf-csstatus-btn', function() {
            var leadId = $(this).data('rid');
            var appsta = $(this).data('appsta'); // Fix: Use correct data attribute
            $('#orfidcs').val(leadId);
            $('#appsta').val(appsta);
            $('#statusModalcs').modal('show');
        });

        $('#orfcsstatus').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: updateCsStatusUrl,
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success) {
                        alert("CS Status Updated Successfully!");
                        $('#statusModalcs').modal('hide');
                        $('#orf').DataTable().ajax.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>


    <script>

        $('#summernote').summernote({
            placeholder: 'Customize Design',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

    </script>


    <script>
        $(document).ready(function () {
            $(".lead-card").on("click", function () {
                $.ajax({
                    url: "{{ route('getLeads') }}",
                    type: "GET",
                    success: function (response) {
                        let tableBody = $("#leadsTable tbody");
                        tableBody.empty();
                        response.leads.forEach(function (lead) {
                            tableBody.append(`
                        <tr>
                            <td>${lead.Entrydate}</td>
                            <td>${lead.LeadName}</td>
                            <td>${lead.Leadsource}</td>
                            <td>${lead.Leadstatus}</td>
                             <td> <a href="singlelead/${lead.id}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a></td>
                        </tr>
                    `);
                        });
                    }
                });
            });
        });
    </script>
    @yield('scripts')
</body>

</html>