
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
                                        <th>Ümumi məbləğ</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>{{$order->customer_name}}</td>
                                            <td>{{$order->review_date}}</td>
                                            <td>{{$order->review_type}}</td>
                                            <td>{{($order->order_directions->sum('direction_total')) + ($order->order_masters->sum('thing_total')) + ($order->order_workers->sum('worker_total'))}}</td>
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
                                                    <img src="{{ asset('storage/' . $image->image) }}" style="height: 100%; width: 100%; object-fit: contain" alt="">
                                                    {{--                                                        <p class="btn btn-danger delete-image-btn" data-image-id="{{ $image->id }}"><i class="fas fa-trash"></i></p>--}}
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                @endif
                            <div class="row">


                                <div class="col-2">
                                    <form action="{{route('change_status', $order->id)}}" method="post">
                                        {{ method_field('PUT') }}
                                        @csrf
                                        <div class="mb-3">
                                            <label class="col-form-label">Status</label>
                                            <select  name="status" class="form-control car_list">
{{--                                                <option selected value></option>--}}
                                                    <option value="{{\App\Enum\Status::review}}" {{\App\Enum\Status::review == $order->status ? 'selected' : ''}}>{{\App\Enum\Status::getStatusLabel(1)}}</option>
                                                    <option value="{{\App\Enum\Status::planning}}" {{\App\Enum\Status::planning == $order->status ? 'selected' : ''}}>{{\App\Enum\Status::getStatusLabel(2)}}</option>
                                                    <option value="{{\App\Enum\Status::cancel}}" {{\App\Enum\Status::cancel == $order->status ? 'selected' : ''}}>{{\App\Enum\Status::getStatusLabel(3)}}</option>
                                            </select>
                                        </div>
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="col-form-label">Rəy</label>--}}
{{--                                            <textarea class="form-control direction_price" name="comment"></textarea>--}}
{{--                                        </div>--}}
                                        <div class="mb-3">
                                            <button class="btn btn-primary">Yadda saxla</button>
                                        </div>
                                    </form>
                                </div>
{{--                                <div class="col-2">--}}
{{--                                    <p>Rəy: {{$order->comment == null ? 'Rəy yoxdur' : $order->comment}}</p>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



@include('includes.footer')
