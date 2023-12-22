

@include('includes.header')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <form action="{{route('orders.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Sifariş əlavə et</h4>
                            <div class="row">
                                <div class="col-4">

                                    <div class="mb-3">
                                        <label class="col-form-label">Sifarişçi</label>
                                        <input class="form-control" type="text" name="customer_name" value="{{old('customer_name')}}">
                                        @if($errors->first('customer_name')) <small class="form-text text-danger">{{$errors->first('customer_name')}}</small> @endif
                                    </div>

                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="col-form-label">Baxış tarix</label>
                                        <input class="form-control" type="date" name="review_date" value="{{old('review_date')}}">
                                        @if($errors->first('review_date')) <small class="form-text text-danger">{{$errors->first('review_date')}}</small> @endif
                                    </div>

                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="col-form-label">Əməkdaşlıq</label>
                                        <input class="form-control" type="text" name="review_type" value="{{old('review_type')}}">
                                        @if($errors->first('review_type')) <small class="form-text text-danger">{{$errors->first('review_type')}}</small> @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h4>Nəqliyyat</h4>
                                    <table class="repeater custom-table">
                                        <thead>
                                        <tr>
                                            <th>Maşın</th>
                                            <th>Region</th>
                                            <th>İstiqamət</th>
                                            <th>Qiymət</th>
                                            <th>Reys sayı</th>
                                            <th>Ümumi qiymət</th>
                                            <th>Sil</th>
                                        </tr>
                                        </thead>
                                        <tbody  data-repeater-list="order_directions">
                                        <tr data-repeater-item>
                                            <td>
                                                <div class="mb-3">
                                                    <select name="direction_car" class="form-control car_list">
                                                        <option selected>----</option>
                                                        @foreach($direction_cars as $car)
                                                            <option value="{{$car->title}}" data-car_id="{{$car->id}}">{{$car->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('direction_car')) <small class="form-text text-danger">{{$errors->first('direction_car')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <select name="direction_type" class="form-control direction_type">
                                                        <option disabled selected>----</option>
                                                        <option value="Bakı - Abşeron" data-direction_type="1">Bakı - Abşeron</option>
                                                        <option value="Bakı - Region" data-direction_type="2">Bakı - Region</option>
                                                    </select>
                                                    @if($errors->first('direction_type')) <small class="form-text text-danger">{{$errors->first('direction_type')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <select name="direction" class="form-control direction_list"></select>
                                                    @if($errors->first('direction')) <small class="form-text text-danger">{{$errors->first('direction')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control direction_price" name="direction_price" value="">
                                                    <div class="error-message" style="color: red"></div>
                                                    @if($errors->first('direction_price')) <small class="form-text text-danger">{{$errors->first('direction_price')}}</small> @endif
                                                </div>
                                            </td>


                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control direction_quantity" name="direction_quantity" value="">
                                                    @if($errors->first('direction_quantity')) <small class="form-text text-danger">{{$errors->first('direction_quantity')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control direction_total" name="direction_total" value="">
                                                    @if($errors->first('direction_total')) <small class="form-text text-danger">{{$errors->first('direction_total')}}</small> @endif
                                                </div>
                                            </td>
                                            <td >
                                                <button data-repeater-delete class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <br>
                                                <br>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td><button data-repeater-create class="btn btn-success" type="button">+</button></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h4>Usta xidməti</h4>
                                    <table class="repeater custom-table">
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
                                        <tbody data-repeater-list="order_masters">
                                        <tr data-repeater-item>
                                            <td>
                                                <div class="mb-3">
                                                    <select name="thing" class="form-control thing_list">
                                                        <option selected>----</option>
                                                        @foreach($things as $thing)
                                                            <option value="{{$thing->title}}" data-thing_id="{{$thing->id}}">{{$thing->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('thing')) <small class="form-text text-danger">{{$errors->first('thing')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <select name="thing_service" class="form-control thing_service_list">
                                                        <option selected>----</option>
                                                        @foreach($thing_services as $thing_service)
                                                            <option value="{{$thing_service->title}}" data-thing_service_id="{{$thing_service->id}}">{{$thing_service->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('thing_service')) <small class="form-text text-danger">{{$errors->first('thing_service')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control thing_price" name="thing_price" value="">
                                                    <div class="error-message" style="color: red"></div>
                                                    @if($errors->first('thing_price')) <small class="form-text text-danger">{{$errors->first('thing_price')}}</small> @endif
                                                </div>
                                            </td>


                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control thing_quantity" name="thing_quantity" value="">
                                                    @if($errors->first('thing_quantity')) <small class="form-text text-danger">{{$errors->first('thing_quantity')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control thing_total" name="thing_total" value="">
                                                    @if($errors->first('thing_total')) <small class="form-text text-danger">{{$errors->first('thing_total')}}</small> @endif
                                                </div>
                                            </td>
                                            <td >
                                                <button data-repeater-delete class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <br>
                                                <br>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td><button data-repeater-create class="btn btn-success" type="button">+</button></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h4>İşçi qüvvəsi</h4>
                                    <table class="repeater custom-table">
                                        <thead>
                                        <tr>
                                            <th>Növbə</th>
                                            <th>Qiymət</th>
                                            <th>Sayı</th>
                                            <th>Ümumi qiymət</th>
                                            <th>Sil</th>
                                        </tr>
                                        </thead>
                                        <tbody data-repeater-list="order_workers">
                                        <tr data-repeater-item>
                                            <td>
                                                <div class="mb-3">
                                                    <select name="worker" class="form-control worker_list">
                                                        <option selected>----</option>
                                                        @foreach($workers as $worker)
                                                            <option value="{{$worker->shift}}" data-worker_price="{{$worker->price}}">{{$worker->shift}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->first('worker')) <small class="form-text text-danger">{{$errors->first('worker')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control worker_price" name="worker_price" value="">
                                                    <div class="error-message" style="color: red"></div>
                                                    @if($errors->first('worker_price')) <small class="form-text text-danger">{{$errors->first('worker_price')}}</small> @endif
                                                </div>
                                            </td>


                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control worker_quantity" name="worker_quantity" value="">
                                                    @if($errors->first('worker_quantity')) <small class="form-text text-danger">{{$errors->first('worker_quantity')}}</small> @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="mb-3">
                                                    <input type="number" class="form-control worker_total" name="worker_total" value="">
                                                    @if($errors->first('worker_total')) <small class="form-text text-danger">{{$errors->first('worker_total')}}</small> @endif
                                                </div>
                                            </td>
                                            <td >
                                                <button data-repeater-delete class="btn btn-danger" type="button">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <br>
                                                <br>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td><button data-repeater-create class="btn btn-success" type="button">+</button></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div id="total_price"></div>
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
<script src="{{asset('assets/js/repeater.js')}}"></script>
<script>
    $(document).ready(function () {


        function handleRegionChange() {
            var selectedOption = $(this).find(':selected');
            var idValue = selectedOption.data('direction_type');

            var directionSelect = $(this).closest('tr').find('.direction_list');

            $.ajax({
                type: 'POST',
                url: '/getDirections',
                data: { id: idValue },
                success: function (response) {
                    directionSelect.empty();

                    var defaultOption = $('<option>', {
                        selected: true,
                        disabled: true
                    }).text('-----');
                    directionSelect.append(defaultOption);

                    $.each(response, function (index, item) {
                        var optionText = (idValue == 2) ? item.to : item.title;
                        var option = $('<option>', {
                            value: optionText,
                            'data-direction_id': item.id,
                        }).text(optionText);

                        directionSelect.append(option);
                    });

                    directionSelect.select2();

                    var directionContainer = directionSelect.siblings('.select2-container');
                    directionContainer.css('width', '');
                    var directionSelectWidth = directionContainer.outerWidth();
                    directionSelect.width(directionSelectWidth);
                },
                error: function (xhr, status, error) {

                }
            });
        }

        function getRegionPrice(element) {
            var car_id = element.closest('tr').find('.car_list').find(':selected').data('car_id');
            var region_id = element.closest('tr').find('.direction_type').find(':selected').data('direction_type');
            var direction_id = element.closest('tr').find('.direction_list').find(':selected').data('direction_id');
            var direction_price = element.closest('tr').find('.direction_price');

            $.ajax({
                type: 'POST',
                url: '/getRegionPrice',
                data: { car_id: car_id, region_id: region_id, direction_id: direction_id },
                dataType: 'json',
                success: function (response) {
                    direction_price.val(response.max_price);
                    direction_price.prop('min', response.min_price);
                    calculateRegionPrice(element);
                },
                error: function (xhr, status, error) {
                    console.error('Error in AJAX request:', error);
                }
            });
        }

        function calculateRegionPrice(element) {
            var direction_price_input = element.closest('tr').find('.direction_price');
            var direction_quantity = parseFloat(element.closest('tr').find('.direction_quantity').val());
            var direction_total = element.closest('tr').find('.direction_total');
            var error_message = element.closest('tr').find('.error-message');

            var minDirectionPrice = parseFloat(direction_price_input.prop('min'));
            var enteredDirectionPrice = parseFloat(direction_price_input.val());

            if (enteredDirectionPrice < minDirectionPrice) {
                error_message.text('minimum ' + minDirectionPrice);
            } else {
                error_message.text('');
            }
            var total = enteredDirectionPrice * direction_quantity;
            direction_total.val(total);
        }

        $('.custom-table').on('input', '.direction_quantity, .direction_price', function () {
            calculateRegionPrice($(this));
        });

        $('.custom-table').on('input', '.direction_list, .car_list', function (e) {
            getRegionPrice($(this));
        });

        $('.custom-table').on('change', '.direction_type', handleRegionChange);







        function getThingPrice(element) {
            var thing_id = element.closest('tr').find('.thing_list').find(':selected').data('thing_id');
            var thingSelect = $(this).closest('tr').find('.thing_list');
            var thing_service_id = element.closest('tr').find('.thing_service_list').find(':selected').data('thing_service_id');
            var thing_price = element.closest('tr').find('.thing_price');
            $.ajax({
                type: 'POST',
                url: '/getThingPrice',
                data: { thing_id: thing_id, thing_service_id: thing_service_id },
                dataType: 'json',
                success: function (response) {

                    thing_price.val(response.max_price);
                    thing_price.prop('min',response.min_price);
                    calculateThingPrice(element);

                    thingSelect.select2(); // Initialize or update the Select2

                    // Adjust the width of the Select2 for thing_list
                    var thingContainer = thingSelect.siblings('.select2-container');
                    thingContainer.css('width', ''); // Reset width
                    var thingSelectWidth = thingContainer.outerWidth();
                    thingSelect.width(thingSelectWidth);
                },
                error: function (xhr, status, error) {
                    console.error('Error in AJAX request:', error);
                }
            });
        }



        $(document).on('input', '.thing_list, .thing_service_list', function (e) {
            getThingPrice($(this));
        });

        function calculateThingPrice(element) {
            var thing_price_input = element.closest('tr').find('.thing_price');
            var thing_quantity = parseFloat(element.closest('tr').find('.thing_quantity').val());
            var thing_total = element.closest('tr').find('.thing_total');
            var error_message = element.closest('tr').find('.error-message');

            // Validate minimum value for thing_price
            var minDirectionPrice = parseFloat(thing_price_input.prop('min'));
            var enteredDirectionPrice = parseFloat(thing_price_input.val());

            if (enteredDirectionPrice < minDirectionPrice) {
                // Display an error message
                error_message.text('minimum '+ minDirectionPrice );
            } else {
                error_message.text(''); // Clear the error message if the value is valid
            }
            var total = enteredDirectionPrice * thing_quantity;
            thing_total.val(total);

        }

        $('.custom-table').on('input', '.thing_quantity, .thing_price', function() {
            calculateThingPrice($(this));
        });

        function getWorkerPrice(element){
            var worker_price = element.closest('tr').find('.worker_list').find(':selected').data('worker_price');
            var worker_price_input = element.closest('tr').find('.worker_price');
            worker_price_input.val(worker_price);
            calculateWorkerPrice(element);
        }

        $(document).on('input', '.worker_list', function (e) {
            getWorkerPrice($(this));
        });

        function calculateWorkerPrice(element){
            var worker_price_input = element.closest('tr').find('.worker_price').val();
            var worker_quantity = parseFloat(element.closest('tr').find('.worker_quantity').val());
            var worker_total = element.closest('tr').find('.worker_total');
            var total = worker_price_input * worker_quantity;
            worker_total.val(total);
        }

        $('.custom-table').on('input', '.worker_quantity, .worker_price', function() {
            calculateWorkerPrice($(this));
        });

        function calculateTotal() {
            // Initialize total variable
            let total = 0;

            // Iterate through each direction_total input and add its value to the total
            $('.direction_total').each(function () {
                // Parse the input value as a float (assuming it contains a valid number)
                const value = parseFloat($(this).val()) || 0;
                // Add the value to the total
                total += value;
            });

            // Display the total in the console (you can modify this part to display it elsewhere)
            console.log('Total: ' + total);
        }




    });

</script>
