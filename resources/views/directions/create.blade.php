@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('directions.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">İstiqamət əlavə et</h4>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="col-form-label">İstiqamət</label>
                                        <input class="form-control" type="text" name="to" value="{{old('to')}}">
                                        @if($errors->first('to')) <small class="form-text text-danger">{{$errors->first('to')}}</small> @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Məsafə</label>
                                        <input class="form-control" type="number" name="distance" value="{{old('distance')}}">
                                        @if($errors->first('distance')) <small class="form-text text-danger">{{$errors->first('distance')}}</small> @endif
                                    </div>

                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Maşın</th>
                                                <th>Qiymət</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($direction_cars as $direction_car)


                                            <tr>
                                                <td>
                                                    <div class="mb-3">
                                                        <input type="hidden" name="car_id[]" value="{{$direction_car->id}}">
                                                        <input class="form-control" type="text" value="{{$direction_car->title}}" disabled>
                                                        @if($errors->first('car_id')) <small class="form-text text-danger">{{$errors->first('car_id')}}</small> @endif
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="number" name="max_price[]" value="{{old('max_price')}}">
                                                        @if($errors->first('max_price')) <small class="form-text text-danger">{{$errors->first('max_price')}}</small> @endif
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>



                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Yadda saxla</button>
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
