@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('regions.update', $region->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$region->title}}</h4>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Zona</label>
                                    <input class="form-control" type="text" name="title" value="{{$region->title}}">
                                    @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                </div>

                                <table class="repeater">
                                    <thead>
                                    <tr>
                                        <th>Tarif</th>
                                        <th>Min qiymət</th>
                                        <th>Qiymət</th>
                                        {{--                                            <th>Sil</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody data-repeater-list="region_cars">
                                    @foreach($region->region_cars as $item)
                                        <tr data-repeater-item>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="hidden" name="car_id[]" value="{{$item->pivot->car_id}}">
                                                    <input class="form-control" type="text" disabled value="@foreach($cars as $car){{$item->pivot->car_id == $car->id ? $car->title : ''}}@endforeach">
                                                    @if($errors->first('car_id')) <small class="form-text text-danger">{{$errors->first('car_id')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input class="form-control" type="number" name="min_price[]" value="{{$item->pivot->min_price}}">
                                                    @if($errors->first('min_price')) <small class="form-text text-danger">{{$errors->first('min_price')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input class="form-control" type="number" name="max_price[]" value="{{$item->pivot->max_price}}">
                                                    @if($errors->first('max_price')) <small class="form-text text-danger">{{$errors->first('max_price')}}</small> @endif
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
