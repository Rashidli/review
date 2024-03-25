@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('things.update', $thing->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="col-form-label">Başlıq</label>
                                    <input class="form-control" type="text" name="title" value="{{$thing->title}}">
                                    @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                </div>


                                <table>
                                    <thead>
                                        <tr>
                                            <th>Xidmət</th>
                                            <th>Min qiymət</th>
                                            <th>Max qiymət</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($thing->thing_services as $item)
                                            <tr>
                                                <td>
                                                    <div class="mb-3">
                                                        <input type="hidden" name="thing_service_id[]" value="{{$item->pivot->thing_service_id}}">
                                                        <input class="form-control" type="text" disabled   value="@foreach($thing_services as $thing_service){{$item->pivot->thing_service_id == $thing_service->id ? $thing_service->title : ''}}@endforeach">
                                                        @if($errors->first('think_service_id')) <small class="form-text text-danger">{{$errors->first('think_service_id')}}</small> @endif
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
