
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

        .custom-table td:nth-last-child(-n+4) {
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

    <header id="page-topbar" style="background-color: white">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">

                    <a href="" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-sm" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-dark" height="20">
                                </span>
                    </a>

                    <a href="#" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/57428360.png')}}" alt="logo-sm-light" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img style="width: 100px; height: 70px" src="{{asset('assets/images/57428360.png')}}" alt="logo-light" height="20">
                                </span>
                    </a>

                </div>




            </div>


        </div>
    </header>




    <div class="">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if(session('message'))
                                    <div class="alert alert-success">{{session('message')}}</div>
                                @endif
                                <h4 class="card-title">Sifariş</h4>
                                <br>
                                <br>

                                <div class="custom-table table-responsive">
                                    <table class="table responsive  table-bordered mb-0">

                                        <thead>
                                        <tr>
                                            <th>Sifarişçi</th>
                                            <th>Baxış tarixi</th>
                                            <th>Əməkdaşlıq</th>
                                            <th>Nömrə</th>
                                            <th>Email</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td>{{$order->customer_name}}</td>
                                            <td>{{$order->review_date}}</td>
                                            <td>{{$order->review_type}}</td>
                                            <td>{{$order->phone}}</td>
                                            <td>{{$order->email}}</td>
                                        </tr>


                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                                    @if(count($order->order_products))
                                        <div class="row table-responsive">
                                            <div class="col-12">
                                                <h4>Məhsullar</h4>
                                                <table class="custom-table responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Məhsul</th>
                                                        <th>Sayı</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->order_products as $order_product)
                                                        <tr>
                                                            <td>{{$order_product->product}} </td>
                                                            <td> {{$order_product->product_quantity}} </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    @if(count($order->order_directions))
                                        <div class="row table-responsive">
                                            <div class="col-12">
                                                <h4>Nəqliyyat</h4>
                                                <table class="custom-table responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Maşın</th>
                                                        <th>Region</th>
                                                        <th>İstiqamət</th>
                                                        <th>Qiymət</th>
                                                        <th>Reys sayı</th>
                                                        <th>Fəhlə sayı</th>
                                                        <th>Ümumi qiymət</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->order_directions as $order_direction)
                                                        <tr>
                                                            <td>{{$order_direction->direction_car}} </td>
                                                            <td> {{$order_direction->direction_type}}</td>
                                                            <td>{{$order_direction->direction}}{{$order_direction->from}}-{{$order_direction->to}}</td>
                                                            <td> {{$order_direction->direction_price}}</td>
                                                            <td>{{$order_direction->direction_quantity}} </td>
                                                            <td>{{$order_direction->direction_worker_total}} </td>
                                                            <td> {{$order_direction->direction_total}} </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    @if(count($order->order_masters))
                                        <div class="row table-responsive">
                                            <div class="col-12">
                                                <h4>Usta xidməti</h4>
                                                <table class="custom-table responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Əşya</th>
                                                        <th>Xidmət</th>
                                                        <th>Qiymət</th>
                                                        <th>Sayı</th>
                                                        <th>Ümumi qiymət</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->order_masters as $order_thing)
                                                        <tr>
                                                            <td>{{$order_thing->thing}} </td>
                                                            <td>{{$order_thing->thing_service}}</td>
                                                            <td> {{$order_thing->thing_price}}</td>
                                                            <td>{{$order_thing->thing_quantity}} </td>
                                                            <td> {{$order_thing->thing_total}} </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    @endif

                                    @if(count($order->order_workers))
                                        <div class="row table-responsive">
                                            <div class="col-12">
                                                <h4>Fəhlə icarə</h4>
                                                <table class="custom-table responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Növbə</th>
                                                        <th>Qiymət</th>
                                                        <th>Sayı</th>
                                                        <th>Gün</th>
                                                        <th>Ümumi qiymət</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->order_workers as $order_worker)
                                                        <tr>
                                                            <td>{{$order_worker->worker}} </td>
                                                            <td> {{$order_worker->worker_price}}</td>
                                                            <td>{{$order_worker->worker_quantity}} </td>
                                                            <td>{{$order_worker->worker_day}} </td>
                                                            <td> {{$order_worker->worker_total}} </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    @if(count($order->order_stores))
                                        <div class="row table-responsive">
                                            <div class="col-12">
                                                <h4>Anbar (maşın ilə)</h4>
                                                <table class="custom-table responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Maşını seç</th>
                                                        <th>Anbarı seç</th>
                                                        <th>Aylıq/Günlük</th>
                                                        <th>Qiymət</th>
                                                        <th>Gün/Ay sayı</th>
                                                        <th>Ümumi qiymət</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->order_stores as $order_store)
                                                        <tr>
                                                            <td>{{$order_store->transport}} </td>
                                                            <td> {{$order_store->store}}</td>
                                                            <td>{{$order_store->month_day == 'daily_price'? 'Günlük' : 'Aylıq'}} </td>
                                                            <td>{{$order_store->store_price}} </td>
                                                            <td>{{$order_store->day_quantity}} </td>
                                                            <td> {{$order_store->store_total}} </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    @if(count($order->order_kv_stores))
                                        <div class="row table-responsive">
                                            <div class="col-12">
                                                <h4>Anbar (kv ilə)</h4>
                                                <table class="custom-table responsive">
                                                    <thead>
                                                    <tr>
                                                        <th>Kv</th>
                                                        <th>Anbarı</th>
                                                        <th>Aylıq/Günlük</th>
                                                        <th>Qiymət</th>
                                                        <th>Gün/Ay sayı</th>
                                                        <th>Ümumi qiymət</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order->order_kv_stores as $order_store)
                                                        <tr>
                                                            <td>{{$order_store->kv_quantity}} </td>
                                                            <td> {{$order_store->kv_store}}</td>
                                                            <td>{{$order_store->kv_month_day == 'daily_price'? 'Günlük' : 'Aylıq'}} </td>
                                                            <td>{{$order_store->kv_store_price}} </td>
                                                            <td>{{$order_store->kv_day_quantity}} </td>
                                                            <td> {{$order_store->kv_store_total}} </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    @if($order->order_images)
                                        <div class="row">

                                            @foreach($order->order_images as $image)
                                                <div class="col-md-2" >
                                                    <div style="width: 100%; height: 150px; margin: 30px 0">
                                                        <img src="{{ asset('storage/' . $image->image) }}" style="height: 100%; width: 100%; object-fit: cover" alt="">
{{--                                                        <p class="btn btn-danger delete-image-btn" data-image-id="{{ $image->id }}"><i class="fas fa-trash"></i></p>--}}
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    @endif

                                <div class="row">
                                    <div class="col-2">
                                        @if($order->customer_answer)
                                            <p>Müştəri təsdiqləyib</p>
                                        @else
                                            <p>Təsdiqlənməyib</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('includes.footer')
