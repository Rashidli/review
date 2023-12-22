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
{{--                                                <th>Sil</th>--}}
                                            </tr>
                                        </thead>
                                        <tbody data-repeater-list="thing_services">
                                        @foreach($thing_services as $thing_service)
                                            <tr data-repeater-item>
                                                <td>
{{--                                                    <div class="mb-3">--}}
{{--                                                        <select name="thing_service_id" class="form-control">--}}
{{--                                                            <option disabled selected>----</option>--}}
{{--                                                            @foreach($thing_services as $thing_service)--}}
{{--                                                                <option value="{{$thing_service->id}}">{{$thing_service->title}}</option>--}}
{{--                                                            @endforeach--}}
{{--                                                        </select>--}}
{{--                                                        @if($errors->first('thing_service_id')) <small class="form-text text-danger">{{$errors->first('thing_service_id')}}</small> @endif--}}
{{--                                                    </div>--}}
                                                    <div class="mb-3">
                                                        <input type="hidden" name="thing_service_id" value="{{$thing_service->id}}">
                                                        <input class="form-control" type="text" disabled value="{{$thing_service->title}}">
                                                        @if($errors->first('thing_service_id')) <small class="form-text text-danger">{{$errors->first('thing_service_id')}}</small> @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="number" name="min_price" value="{{old('min_price')}}">
                                                        @if($errors->first('min_price')) <small class="form-text text-danger">{{$errors->first('min_price')}}</small> @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-3">
                                                        <input class="form-control" type="number" name="max_price" value="{{old('max_price')}}">
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
{{--                                        <tfoot>--}}
{{--                                            <tr>--}}
{{--                                                <td><button data-repeater-create class="btn btn-success" type="button" >+</button></td>--}}
{{--                                            </tr>--}}
{{--                                        </tfoot>--}}
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
