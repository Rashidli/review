@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('cars.update', $car->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$car->title}}</h4>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Maşın</label>
                                    <input class="form-control" type="text" name="title" value="{{$car->title}}">
                                    @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Fəhlə sayı</label>
                                    <input class="form-control" type="text" name="worker_count" value="{{$car->worker_count}}">
                                    @if($errors->first('worker_count')) <small class="form-text text-danger">{{$errors->first('worker_count')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Fəhlə qiyməti</label>
                                    <input class="form-control" type="text" name="worker_price" value="{{$car->worker_price}}">
                                    @if($errors->first('worker_price')) <small class="form-text text-danger">{{$errors->first('worker_price')}}</small> @endif
                                </div>

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
