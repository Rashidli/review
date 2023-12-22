@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <form action="{{route('plan_warehouses.update', $plan_warehouse->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$plan_warehouse->title}}</h4>
                        <div class="row">
                            <div class="col-6">

                                <div class="mb-3">
                                    <label class="col-form-label">Zona</label>
                                    <input class="form-control" type="text" name="title" value="{{$plan_warehouse->title}}">
                                    @if($errors->first('title')) <small class="form-text text-danger">{{$errors->first('title')}}</small> @endif
                                </div>

                                <table class="repeater">
                                    <thead>
                                    <tr>
                                        <th>Tarif</th>
                                        <th>Aylıq qiymət</th>
                                        <th>Günlük qiymət</th>
                                    </tr>
                                    </thead>
                                    <tbody data-repeater-list="plans">
                                    @foreach($plan_warehouse->plans as $item)
                                        <tr data-repeater-item>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="hidden" name="plan_id" value="{{$item->pivot->plan_id}}">
                                                    <input class="form-control" type="text" disabled value="@foreach($plans as $plan){{$item->pivot->plan_id == $plan->id ? $plan->title : ''}}@endforeach">
                                                    @if($errors->first('plan_id')) <small class="form-text text-danger">{{$errors->first('plan_id')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div style="display: flex; align-items: center">
                                                    <div class="mb-3">
                                                        <input class="form-control" type="number" name="monthly_price" value="{{$item->pivot->monthly_price}}">
                                                        @if($errors->first('monthly_price')) <small class="form-text text-danger">{{$errors->first('monthly_price')}}</small> @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="col-form-label" >kvm</label>
                                                        <input type="checkbox" name="monthly_price_per_square_meter" {{$item->pivot->monthly_price_per_square_meter == true ? 'checked' : ''}}>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div style="display: flex; align-items: center">
                                                    <div class="mb-3">
                                                        <input class="form-control" type="number" name="daily_price" value="{{$item->pivot->daily_price}}">
                                                        @if($errors->first('daily_price')) <small class="form-text text-danger">{{$errors->first('daily_price')}}</small> @endif
                                                    </div>
                                                    <div class="mb-3" >
                                                        <label class="col-form-label">kvm</label>
                                                        <input type="checkbox" name="daily_price_per_square_meter" {{$item->pivot->daily_price_per_square_meter == true ? 'checked' : ''}}>
                                                    </div>
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
