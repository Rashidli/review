@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('directions.update', $direction->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">İstiqamət</label>
                                    <input class="form-control" type="text" name="title" value="{{$direction->title}}">
                                    @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Məsafə</label>
                                    <input class="form-control" type="number" name="distance" value="{{$direction->distance}}">
                                    @if($errors->first('distance')) <small class="form-text text-danger">{{$errors->first('distance')}}</small> @endif
                                </div>


                                <table >
                                    <thead>
                                        <tr>
                                            <th>Tarif</th>
                                            <th>Qiymət</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($direction->direction_cars as $item)
                                            <tr>
                                                <td>
                                                    <div class="mb-3">
                                                        <input type="hidden" name="car_id[]" value="{{$item->pivot->car_id}}">
                                                        <input class="form-control" type="text" disabled value="@foreach($direction_cars as $direction_car){{$item->pivot->car_id == $direction_car->id ? $direction_car->title : ''}}@endforeach">
                                                        @if($errors->first('car_id')) <small class="form-text text-danger">{{$errors->first('car_id')}}</small> @endif
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="text" name="max_price[]" value="{{$item->pivot->max_price}}">
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
