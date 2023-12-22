@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('transport_warehouses.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Anbar əlavə et</h4>
                            <div class="row">
                                <div class="col-6">

                                    <div class="mb-3">
                                        <label class="col-form-label">Anbar</label>
                                        <input class="form-control" type="text" name="title" value="{{old('title')}}">
                                        @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                    </div>

                                    <table class="repeater">
                                        <thead>
                                        <tr>
                                            <th>Maşın</th>
                                            <th>Aylıq qiymət</th>
                                            <th>Günlük qiymət</th>
                                        </tr>
                                        </thead>
                                        <tbody data-repeater-list="transports">
                                        @foreach($transports as $transport)

                                            <tr data-repeater-item>
                                                <td>
                                                    <div class="mb-3">
                                                        <input type="hidden" name="transport_id" value="{{$transport->id}}">
                                                        <input class="form-control" type="text" value="{{$transport->title}}" disabled>
                                                        @if($errors->first('car_id')) <small class="form-text text-danger">{{$errors->first('car_id')}}</small> @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="number" name="monthly_price" value="{{old('monthly_price')}}">
                                                        @if($errors->first('monthly_price')) <small class="form-text text-danger">{{$errors->first('monthly_price')}}</small> @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="number" name="daily_price" value="{{old('daily_price')}}">
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
