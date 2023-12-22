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
                                    <input class="form-control" type="text" name="to" value="{{$direction->to}}">
                                    @if($errors->first('to')) <small class="form-text text-danger">{{$errors->first('to')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Məsafə</label>
                                    <input class="form-control" type="number" name="distance" value="{{$direction->distance}}">
                                    @if($errors->first('distance')) <small class="form-text text-danger">{{$errors->first('distance')}}</small> @endif
                                </div>


                                <table class="repeater">
                                    <thead>
                                        <tr>
                                            <th>Tarif</th>
{{--                                            <th>Min qiymət</th>--}}
                                            <th>Qiymət</th>
{{--                                            <th>Sil</th>--}}
                                        </tr>
                                    </thead>
                                    <tbody data-repeater-list="direction_cars">
                                        @foreach($direction->direction_cars as $item)
                                            <tr data-repeater-item>
                                                <td>
{{--                                                    <div class="mb-3">--}}
{{--                                                        <select name="direction_car_id" class="form-control">--}}
{{--                                                            <option disabled selected>----</option>--}}
{{--                                                            @foreach($direction_cars as $direction_car)--}}
{{--                                                                <option value="{{$direction_car->id}}" {{$item->pivot->direction_car_id == $direction_car->id ? 'selected' : ''}}>{{$direction_car->title}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
{{--                                                        @if($errors->first('direction_car_id')) <small class="form-text text-danger">{{$errors->first('direction_car_id')}}</small> @endif--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <input type="hidden" name="car_id" value="{{$item->pivot->car_id}}">
                                                        <input class="form-control" type="text" disabled value="@foreach($direction_cars as $direction_car){{$item->pivot->car_id == $direction_car->id ? $direction_car->title : ''}}@endforeach">
                                                        @if($errors->first('car_id')) <small class="form-text text-danger">{{$errors->first('car_id')}}</small> @endif
                                                    </div>
                                                </td>
{{--                                                <td>--}}
{{--                                                    <div class="mb-3">--}}
{{--                                                        <input class="form-control" type="text" name="min_price" value="{{$item->pivot->min_price}}">--}}
{{--                                                        @if($errors->first('min_price')) <small class="form-text text-danger">{{$errors->first('min_price')}}</small> @endif--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
                                                <td>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="text" name="max_price" value="{{$item->pivot->max_price}}">
                                                        @if($errors->first('max_price')) <small class="form-text text-danger">{{$errors->first('max_price')}}</small> @endif
                                                    </div>
                                                </td>
{{--                                                <td>--}}
{{--                                                    <button data-repeater-delete class="btn btn-danger"  type="button">--}}
{{--                                                        <i class="fas fa-trash-alt"></i>--}}
{{--                                                    </button>--}}
{{--                                                    <br>--}}
{{--                                                    <br>--}}
{{--                                                </td>--}}
                                            </tr>
                                        @endforeach
                                    </tbody>
{{--                                    <tfoot>--}}
{{--                                        <tr>--}}
{{--                                            <td><button data-repeater-create class="btn btn-success" type="button" >+</button></td>--}}
{{--                                        </tr>--}}
{{--                                    </tfoot>--}}
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
