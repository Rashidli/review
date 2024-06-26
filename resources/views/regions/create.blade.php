@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('regions.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Zona əlavə et</h4>
                            <div class="row">
                                <div class="col-6">

                                    <div class="mb-3">
                                        <label class="col-form-label">Zona</label>
                                        <input class="form-control" type="text" name="title" value="{{old('title')}}">
                                        @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                    </div>

                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Maşın</th>
                                            <th>Min qiymət</th>
                                            <th>Qiymət</th>
                                        </tr>
                                        </thead>
                                        <tbody >
                                        @foreach($cars as $car)

                                            <tr >
                                                <td>
                                                    <div class="mb-3">
                                                        <input type="hidden" name="car_id[]" value="{{$car->id}}">
                                                        <input class="form-control" type="text" value="{{$car->title}}" disabled>
                                                        @if($errors->first('car_id')) <small class="form-text text-danger">{{$errors->first('car_id')}}</small> @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="number" name="min_price[]" value="{{old('min_price')}}">
                                                        @if($errors->first('min_price')) <small class="form-text text-danger">{{$errors->first('min_price')}}</small> @endif
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
