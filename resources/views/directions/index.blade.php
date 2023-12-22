@include('includes.header')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if(session('message'))
                                    <div class="alert alert-success">{{session('message')}}</div>
                                @endif
                                <h4 class="card-title">İstiqamətlər</h4>
                                        <a href="{{route('directions.create')}}" class="btn btn-primary">+</a>
                                <br>
                                <br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th colspan="2">İstiqamətlər</th>
                                                <th>Məsafə</th>
                                            @foreach($direction_cars as $direction_car)
                                                    <th style="text-align: center">{{ $direction_car->title }}</th>
                                                @endforeach
                                                <th>Edit</th>
                                            </tr>
{{--                                            <tr>--}}
{{--                                                <th>S/S</th>--}}
{{--                                                <th>İstiqamət</th>--}}
{{--                                                @foreach($direction_cars as $direction_car)--}}
{{--                                                    <th style="text-align: center">Min</th>--}}
{{--                                                    <th style="text-align: center">Max</th>--}}
{{--                                                @endforeach--}}
{{--                                                <th></th>--}}
{{--                                            </tr>--}}
                                            </thead>
                                            <tbody>
                                            @foreach($directions as $key => $direction)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $direction->to }}</td>
                                                    <td>{{ $direction->distance }}</td>
                                                    @foreach($direction_cars as $direction_car)

                                                            <?php
                                                            $service = $direction->direction_cars->where('pivot.car_id', $direction_car->id)->first();
                                                            ?>
                                                        @if($service)
{{--                                                            <td style="text-align: center">{{ $service->pivot->min_price }}</td>--}}
                                                            <td style="text-align: center">{{ $service->pivot->max_price }}</td>
                                                        @else
{{--                                                            <td></td>--}}
                                                            <td></td>
                                                        @endif

                                                    @endforeach
                                                    <td>
                                                        <a href="{{ route('directions.edit', $direction->id) }}" title="edit" class="btn btn-primary" style="margin-right: 15px">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{route('directions.destroy', $direction->id)}}" method="post" style="display: inline-block">
                                                            {{ method_field('DELETE') }}
                                                            @csrf
                                                            <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <br>
                                        {{ $directions->links('vendor.pagination.bootstrap-5') }}
                                    </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('includes.footer')
