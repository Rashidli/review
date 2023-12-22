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
                                <h4 class="card-title">Ümumi anbar (maşın ilə)</h4>
                                        <a href="{{route('transport_warehouses.create')}}" class="btn btn-primary">+</a>
                                <br>
                                <br>

                                <div class="table-responsive">

                                    <table class="table table-bordered mb-0">
                                        <thead>
                                        <tr>
                                            <th colspan="2">Anbarlar</th>
                                            @foreach($transport_warehouses as $transport_warehouse)
                                                <th colspan="2" style="text-align: center">{{ $transport_warehouse->title }}</th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th colspan="2">Əməliyyat</th>
                                            @foreach($transport_warehouses as $transport_warehouse)
                                                <th colspan="2" style="text-align: center">
                                                    <a href="{{ route('transport_warehouses.edit', $transport_warehouse->id) }}" title="edit" class="btn btn-primary" style="margin-right: 5px">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('transport_warehouses.destroy', $transport_warehouse->id) }}" method="post" style="display: inline-block">
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
                                            @foreach($transport_warehouses as $transport_warehouse)
                                                <th style="text-align: center">Aylıq</th>
                                                <th style="text-align: center">Günlük</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transports as $key => $transport)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $transport->title }}</td>
                                                @foreach($transport_warehouses as $transport_warehouse)
                                                        <?php
                                                        $service = $transport->warehouses->where('id', $transport_warehouse->id)->first();
                                                        ?>
                                                    @if($service)
                                                        <td style="text-align: center">{{ $service->pivot->monthly_price }}</td>
                                                        <td style="text-align: center">{{ $service->pivot->daily_price }}</td>
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
{{--                                            <td colspan="{{ count($transport_warehouses) * 2 + 2 }}"></td>--}}
{{--                                            <td>--}}
{{--                                                --}}
{{--                                                <a href="{{ route('transport_warehouses.create') }}" class="btn btn-success" title="Add">--}}
{{--                                                    <i class="fas fa-plus"></i> Add--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                        </tfoot>--}}
                                    </table>


                                    <br>
                                    {{ $transport_warehouses->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('includes.footer')
