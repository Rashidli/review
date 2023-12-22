@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('workers.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">İşçi qüvvəsi əlavə et</h4>
                            <div class="row">
                                <div class="col-6">

                                    <div class="mb-3">
                                        <label class="col-form-label">Növbə</label>
                                        <input class="form-control" type="text" name="shift" value="{{old('shift')}}">
                                        @if($errors->first('shift')) <small class="form-text text-danger">{{$errors->first('shift')}}</small> @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Növbə saatları</label>
                                        <input class="form-control" type="text" name="hours" value="{{old('hours')}}">
                                        @if($errors->first('hours')) <small class="form-text text-danger">{{$errors->first('hours')}}</small> @endif
                                    </div>

                                    <div class="mb-3">
                                        <label class="col-form-label">Qiymət</label>
                                        <input class="form-control" type="number" name="price" value="{{old('prices')}}">
                                        @if($errors->first('price')) <small class="form-text text-danger">{{$errors->first('price')}}</small> @endif
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
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor_az' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor_en' ) )
        .catch( error => {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#editor_ru' ) )
        .catch( error => {
            console.error( error );
        } );

</script>
