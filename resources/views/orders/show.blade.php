
@include('includes.header')

<div class="main-content">
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

                            <div class="custom-table">
                                <table class="table table-bordered mb-0">

                                    <thead>
                                    <tr>
                                        <th>Sifarişçi</th>
                                        <th>Baxış tarixi</th>
                                        <th>Əməkdaşlıq</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>{{$order->customer_name}}</td>
                                            <td>{{$order->review_date}}</td>
                                            <td>{{$order->review_type}}</td>
                                        </tr>


                                    </tbody>
                                </table>
                                <br>
                            </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Nəqliyyat</h4>
                                        <table class="custom-table">
                                            <thead>
                                            <tr>
                                                <th>Maşın</th>
                                                <th>Region</th>
                                                <th>İstiqamət</th>
                                                <th>Qiymət</th>
                                                <th>Reys sayı</th>
                                                <th>Ümumi qiymət</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->order_directions as $order_direction)
                                                <tr>
                                                    <td>{{$order_direction->direction_car}} </td>
                                                    <td> {{$order_direction->direction_type}}</td>
                                                    <td>{{$order_direction->direction}}</td>
                                                    <td> {{$order_direction->direction_price}}</td>
                                                    <td>{{$order_direction->direction_quantity}} </td>
                                                    <td> {{$order_direction->direction_total}} </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Usta xidməti</h4>
                                        <table class="custom-table">
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

                                <div class="row">
                                    <div class="col-12">
                                        <h4>İşçi qüvvəsi</h4>
                                        <table class="custom-table">
                                            <thead>
                                            <tr>
                                                <th>Növbə</th>
                                                <th>Qiymət</th>
                                                <th>Sayı</th>
                                                <th>Ümumi qiymət</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->order_workers as $order_worker)
                                                <tr>
                                                    <td>{{$order_worker->worker}} </td>
                                                    <td> {{$order_worker->worker_price}}</td>
                                                    <td>{{$order_worker->worker_quantity}} </td>
                                                    <td> {{$order_worker->worker_total}} </td>
                                                </tr>
                                            @endforeach
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



@include('includes.footer')
