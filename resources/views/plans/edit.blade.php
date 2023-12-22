@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('plans.update', $plan->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$plan->title}}</h4>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq</label>
                                    <input class="form-control" type="text" name="title" value="{{$plan->title}}">
                                    @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">From</label>
                                    <input class="form-control" type="number" name="from" value="{{$plan->from}}">
                                    @if($errors->first('from')) <small class="form-text text-danger">{{$errors->first('from')}}</small> @endif
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">To</label>
                                    <input class="form-control" type="number" name="to" value="{{$plan->to}}">
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
