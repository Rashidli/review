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
                                <h4 class="card-title">Maşınlar</h4>
                                        <a href="{{route('cars.create')}}" class="btn btn-primary">+</a>
                                <br>
                                <br>

                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">

                                        <thead>
                                        <tr>
                                            <th>№</th>
                                            <th>Maşın</th>
                                            <th>Fəhlə sayı</th>
                                            <th>Fəhlə qiyməti</th>
                                            <th>Əməliyyat</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cars as $key => $car)

                                            <tr>
                                                <th scope="row">{{$key + 1}}</th>
                                                <td>{{$car->title}}</td>
                                                <td>{{$car->worker_count}}</td>
                                                <td>{{$car->worker_price}}</td>
                                                <td>
                                                    <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary" style="margin-right: 15px">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('cars.destroy', $car->id) }}" method="post" style="display: inline-block">
                                                        {{ method_field('DELETE') }}
                                                        @csrf
                                                        <button onclick="return confirm('Məlumatın silinməyin təsdiqləyin')" type="submit" class="btn btn-danger">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>

                                        @endforeach

                                        </tbody>
                                    </table>
                                    <br>
                                    {{ $cars->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



@include('includes.footer')
