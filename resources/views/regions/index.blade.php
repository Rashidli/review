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
                                <h4 class="card-title">Zonalar</h4>
                                        <a href="{{route('regions.create')}}" class="btn btn-primary">+</a>
                                <br>
                                <br>

                                <div class="table-responsive">
{{--                                    <table class="table table-bordered mb-0">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th colspan="2">İstiqamətlər</th>--}}
{{--                                            @foreach($cars as $car)--}}
{{--                                                <th colspan="2" style="text-align: center">{{ $car->title }}</th>--}}
{{--                                            @endforeach--}}
{{--                                            <th>Edit</th>--}}
{{--                                        </tr>--}}
{{--                                        <tr>--}}
{{--                                            <th>S/S</th>--}}
{{--                                            <th>Zona</th>--}}
{{--                                            @foreach($cars as $car)--}}
{{--                                                <th style="text-align: center">Min</th>--}}
{{--                                                <th style="text-align: center">Max</th>--}}
{{--                                            @endforeach--}}
{{--                                            <th></th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @foreach($regions as $key => $region)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{ $key + 1 }}</td>--}}
{{--                                                <td>{{ $region->title }}<br><a href="{{route('addresses.index', $region->id)}}">İstiqamətləri</a></td>--}}
{{--                                                @foreach($cars as $car)--}}

{{--                                                        <?php--}}
{{--                                                        $service = $region->region_cars->where('pivot.car_id', $car->id)->first();--}}
{{--                                                        ?>--}}
{{--                                                    @if($service)--}}
{{--                                                        <td style="text-align: center">{{ $service->pivot->min_price }}</td>--}}
{{--                                                        <td style="text-align: center">{{ $service->pivot->max_price }}</td>--}}
{{--                                                    @else--}}
{{--                                                        <td></td>--}}
{{--                                                        <td></td>--}}
{{--                                                    @endif--}}

{{--                                                @endforeach--}}
{{--                                                <td>--}}
{{--                                                    <a href="{{ route('regions.edit', $region->id) }}" title="edit" class="btn btn-primary" style="margin-right: 15px">--}}
{{--                                                        <i class="fas fa-edit"></i>--}}
{{--                                                    </a>--}}
{{--                                                    <form action="{{route('regions.destroy', $region->id)}}" method="post" style="display: inline-block">--}}
{{--                                                        {{ method_field('DELETE') }}--}}
{{--                                                        @csrf--}}
{{--                                                        <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>--}}
{{--                                                    </form>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
                                    <table class="table table-bordered mb-0">
                                        <thead>
                                        <tr>
                                            <th colspan="2">Zonalar</th>
                                            @foreach($regions as $region)
                                                <th colspan="2" style="text-align: center">{{ $region->title }} <br><a href="{{ route('addresses.index', $region->id) }}">İstiqamətləri</a></th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th colspan="2">Əməliyyat</th>
                                            @foreach($regions as $region)
                                                <th colspan="2" style="text-align: center">
                                                    <a href="{{ route('regions.edit', $region->id) }}" title="edit" class="btn btn-primary" style="margin-right: 5px">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('regions.destroy', $region->id) }}" method="post" style="display: inline-block">
                                                        {{ method_field('DELETE') }}
                                                        @csrf
                                                        <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                </th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>S/S</th>
                                            <th>Maşınlar</th>
                                            @foreach($regions as $region)
                                                <th style="text-align: center">Min</th>
                                                <th style="text-align: center">Max</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cars as $key => $car)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $car->title }}</td>
                                                @foreach($regions as $region)
                                                        <?php
                                                        $service = $car->regions->where('id', $region->id)->first();
                                                        ?>
                                                    @if($service)
                                                        <td style="text-align: center">{{ $service->pivot->min_price }}</td>
                                                        <td style="text-align: center">{{ $service->pivot->max_price }}</td>
                                                    @else
                                                        <td></td>
                                                        <td></td>
                                                    @endif
                                                @endforeach

                                            </tr>
                                        @endforeach
                                        </tbody>
{{--                                        <tfoot>--}}
{{--                                        <tr>--}}
{{--                                            <td colspan="{{ count($regions) * 2 + 2 }}"></td>--}}
{{--                                            <td>--}}
{{--                                                --}}
{{--                                                <a href="{{ route('regions.create') }}" class="btn btn-success" title="Add">--}}
{{--                                                    <i class="fas fa-plus"></i> Add--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        </tfoot>--}}
                                    </table>


                                    <br>
                                    {{ $regions->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('includes.footer')
