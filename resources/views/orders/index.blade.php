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
                                <h4 class="card-title">Sifarişlər</h4>
                                    <a href="{{route('orders.create')}}" class="btn btn-primary">+</a>
{{--                                    <a href="{{route('export')}}" class="btn btn-primary">Export</a>--}}
                                <br>
                                <br>

                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">

                                        <thead>
                                            <tr>
                                                <th>№</th>
                                                <th>Sifarişçi</th>
                                                <th>Baxış tarixi</th>
                                                <th>Əməkdaşlıq</th>
                                                <th>Ümumi məbləğ</th>
                                                <th>Siyahı t</th>
                                                <th>Qiymət t</th>
                                                <th>Status</th>
                                                <th>Göndər</th>
                                                <th>Əməliyyat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $key => $order)

                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$order->customer_name}}</td>
                                                <td>{{$order->review_date}}</td>
                                                <td>{{$order->review_type}}</td>
                                                <td>
                                                    {{ ($order->order_directions->sum('direction_total')) +
                                                       ($order->order_masters->sum('thing_total')) +
                                                       (($order->order_workers->sum('worker_total')) +
                                                       (($order->order_stores->sum('store_total')) +
                                                       ($order->order_kv_stores->sum('kv_store_total'))))
                                                    }}

                                                </td>
                                                <td>{{$order->customer_answer ? 'Bəli' : 'Xeyr'}}</td>
                                                <td>{{$order->customer_full_answer ? 'Bəli' : 'Xeyr'}}</td>
                                                <td>{{\App\Enum\Status::getStatusLabel($order->status)}}</td>
                                                <td>
                                                    <a class="btn-primary btn" href="https://wa.me/{{$order->phone}}?text={{route('get_order', $order->id)}}" target="_blank">
                                                        Siyahı
                                                    </a>
                                                    <a class="btn-primary btn" href="https://wa.me/{{$order->phone}}?text={{route('full_list', $order->id)}}" target="_blank">
                                                        Tam
                                                    </a>
                                                    <a class="btn-primary btn" href="https://wa.me/{{$order->operator_phone}}?text={{route('operator_sifaris', $order->id)}}" target="_blank">
                                                        Operatora
                                                    </a>
                                                    @if($order->email)
                                                        <a class="btn-primary btn" href="{{route('sendMail',$order->id)}}">email</a>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info" style="margin-right: 15px">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary" style="margin-right: 15px">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('orders.destroy', $order->id) }}" method="post" style="display: inline-block">
                                                        {{ method_field('DELETE') }}
                                                        @csrf
                                                        <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                    <br>
                                    {{ $orders->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('includes.footer')
