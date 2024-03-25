

@include('includes.header')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="{{route('orders.update' , $order->id)}}" method="post" enctype="multipart/form-data">
                {{ method_field('PUT') }}
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">

                                <div class="mb-3">
                                    <label class="col-form-label">Sifarişçi</label>
                                    <input class="form-control" type="text" name="customer_name" value="{{$order->customer_name}}">
                                    @if($errors->first('customer_name')) <small class="form-text text-danger">{{$errors->first('customer_name')}}</small> @endif
                                </div>

                            </div>
                            <div class="col-3">

                                <div class="mb-3">
                                    <label class="col-form-label">Baxış tarix</label>
                                    <input class="form-control" type="date" name="review_date" value="{{$order->review_date}}">
                                    @if($errors->first('review_date')) <small class="form-text text-danger">{{$errors->first('review_date')}}</small> @endif
                                </div>

                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Əməkdaşlıq</label>
                                    <select required  name="review_type" class="form-control">
                                        <option selected disabled>----</option>
                                        <option value="Fərdi" {{$order->review_type == "Fərdi" ? 'selected' : ''}}>Fərdi</option>
                                        <option value="Korporativ" {{$order->review_type == "Korporativ" ? 'selected' : ''}}>Korporativ</option>
                                    </select>
                                    @if($errors->first('review_type')) <small class="form-text text-danger">{{$errors->first('review_type')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Telefon</label>
                                    <input x-model="phone" x-on:change="applyMask()" class="form-control" value="{{$order->phone}}" type="text" required name="phone">
                                    @if($errors->first('phone')) <small class="form-text text-danger">{{$errors->first('phone')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="col-form-label">Operator</label>
                                    <input x-model="operator_phone" x-on:change="applyMask()" class="form-control" value="{{$order->operator_phone}}" type="text" required name="operator_phone">
                                    @if($errors->first('operator_phone')) <small class="form-text text-danger">{{$errors->first('operator_phone')}}</small> @endif
                                </div>
                            </div>

                            <div class="col-3">

                                <div class="mb-3">
                                    <label class="col-form-label">Email( korp üçün)</label>
                                    <input class="form-control" type="email"   name="email" value="{{$order->email}}">
                                    @if($errors->first('email')) <small class="form-text text-danger">{{$errors->first('email')}}</small> @endif
                                </div>

                            </div>



                        </div>
                        <div class="row" x-data="products()">
                            <div class="col-12">
                                <h4>Məhsullar</h4>
                                <table class="repeater custom-table">
                                    <thead>
                                    <tr>
                                        <th>Məhsul</th>
                                        <th>Sayı</th>
                                        <th>Sil</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template x-for="(field, index) in fields" :key="index">
                                        <tr>
                                            <td>
                                                <div class="mb-3">
                                                    <select x-model="field.product" name="product[]" class="form-control">
                                                        <option >----</option>
                                                        @foreach($things as $product)
                                                            <option value="{{$product->title}}" >{{$product->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('product')) <small class="form-text text-danger">{{$errors->first('product')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input required type="number" class="form-control" x-model="field.product_quantity" name="product_quantity[]" value="">
                                                    @if($errors->first('product_quantity')) <small class="form-text text-danger">{{$errors->first('product_quantity')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <button @click="removeField(index)" class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <br>
                                                <br>
                                            </td>
                                        </tr>
                                    </template>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td><button @click="addNewField()" class="btn btn-success" type="button">+</button></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="row" x-data="direction()" x-init="initDirectionList">
                            <div class="col-12">
                                <h4>Nəqliyyat</h4>
                                <table class="custom-table">
                                    <thead>
                                    <tr>
                                        <th>Maşın</th>
                                        <th>Region</th>
                                        <th>İstiqamət</th>
                                        <th>Qiymət</th>
                                        <th>Reys sayı</th>
                                        <th>Fəhlə sayı</th>
                                        <th>Fəhlə qiyməti</th>
                                        <th>Ümumi qiymət</th>
                                        <th>Sil</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template x-for="(field, index) in fields" :key="index">
                                        <tr>
                                            <td>
                                                <div class="mb-3">
                                                    <select id="car" x-model="field.direction_car"  @change="updatePrice(field)" name="direction_car[]" class="form-control car_list">
                                                        <option >----</option>
                                                        @foreach($direction_cars as $car)
                                                            <option value="{{$car->title}}" data-car_id="{{$car->id}}" data-worker_count="{{$car->worker_count}}" data-worker_price="{{$car->worker_price}}">{{$car->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('direction_car')) <small class="form-text text-danger">{{$errors->first('direction_car')}}</small> @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="mb-3">
                                                    <select id="direction_type" x-model="field.direction_type" @change="updateDirection(field)" name="direction_type[]" class="form-control direction_type">
                                                        <option >----</option>
                                                        <option value="Bakı - Abşeron" data-direction_type="{{\App\Enum\Zone::baku_internal->value}}">Bakı - Abşeron</option>
                                                        <option value="Bakı - Region" data-direction_type="{{\App\Enum\Zone::baku_region->value}}">Bakı - Region</option>
                                                        <option value="Region - Region" data-direction_type="{{\App\Enum\Zone::region_region->value}}">Region - Region</option>
                                                    </select>
                                                    @if($errors->first('direction_type')) <small class="form-text text-danger">{{$errors->first('direction_type')}}</small> @endif
                                                </div>
                                            </td>

                                            <td :style="field.direction_type !== 'Region - Region' ? '' : 'display: none;'">

                                                <div class="mb-3">

                                                    <select id="direction_${field.id}" x-model="field.direction" name="direction[]" @change="updatePrice(field)" class="form-control direction_list">
                                                        <option value="" selected>Select Direction</option>
                                                        <template x-for="direction in field.direction_list">
                                                            <option x-text="direction.title" :value="direction.title" :data-direction_id="direction.id" x-bind:selected="field.direction === direction.title"></option>
                                                        </template>
                                                    </select>


                                                @if($errors->first('direction')) <small class="form-text text-danger">{{$errors->first('direction')}}</small> @endif


                                                </div>
                                            </td>

                                            <td :style="field.direction_type == 'Region - Region' ? '' : 'display: none;'">
                                                <div class="mb-3">
                                                    <input type="text" x-model="field.from" name="from[]" class="form-control" placeholder="Haradan">
                                                </div>
                                                <div class="mb-3">
                                                    <input type="text" x-model="field.to" name="to[]" class="form-control" placeholder="haraya">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" @keyup="calcCommon(field)" x-model="field.direction_price" name="direction_price[]" class="form-control direction_price" value="">
                                                    <div class="error-message" style="color: red"></div>
                                                    @if($errors->first('direction_price')) <small class="form-text text-danger">{{$errors->first('direction_price')}}</small> @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" @keyup="calcCommon(field)" class="form-control direction_quantity" x-model="field.direction_quantity" name="direction_quantity[]" value="">
                                                    @if($errors->first('direction_quantity')) <small class="form-text text-danger">{{$errors->first('direction_quantity')}}</small> @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" @keyup="calcCommon(field)" class="form-control" x-model="field.direction_worker_total" name="direction_worker_total[]" value="">
                                                    @if($errors->first('direction_worker_total')) <small class="form-text text-danger">{{$errors->first('direction_worker_total')}}</small> @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" @keyup="calcCommon(field)" class="form-control" x-model="field.direction_worker_price" name="direction_worker_price[]" value="">
                                                    @if($errors->first('direction_worker_price')) <small class="form-text text-danger">{{$errors->first('direction_worker_price')}}</small> @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control direction_total" x-model="field.direction_total" name="direction_total[]" value="" readonly>
                                                    @if($errors->first('direction_total')) <small class="form-text text-danger">{{$errors->first('direction_total')}}</small> @endif
                                                </div>
                                            </td>

                                            <td>
                                                <button @click="removeField(index)" class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <br>
                                                <br>
                                            </td>

                                        </tr>
                                    </template>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td><button class="btn btn-success" @click="addNewField()" type="button">+</button></td>

                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="row" x-data="master()">
                            <div class="col-12">
                                <h4>Usta xidməti</h4>
                                <table class="custom-table">
                                    <thead>
                                    <tr>
                                        <th>Əşya</th>
                                        <th>Xidmət</th>
                                        <th>Qiymət</th>
                                        <th>Sayı</th>
                                        <th>Ümumi qiymət</th>
                                        <th>Sil</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template x-for="(field, index) in fields" :key="index">
                                        <tr>
                                            <td>
                                                <div class="mb-3">
                                                    <select x-model="field.thing" @change="updateThing(field)" name="thing[]" class="form-control thing_list">
                                                        <option >----</option>
                                                        @foreach($things as $thing)
                                                            <option value="{{$thing->title}}" data-thing_id="{{$thing->id}}">{{$thing->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('thing')) <small class="form-text text-danger">{{$errors->first('thing')}}</small> @endif
                                                </div>

                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <select  x-model="field.thing_service" @change="updateThing(field)" name="thing_service[]" class="form-control thing_service_list">
                                                        <option>----</option>
                                                        @foreach($thing_services as $thing_service)
                                                            <option value="{{$thing_service->title}}" data-thing_service_id="{{$thing_service->id}}">{{$thing_service->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('thing_service')) <small class="form-text text-danger">{{$errors->first('thing_service')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control thing_price" x-model="field.thing_price" @keyup="calcCommon(field)" name="thing_price[]"  value="">
                                                    <div class="error-message" style="color: red"></div>
                                                    @if($errors->first('thing_price')) <small class="form-text text-danger">{{$errors->first('thing_price')}}</small> @endif
                                                </div>
                                            </td>

                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control thing_quantity" @keyup="calcCommon(field)"  x-model="field.thing_quantity" name="thing_quantity[]" value="">
                                                    @if($errors->first('thing_quantity')) <small class="form-text text-danger">{{$errors->first('thing_quantity')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control thing_total"  x-model="field.thing_total" name="thing_total[]" readonly value="">
                                                    @if($errors->first('thing_total')) <small class="form-text text-danger">{{$errors->first('thing_total')}}</small> @endif
                                                </div>
                                            </td>
                                            <td >
                                                <button @click="removeField(index)" class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <br>
                                                <br>
                                            </td>
                                        </tr>
                                    </template>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td><button class="btn btn-success" @click="addNewField()" type="button">+</button></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="row" x-data="worker()">
                            <div class="col-12">
                                <h4>Fəhlə icarə</h4>
                                <table class="repeater custom-table">
                                    <thead>
                                    <tr>
                                        <th>Növbə</th>
                                        <th>Qiymət</th>
                                        <th>Sayı</th>
                                        <th>Gün</th>
                                        <th>Ümumi qiymət</th>
                                        <th>Sil</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="(field, index) in fields" :key="index">
                                            <tr>
                                                <td>
                                                    <div class="mb-3">
                                                        <select @change="updateWorker(field)" x-model="field.worker" name="worker[]" class="form-control worker_list">
                                                            <option >----</option>
                                                            @foreach($workers as $worker)
                                                                <option value="{{$worker->shift}}" data-worker_price="{{$worker->price}}">{{$worker->shift}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->first('worker')) <small class="form-text text-danger">{{$errors->first('worker')}}</small> @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-3">
                                                        <input type="number" class="form-control worker_price" x-model="field.worker_price" @input="calcCommon(field)" name="worker_price[]" value="">
                                                        <div class="error-message" style="color: red"></div>
                                                        @if($errors->first('worker_price')) <small class="form-text text-danger">{{$errors->first('worker_price')}}</small> @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-3">
                                                        <input type="number" class="form-control worker_quantity" x-model="field.worker_quantity" @input="calcCommon(field)" name="worker_quantity[]" value="">
                                                        @if($errors->first('worker_quantity')) <small class="form-text text-danger">{{$errors->first('worker_quantity')}}</small> @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-3">
                                                        <input type="number" class="form-control worker_day" x-model="field.worker_day" @input="calcCommon(field)" name="worker_day[]" value="">
                                                        @if($errors->first('worker_day')) <small class="form-text text-danger">{{$errors->first('worker_day')}}</small> @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="mb-3">
                                                        <input type="number" class="form-control worker_total" x-model="field.worker_total" name="worker_total[]" value="" readonly>
                                                        @if($errors->first('worker_total')) <small class="form-text text-danger">{{$errors->first('worker_total')}}</small> @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <button @click="removeField(index)" class="btn btn-danger" type="button">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><button @click="addNewField()" class="btn btn-success" type="button">+</button></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row" x-data="store()">
                            <div class="col-12">
                                <h4>Anbar (maşın ilə)</h4>
                                <table class=" custom-table">
                                    <thead>
                                    <tr>
                                        <th>Maşını seç</th>
                                        <th>Anbarı seç</th>
                                        <th>Aylıq/Günlük</th>
                                        <th>Qiymət</th>
                                        <th>Gün/Ay sayı</th>
                                        <th>Ümumi qiymət</th>
                                        <th>Sil</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template x-for="(field, index) in fields" :key="index">
                                        <tr>
                                            <td>
                                                <div class="mb-3">
                                                    <select x-model="field.transport" @change="updatePrice(field)" name="transport[]" class="form-control transports">
                                                        <option >----</option>
                                                        @foreach($transports as $transport)
                                                            <option value="{{$transport->title}}" data-transport_id="{{$transport->id}}" >{{$transport->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('transport')) <small class="form-text text-danger">{{$errors->first('transport')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <select x-model="field.store" @change="updatePrice(field)" name="store[]" class="form-control stores">
                                                        <option >----</option>
                                                        @foreach($stores as $store)
                                                            <option value="{{$store->title}}" data-store_id="{{$store->id}}" >{{$store->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('store')) <small class="form-text text-danger">{{$errors->first('store')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <select x-model="field.month_day" @change="updatePrice(field)" name="month_day[]" class="form-control month_day">
                                                        <option >----</option>
                                                        <option value="daily_price">Günlük</option>
                                                        <option value="monthly_price" >Aylıq</option>
                                                    </select>
                                                    @if($errors->first('store')) <small class="form-text text-danger">{{$errors->first('store')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input required type="number" class="form-control store_price" x-model="field.store_price" @input="calcCommon(field)" name="store_price[]" value="">
                                                    <div class="error-message" style="color: red"></div>
                                                    @if($errors->first('store_price')) <small class="form-text text-danger">{{$errors->first('store_price')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input required type="number" class="form-control day_quantity" x-model="field.day_quantity" @input="calcCommon(field)" name="day_quantity[]" value="">
                                                    @if($errors->first('day_quantity')) <small class="form-text text-danger">{{$errors->first('day_quantity')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input required type="number" class="form-control store_total" x-model="field.store_total" name="store_total[]" value="" readonly>
                                                    @if($errors->first('store_total')) <small class="form-text text-danger">{{$errors->first('store_total')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <button @click="removeField(index)" class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <br>
                                                <br>
                                            </td>
                                        </tr>
                                    </template>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td><button @click="addNewField()" class="btn btn-success" type="button">+</button></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row" x-data="stores()">
                            <div class="col-12">
                                <h4>Anbar (kv ilə)</h4>
                                <table class=" custom-table">
                                    <thead>
                                    <tr>
                                        <th>Kv</th>
                                        <th>Anbarı seç</th>
                                        <th>Aylıq/Günlük</th>
                                        <th>Qiymət</th>
                                        <th>Gün/Ay sayı</th>
                                        <th>Ümumi qiymət</th>
                                        <th>Sil</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template x-for="(field, index) in fields" :key="index">
                                        <tr>
                                            <td>
                                                <div class="mb-3">
                                                    <input required type="number" class="form-control kv_quantity" x-model="field.kv_quantity" @input="updatePrice(field)" name="kv_quantity[]" value="">
                                                    @if($errors->first('kv_quantity')) <small class="form-text text-danger">{{$errors->first('kv_quantity')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <select x-model="field.kv_store" @change="updatePrice(field)" name="kv_store[]" class="form-control kv_stores">
                                                        <option >----</option>
                                                        @foreach($kv_stores as $kv_store)
                                                            <option value="{{$kv_store->title}}" data-kv_store_id="{{$kv_store->id}}" >{{$kv_store->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('kv_store')) <small class="form-text text-danger">{{$errors->first('kv_store')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <select x-model="field.kv_month_day" @change="updatePrice(field)" name="kv_month_day[]" class="form-control kv_month_day">
                                                        <option >----</option>
                                                        <option value="daily_price">Günlük</option>
                                                        <option value="monthly_price" >Aylıq</option>
                                                    </select>
                                                    @if($errors->first('kv_month_day')) <small class="form-text text-danger">{{$errors->first('kv_month_day')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input required type="number" class="form-control kv_store_price" x-model="field.kv_store_price" @input="calcCommon(field)" name="kv_store_price[]" value="">
                                                    <div class="error-message" style="color: red"></div>
                                                    @if($errors->first('kv_store_price')) <small class="form-text text-danger">{{$errors->first('kv_store_price')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input required type="number" class="form-control kv_day_quantity" x-model="field.kv_day_quantity" @input="calcCommon(field)" name="kv_day_quantity[]" value="">
                                                    @if($errors->first('kv_day_quantity')) <small class="form-text text-danger">{{$errors->first('kv_day_quantity')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input required type="number" class="form-control kv_store_total" x-model="field.kv_store_total" name="kv_store_total[]" value="" readonly>
                                                    @if($errors->first('kv_store_total')) <small class="form-text text-danger">{{$errors->first('kv_store_total')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <button @click="removeField(index)" class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <br>
                                                <br>
                                            </td>
                                        </tr>
                                    </template>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td><button @click="addNewField()" class="btn btn-success" type="button">+</button></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <input type="file" multiple name="order_images[]">
                            </div>
                            @foreach($order->order_images as $image)
                                <div class="col-md-2" >
                                    <div style="width: 100%; height: 150px; margin: 30px 0;">
                                        <img src="{{ asset('storage/' . $image->image) }}" style="height: 100%; width: 100%; object-fit: contain;" alt="">
                                        <p class="btn btn-danger delete-image-btn" data-image-id="{{ $image->id }}"><i class="fas fa-trash"></i></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Yadda saxla</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@include('includes.footer')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>

    function store() {
        return {
            fields: @json($order->order_stores),
            addNewField() {
                this.fields.push({
                    transport: '',
                    store: '',
                    month_day: '',
                    store_price: '',
                    day_quantity: '',
                    store_total: '',
                });
            },

            removeField(index) {
                this.fields.splice(index, 1);
            },

            updatePrice(field) {
                const month_day = field.month_day;

                const first = field.transport;
                const transport_id = document.querySelector(`.transports option[value='${first}']`).dataset.transport_id;

                const third = field.store;
                const store_id = document.querySelector(`.stores option[value='${third}']`).dataset.store_id;


                if (month_day && transport_id && store_id) {
                    $.ajax({
                        url: `/getStorePrice?transport_id=${transport_id}&store_id=${store_id}&month_day=${month_day}`,
                        method: 'GET',
                        dataType: 'json',
                        success: (storePrice) => {
                            if (typeof storePrice.daily_price !== 'undefined') {
                                field.store_price = storePrice.daily_price;
                            }else{

                                field.store_price = storePrice.monthly_price;

                            }
                            this.calcCommon(field);
                        },
                        error: () => {
                            console.error('Failed to fetch direction price');
                        }
                    });
                }
            },



            calcCommon(field) {
                var price = field.store_price || 0;
                var quantity = field.day_quantity || 0;

                var rowTotal = price * quantity;

                field.store_total = rowTotal;
            },

        };
    }
    function stores() {
        return {
            fields: @json($order->order_kv_stores),
            addNewField() {
                this.fields.push({
                    kv_quantity: '',
                    kv_store: '',
                    kv_month_day: '',
                    kv_store_price: '',
                    kv_day_quantity: '',
                    kv_store_total: '',
                });
            },

            removeField(index) {
                this.fields.splice(index, 1);
            },

            updatePrice(field) {
                const month_day = field.kv_month_day;

                const kv_quantity = field.kv_quantity;

                const third = field.kv_store;
                const kv_store_id = document.querySelector(`.kv_stores option[value='${third}']`).dataset.kv_store_id;

                if (month_day && kv_quantity && kv_store_id) {
                    $.ajax({
                        url: `/getStorePrices?kv_store_id=${kv_store_id}&kv_quantity=${kv_quantity}&month_day=${month_day}`,
                        method: 'GET',
                        dataType: 'json',
                        success: (storePrice) => {
                            if (typeof storePrice.daily_price !== 'undefined') {
                                field.kv_store_price = storePrice.daily_price;
                            }else{
                                field.kv_store_price = storePrice.monthly_price;
                            }
                            this.calcCommon(field);
                        },
                        error: () => {
                            console.error('Failed to fetch direction price');
                        }
                    });
                }
            },



            calcCommon(field) {
                var price = field.kv_store_price || 0;
                var quantity = field.kv_day_quantity || 0;
                var kv_quantity = field.kv_quantity || 0;
                var kv_month_day = field.kv_month_day;
                var rowTotal = 0;
                if(kv_quantity > 51 ){
                    rowTotal = kv_quantity * price * quantity;
                }else if(kv_quantity < 50 && kv_quantity > 11 && kv_month_day === 'monthly_price'){
                    rowTotal =  kv_quantity * price * quantity;
                }else{
                    rowTotal =  price * quantity;
                }


                field.kv_store_total = rowTotal;
            },

        };
    }


    $(document).ready(function () {
        $('.delete-image-btn').on('click', function () {
            var imageId = $(this).data('image-id');
            var token = "{{ csrf_token() }}";

            $.ajax({
                url: "{{ route('order.images.delete') }}",
                type: 'DELETE',
                data: {
                    image_id: imageId,
                    _token: token
                },
                success: function (response) {
                    if (response.success) {
                        $('[data-image-id="' + imageId + '"]').parent().remove();
                    }
                }
            });
        });
    });

    function applyMask() {
        var phoneInput = document.querySelector('[name="phone"]');
        var operatorInput = document.querySelector('[name="operator_phone"]');
        phoneInput.value = '994' + phoneInput.value.replace(/\D/g, '');
        operatorInput.value = '994' + phoneInput.value.replace(/\D/g, '');
        $(phoneInput).mask('000000000000');
        $(operatorInput).mask('000000000000');
    }

    function direction() {
        return {
            fields: @json($order->order_directions),
            addNewField() {
                this.fields.push({
                    direction_car: '',
                    direction_type: '',
                    direction: '',
                    direction_price: '',
                    direction_quantity: '',
                    direction_total: '',
                    direction_worker_total: '',
                    direction_worker_price: '',
                    direction_list: []
                });
            },
            initDirectionList() {

                this.fields.forEach(async (field) => {
                    if (field.direction_type) {

                        var id = '';
                        if (field.direction_type == 'Bakı - Abşeron') {
                            id = 1;
                        } else if (field.direction_type == 'Bakı - Region') {
                            id = 2;
                        } else if (field.direction_type == 'Region - Region') {
                            id = 3;
                        }


                        if (id != '3') {
                            const response = await fetch(`/getDirections?id=${id}`);

                            if (response.ok) {
                                const directionList = await response.json();
                                field.direction_list = directionList;
                            } else {
                                console.error('Failed to fetch direction data');
                            }

                        }
                    }
                });
            },
            removeField(index) {
                this.fields.splice(index, 1);
            },

            async updateDirection(field) {
                try {
                    const selectedThing = field.direction_type;
                    if (!selectedThing) {
                        return;
                    }

                    const typeElement = this.$el.querySelector(`.direction_type option[value='${selectedThing}']`);
                    if (!typeElement || !typeElement.dataset) {
                        return;
                    }

                    const id = typeElement.dataset.direction_type;

                    if (id != '3') {
                        const response = await fetch(`/getDirections?id=${id}`);

                        if (response.ok) {
                            const directionList = await response.json();
                            field.direction_list = directionList;
                        } else {
                            console.error('Failed to fetch direction data');
                        }
                    }

                    this.calcCommon(field);

                } catch (error) {
                    console.error('Error fetching directions:', error);
                }
            },

            updatePrice(field) {
                const first = field.direction_car;
                const selectedCarId = document.querySelector(`.car_list option[value='${first}']`).dataset.car_id;
                const selectedWorkerCount = document.querySelector(`.car_list option[value='${first}']`).dataset.worker_count;
                const selectedWorkerPrice = document.querySelector(`.car_list option[value='${first}']`).dataset.worker_price;
                field.direction_worker_price = selectedWorkerPrice;
                field.direction_worker_total = selectedWorkerCount;
                const third = field.direction;
                const selectedDirection = document.querySelector(`.direction_list option[value='${third}']`).dataset.direction_id;

                const second = field.direction_type;
                const selectedDirectionType = document.querySelector(`.direction_type option[value='${second}']`).dataset.direction_type;

                $.ajax({
                    url: `/getRegionPrice?car_id=${selectedCarId}&region_id=${selectedDirectionType}&direction_id=${selectedDirection}`,
                    method: 'GET',
                    dataType: 'json',
                    success: (directionPrice) => {
                        field.direction_price = directionPrice.max_price;
                        this.calcCommon(field);
                    },
                    error: () => {
                        console.error('Failed to fetch direction price');
                    }
                });
            },

            calcCommon(field) {
                const price = field.direction_price || 0;
                const quantity = field.direction_quantity || 0;
                const worker_total = field.direction_worker_total || 0;
                const worker_price = field.direction_worker_price || 0;

                const rowTotal = (price * quantity) + (worker_total * worker_price);

                field.direction_total = rowTotal;
            },

        };
    }

    function master() {
        return {
            fields: @json($order->order_masters),
            addNewField() {
                this.fields.push({
                    thing_total: '',
                    thing_quantity: '',
                    thing_price: '',
                    thing_service: '',
                    thing: ''
                });
            },

            removeField(index) {
                this.fields.splice(index, 1);
            },

            async updateThing(field) {
                try {
                    var selectedThing = field.thing;
                    var selectedThingId = document.querySelector(`.thing_list option[value='${selectedThing}']`).dataset.thing_id;
                    var selectedThingService = field.thing_service;
                    var selectedThingServiceId = document.querySelector(`.thing_service_list option[value='${selectedThingService}']`).dataset.thing_service_id;

                    var response = await fetch(`/getThingPrice?thing_id=${selectedThingId}&thing_service_id=${selectedThingServiceId}`);
                    console.log(response);

                    if (response.ok) {
                        var thingPrice = await response.json();
                        var thingMinPrice = thingPrice.min_price;
                        field.thing_price = thingPrice.max_price;

                        this.calcCommon(field);
                    } else {
                        console.error('Failed to fetch thing price');
                    }
                } catch (error) {
                    console.error('Error fetching thing price:', error);
                }
            },

            calcCommon(field) {
                var price = field.thing_price || 0;
                var quantity = field.thing_quantity || 0;

                var rowTotal = price * quantity;

                field.thing_total = rowTotal;
            }
        };
    }


    function worker() {
        return {
            fields: @json($order->order_workers),
            addNewField() {
                this.fields.push({
                    worker_total: '',
                    worker_quantity: '',
                    worker_price: '',
                    worker_day: '',
                    worker: '',
                });
            },

            removeField(index) {
                this.fields.splice(index, 1);
            },

            updateWorker(field) {
                var selectedWorker = field.worker;
                var workerPrice = document.querySelector(`.worker_list option[value='${selectedWorker}']`).dataset.worker_price;
                field.worker_price = workerPrice;

                this.calcCommon(field);
            },

            calcCommon(field) {
                var price = field.worker_price || 0;
                var quantity = field.worker_quantity || 0;
                var day = field.worker_day || 0;

                var rowTotal = price * quantity * day;

                field.worker_total = rowTotal;
            },

        };
    }

    function products() {
        return {
            fields: @json($order->order_products),
            addNewField() {
                this.fields.push({
                    product: '',
                    product_quantity: '',
                });
            },

            removeField(index) {
                this.fields.splice(index, 1);
            },


        };
    }
</script>
