{{-- <header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">

            <div class="navbar p-5">
                <a href="/dashboard" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/assets/images/new/.png" alt="" height="54">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/new/.png" alt="" height="54">
                        <span class="logo-txt">Mercury Storage Solutions</span>
                    </span>
                </a>

                <a href="/dashboard" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="/assets/images/new/.png" alt="" height="24">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/new/.png" alt="" height="24">
                        <span class="logo-txt">Mercury Storage Solutions</span>
                    </span>
                </a>
            </div>

        </div>

        <div class="d-flex justify-content-center">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="{% trans %}Search{% endtrans %}..."
                                    aria-label="Search Result">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    Masters
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <div class="p-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="{{ url('/setup/fields') }}">
                                    <span>Field Customization</span>
                                </a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div>

        </div>
        <div>

        </div>
    </div>
</header> --}}


<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="navbar-brand-box">
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="/assets/images/logom.png" alt="" height="54">
                        {{-- <span class="logo-txt">Mercury Storage Solutions</span>
                    </span> --}}
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/logom.png" alt="" height="54">

                        {{-- <span class="logo-txt">Mercury Storage Solutions</span>
                    </span> --}}
                    </span>
                </a>

                <a href="#" class="logo logo-light">
                    <span class="logo-sm">
                        {{-- <span class="logo-txt">Mercury Storage Solutions</span>
                    </span> --}}
                    <img src="/assets/images/logom.png" alt="" height="54">
                    </span>
                    <span class="logo-lg">
                        <img src="/assets/images/logom.png" alt="" height="54">

                        {{-- <span class="logo-txt">Mercury Storage Solutions</span>
                    </span> --}}
                    </span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="/dashboard" id="topnav-dashboard"
                            role="button">
                            <i data-feather="home"></i><span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                    @if (Auth::user()->role == 'Super Admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <i data-feather="grid"></i><span data-key="t-apps">Master</span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                {{-- <a href="{{ url('/setup/fields') }}" class="dropdown-item" data-key="t-calendar">Field
                                    Customization</a> --}}

                            <a href="{{ url('/users') }}" class="dropdown-item"
                                data-key="t-calendar">Users</a>

                                <a href="{{ url('/products') }}" class="dropdown-item"
                                data-key="t-calendar">Products</a>
                                <a href="{{ url('/customer') }}" class="dropdown-item"
                                data-key="t-calendar">Customer</a>
                                <a href="/terms" class="dropdown-item"
                                data-key="t-calendar">Add Terms</a>
                                <a href="{{ url('/product-categories') }}" class="dropdown-item" data-key="t-calendar">Product Categories</a>

                            </div>
                        </li>


                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="/activities" id="topnav-dashboard"
                                role="button">
                                <i data-feather="home"></i><span data-key="t-dashboards">Activities</span>
                            </a>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="/viewleads" id="topnav-dashboard"
                                role="button">
                                <i data-feather="home"></i><span data-key="t-dashboards">Leads</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Design')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="/viewconverted" id="topnav-dashboard"
                                role="button">
                                <i data-feather="home"></i><span data-key="t-dashboards">Design</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 'Super Admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="/viewquota" id="topnav-dashboard"
                                role="button">
                                <i data-feather="home"></i><span data-key="t-dashboards">Quotation</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="/vieworfapp" id="topnav-dashboard"
                                role="button">
                                <i data-feather="home"></i><span data-key="t-dashboards">ORF</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="/viewreport" id="topnav-dashboard"
                                role="button">
                                <i data-feather="home"></i><span data-key="t-dashboards">Reports</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Cs')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                <i data-feather="grid"></i><span data-key="t-apps">Approvals</span>
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                {{-- <a href="{{ url('/setup/fields') }}" class="dropdown-item" data-key="t-calendar">Field
                                    Customization</a> --}}

                                <a href="/vieworf" class="dropdown-item" data-key="t-calendar">ORF Approval</a>

                            </div>
                        </li>
                    @endif


                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="/enq-leadentry" id="topnav-dashboard"
                            role="button">
                            <i data-feather="home"></i><span data-key="t-dashboards">Quotation</span>
                        </a>
                    </li>
                    @endif --}}
                    <!-- vendor menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                            <i data-feather="grid"></i><span data-key="t-apps">Vendor Master</span>
                            <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">

                            {{-- <a href="{{ url('/setup/fields') }}" class="dropdown-item" data-key="t-calendar">Field
                                Customization</a> --}}

                            <a href="{{ url('/vendors') }}" class="dropdown-item" data-key="t-calendar">Vendors</a>
                            <a href="{{ url('/purchase-order') }}" class="dropdown-item" data-key="t-calendar">Purchase
                                Order</a>
                            <a href="{{ url('/purchase-entry') }}" class="dropdown-item" data-key="t-calendar">Products
                                Entry</a>

                        </div>
                    </li>

                </ul>
            </div>
            @php
    use App\Models\Term;
    use App\Models\Orf;
    use Illuminate\Support\Facades\Auth;

    $userRole = Auth::user()->role; // Assuming the role field is 'role'

    // Fetch counts based on role
    $termApprovalCount = 0;
    $orfApprovalCount = 0;
    $orfcsApprovalCount = 0;
    $totalNotifications = 0;

    if ($userRole === 'Cs') {
        $orfcsApprovalCount = Orf::where('cs_status', 0)->count();
        $totalNotifications = $orfcsApprovalCount;
    } else {
        $termApprovalCount = Term::where('term_approve', 1)->count();
        $orfApprovalCount = Orf::where('approval_status', 0)->count();
        $totalNotifications = $termApprovalCount + $orfApprovalCount;
    }
@endphp

@if ($totalNotifications > 0)
    <div class="dropdown d-inline-block">
        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard"
           role="button" style="padding: 10px;" data-bs-toggle="dropdown">
            <i data-feather="home"></i>
            <span data-key="t-dashboards">
                <i class="mdi mdi-bell"></i>
                <span class="badge-count">{{ $totalNotifications }}</span>
            </span>
        </a>

        <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
            @if ($userRole === 'Cs' && $orfcsApprovalCount > 0)
                <a href="/vieworf" class="dropdown-item" data-key="t-calendar">
                    ORF CS Approval <span class="badge bg-danger">{{ $orfcsApprovalCount }}</span>
                </a>
            @endif

            @if ($termApprovalCount > 0)
                <a href="/terms" class="dropdown-item" data-key="t-calendar">
                    Terms Approval <span class="badge bg-danger">{{ $termApprovalCount }}</span>
                </a>
            @endif

            @if ($orfApprovalCount > 0)
                <a href="/vieworf" class="dropdown-item" data-key="t-calendar">
                    ORF Approval <span class="badge bg-danger">{{ $orfApprovalCount }}</span>
                </a>
            @endif
        </div>
    </div>
@endif


            <div class="dropdown d-inline-block">

                <button type="button" class="btn header-item bg-light-subtle border-start border-end" style=" background-color:#ffffff !important;
    border:none !important;" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="/assets/images/people.png" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <a class="dropdown-item" href="/logout"><i
                            class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                </div>
            </div>
        </nav>
    </div>
</div>
