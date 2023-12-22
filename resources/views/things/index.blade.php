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
                                <h4 class="card-title">Ümumi qiymətləndirmə</h4>
                                        <a href="{{route('things.create')}}" class="btn btn-primary">+</a>
                                <br>
                                <br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th colspan="2">Ümumi qiymətləndirmə</th>
                                                @foreach($thing_services as $thing_service)
                                                    <th colspan="2" style="text-align: center">{{ $thing_service->title }}</th>
                                                @endforeach
                                                <th>Edit</th>
                                            </tr>
                                            <tr>
                                                <th>S/S</th>
                                                <th>Adları</th>
                                                @foreach($thing_services as $thing_service)
                                                    <th style="text-align: center">Min</th>
                                                    <th style="text-align: center">Max</th>
                                                @endforeach
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($things as $key => $thing)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $thing->title }}</td>
                                                    @foreach($thing_services as $thing_service)

                                                            <?php
                                                            $service = $thing->thing_services->where('pivot.thing_service_id', $thing_service->id)->first();
                                                            ?>
                                                        @if($service)
                                                            <td style="text-align: center">{{ $service->pivot->min_price }}</td>
                                                            <td style="text-align: center">{{ $service->pivot->max_price }}</td>
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                        @endif

                                                    @endforeach
                                                    <td>
                                                        <a href="{{ route('things.edit', $thing->id) }}" title="edit" class="btn btn-primary" style="margin-right: 15px">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{route('things.destroy', $thing->id)}}" method="post" style="display: inline-block">
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
                                        {{ $things->links('vendor.pagination.bootstrap-5') }}
                                    </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('includes.footer')
