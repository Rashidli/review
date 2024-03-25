<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Landing page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="{{asset('assets/css/select2.css')}}" rel="stylesheet" />
    <!-- jquery.vectormap css -->
    <link href="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px; /* Adjust as needed */
        }

        .custom-table th, .custom-table td {
            border: 1px solid #ddd; /* Border color */
            padding: 8px;
            text-align: left;
        }

        .custom-table th {
            background-color: #f2f2f2; /* Header background color */
        }

        .custom-table tbody tr:nth-child(even) {
            background-color: #f9f9f9; /* Even row background color */
        }

        /*.custom-table tbody tr:hover {*/
        /*    background-color: #e0e0e0; !* Hover row background color *!*/
        /*}*/

        .custom-table tfoot {
            background-color: #f2f2f2; /* Footer background color */
        }

        .custom-table td {
            width: 17%; /* Set the width for the first 4 td elements */
        }

        .custom-table td:nth-last-child(-n+6) {
            width: 8%; /* Set the width for the last 4 td elements */
        }

        /*.custom-table td input[type="number"] {*/
        /*    width: 80px; !* Set a specific width for number input td elements *!*/
        /*}*/
        .custom-table td input, select{
            width: 100%;
        }

        .custom-table button {
            /* Add styles for your delete and create buttons */
            color: #fff;
            background-color: #dc3545; /* Delete button color */
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .custom-table button.btn-success {
            background-color: #28a745; /* Create button color */
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body data-topbar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{route('home')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-sm" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-dark" height="20">
                                </span>
                    </a>

                    <a href="{{route('home')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/57428360.png')}}" alt="logo-sm-light" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img style="width: 100px; height: 70px" src="{{asset('assets/images/57428360.png')}}" alt="logo-light" height="20">
                                </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                    <i class="ri-menu-2-line align-middle"></i>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="ri-search-line"></span>
                    </div>
                </form>

            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-search-line"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="mb-3 m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="ri-fullscreen-line"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block user-dropdown">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-xl-inline-block ms-1">{{Auth::user()->name}}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="javascript: void(0)"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                        <a class="dropdown-item d-block" href="javascript: void(0)"><span class="badge bg-success float-end mt-1">11</span><i class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{route('logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Çıxış</a>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>

                    <li>
                        <a href="{{route('home')}}" class="waves-effect">

                            <span>Admin panel</span>

                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-layout-3-line"></i>
                            <span>İstifadəçilər</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('users.create')}}">İstifadəçi yarat</a></li>
                            <li><a href="{{route('users.index')}}">İstifadəçilər</a></li>
                            <li><a href="{{route('roles.index')}}">Roles</a></li>
                            <li><a href="{{route('permissions.index')}}">Permissions</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-layout-3-line"></i>
                            <span>Usta xidmətləri</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li> <a href="{{route('products.index')}}">Məhsullar</a></li>
                            <li> <a href="{{route('thing_services.index')}}">Xidmətlər</a></li>
                            <li> <a href="{{route('things.index')}}">Ümumi qiymətləndirmə</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-layout-3-line"></i>
                            <span>İşçi qüvvəsi</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li> <a href="{{route('workers.index')}}">İşçi qüvvəsi</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-layout-3-line"></i>
                            <span>İstiqamətlər</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li> <a href="{{route('cars.index')}}">Maşınlar</a></li>
                            <li> <a href="{{route('regions.index')}}">Bakı - Abşeron</a></li>
                            <li> <a href="{{route('directions.index')}}">Bakı - Region</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-layout-3-line"></i>
                            <span>Anbarlar</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li> <a href="{{route('transports.index')}}">Maşınlar</a></li>
                            <li> <a href="{{route('plans.index')}}">Tariflər</a></li>
                            <li> <a href="{{route('plan_warehouses.index')}}">Ümumi anbar (kvm ilə)</a></li>
                            <li> <a href="{{route('transport_warehouses.index')}}">Ümumi anbar (maşın ilə)</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('orders.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Sifariş</span></a>
                    </li>



                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->
