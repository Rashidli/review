@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('plans.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tarif əlavə et</h4>
                            <div class="row">
                                <div class="col-6">

                                    <div class="mb-3">
                                        <label class="col-form-label">Başlıq</label>
                                        <input class="form-control" type="text" name="title" value="{{old('title')}}">
                                        @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">From</label>
                                        <input class="form-control" type="number" name="from" value="{{old('from')}}">
                                        @if($errors->first('from')) <small class="form-text text-danger">{{$errors->first('from')}}</small> @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="col-form-label">To</label>
                                        <input class="form-control" type="number" name="to" value="{{old('to')}}">
                                        @if($errors->first('to')) <small class="form-text text-danger">{{$errors->first('to')}}</small> @endif
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
