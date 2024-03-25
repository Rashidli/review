@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('things.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Qiymət əlavə et</h4>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="col-form-label">Başlıq</label>
                                        <input class="form-control" type="text" name="title" value="{{old('title')}}">
                                        @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                    </div>

                                    <table class="repeater">
                                        <thead>
                                            <tr>
                                                <th>Xidmət</th>
                                                <th>Min qiymət</th>
                                                <th>Max qiymət</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($thing_services as $thing_service)
                                            <tr>
                                                <td>
                                                    <div class="mb-3">
                                                        <input type="hidden" name="thing_service_id[]" value="{{$thing_service->id}}">
                                                        <input class="form-control" type="text" disabled value="{{$thing_service->title}}">
                                                        @if($errors->first('thing_service_id')) <small class="form-text text-danger">{{$errors->first('thing_service_id')}}</small> @endif
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
