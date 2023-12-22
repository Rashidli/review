@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('transport_warehouses.update', $transport_warehouse->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$transport_warehouse->title}}</h4>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Zona</label>
                                    <input class="form-control" type="text" name="title" value="{{$transport_warehouse->title}}">
                                    @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                </div>

                                <table class="repeater">
                                    <thead>
                                    <tr>
                                        <th>Tarif</th>
                                        <th>Aylıq qiymət</th>
                                        <th>Günlük qiymət</th>
                                    </tr>
                                    </thead>
                                    <tbody data-repeater-list="transports">
                                    @foreach($transport_warehouse->transports as $item)
                                        <tr data-repeater-item>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="hidden" name="transport_id" value="{{$item->pivot->transport_id}}">
                                                    <input class="form-control" type="text" disabled value="@foreach($transports as $transport){{$item->pivot->transport_id == $transport->id ? $transport->title : ''}}@endforeach">
                                                    @if($errors->first('transport_id')) <small class="form-text text-danger">{{$errors->first('transport_id')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input class="form-control" type="number" name="monthly_price" value="{{$item->pivot->monthly_price}}">
                                                    @if($errors->first('monthly_price')) <small class="form-text text-danger">{{$errors->first('monthly_price')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input class="form-control" type="number" name="daily_price" value="{{$item->pivot->daily_price}}">
                                                    @if($errors->first('daily_price')) <small class="form-text text-danger">{{$errors->first('daily_price')}}</small> @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="mb-3">
                                    <button class="btn btn-primary">Yadda saxla</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@include('includes.footer')
<script src="{{asset('assets/js/repeater.js')}}"></script>
