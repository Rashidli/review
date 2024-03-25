<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Mail\SendEmail;
use App\Models\Address;
use App\Models\Car;
use App\Models\Direction;
use App\Models\DirectionPrice;
use App\Models\Order;
use App\Models\OrderDirection;
use App\Models\OrderImage;
use App\Models\OrderKvStore;
use App\Models\OrderMaster;
use App\Models\OrderProduct;
use App\Models\OrderStore;
use App\Models\OrderWorker;
use App\Models\Plan;
use App\Models\PlanPrice;
use App\Models\PlanWarehouse;
use App\Models\Product;
use App\Models\RegionPrice;
use App\Models\Thing;
use App\Models\ThingPrice;
use App\Models\ThingService;
use App\Models\Transport;
use App\Models\TransportPrice;
use App\Models\TransportWarehouse;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{

    public function export()
    {
        $orders = Order::with('order_directions','order_workers','order_masters')->get();
        return Excel::download(new OrdersExport($orders), 'orders.xlsx');
    }
    public function __construct( )
    {

        $this->middleware('permission:list-orders|create-orders|edit-orders|delete-orders', ['only' => ['index','show']]);
        $this->middleware('permission:create-orders', ['only' => ['create','store']]);
        $this->middleware('permission:edit-orders', ['only' => ['edit']]);
        $this->middleware('permission:delete-orders', ['only' => ['destroy']]);

    }

    public function index()
    {

        $orders = Order::where('user_id',auth()->user()->id)->paginate(10);
        return view('orders.index', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $transports = Transport::all();
        $stores = TransportWarehouse::all();
        $kv_stores = PlanWarehouse::all();
        $direction_cars = Car::all();
        $products = Product::all();
        $things = Thing::all();
        $thing_services = ThingService::all();
        $workers = Worker::all();
        return view('orders.create', compact('direction_cars','things','thing_services','workers','products','transports','stores','kv_stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

//        dd($request->all());
        DB::beginTransaction();
        try {
            $request->validate([
                'customer_name' => 'required',
                'review_date' => 'required',
                'review_type' => 'required',
            ]);

            $order = new Order();
            $order->customer_name = $request->input('customer_name');
            $order->review_date = $request->input('review_date');
            $order->review_type = $request->input('review_type');
            $order->phone = $request->input('phone');
            $order->operator_phone = $request->input('operator_phone');
            $order->email = $request->input('email');
            $order->user_id = auth()->user()->id;

            $order->save();

            if($request->input('direction_car')){
                $orderDirectionModels = [];
                foreach ($request->input('direction_car') as $key => $value) {
                    $orderDirectionModels[] = new OrderDirection([
                        'order_id' => $order->id,
                        'direction_car' => $value == '----' ? null : $value,
                        'direction_type' => $request->input('direction_type')[$key] === 'Select Direction' ? null : $request->input('direction_type')[$key],
                        'direction' => $request->input('direction')[$key] === 'Select Direction' ? null : $request->input('direction')[$key],
                        'direction_price' => $request->input('direction_price')[$key],
                        'direction_quantity' => $request->input('direction_quantity')[$key],
                        'direction_total' => $request->input('direction_total')[$key],
                        'direction_worker_total' => $request->input('direction_worker_total')[$key],
                        'direction_worker_price' => $request->input('direction_worker_price')[$key],
                        'from' => $request->input('from')[$key] ?? null,
                        'to' => $request->input('to')[$key] ?? null,
                    ]);
                }
                $order->order_directions()->saveMany($orderDirectionModels);
            }

            if($request->input('thing')){

                $orderMasterModels = [];
                foreach ($request->input('thing') as $key => $value) {
                    $orderMasterModels[] = new OrderMaster([
                        'order_id' => $order->id,
                        'thing' => $value,
                        'thing_service' => $request->input('thing_service')[$key],
                        'thing_price' => $request->input('thing_price')[$key],
                        'thing_quantity' => $request->input('thing_quantity')[$key],
                        'thing_total' => $request->input('thing_total')[$key],
                    ]);
                }
                $order->order_masters()->saveMany($orderMasterModels);

            }

            if($request->input('worker')){
                $orderWorkerModels = [];
                foreach ($request->input('worker') as $key => $value) {
                    $orderWorkerModels[] = new OrderWorker([
                        'order_id' => $order->id,
                        'worker' => $value,
                        'worker_price' => $request->input('worker_price')[$key],
                        'worker_quantity' => $request->input('worker_quantity')[$key],
                        'worker_day' => $request->input('worker_day')[$key],
                        'worker_total' => $request->input('worker_total')[$key],
                    ]);
                }
                $order->order_workers()->saveMany($orderWorkerModels);
            }

            if($request->input('product')){
                $orderProductModels = [];
                foreach ($request->input('product') as $key => $value) {
                    $orderProductModels[] = new OrderProduct([
                        'order_id' => $order->id,
                        'product' => $value,
                        'product_quantity' => $request->input('product_quantity')[$key],
                    ]);
                }
                $order->order_products()->saveMany($orderProductModels);
            }

            if($request->input('transport')){
                $orderStoreModels = [];
                foreach ($request->input('transport') as $key => $value) {
                    $orderStoreModels[] = new OrderStore([
                        'order_id' => $order->id,
                        'transport' => $value,
                        'store' => $request->input('store')[$key],
                        'month_day' => $request->input('month_day')[$key],
                        'store_price' => $request->input('store_price')[$key],
                        'day_quantity' => $request->input('day_quantity')[$key],
                        'store_total' => $request->input('store_total')[$key],
                    ]);
                }
                $order->order_stores()->saveMany($orderStoreModels);
            }

            if($request->input('kv_quantity')){
                $orderKvStoreModels = [];
                foreach ($request->input('kv_quantity') as $key => $value) {
                    $orderKvStoreModels[] = new OrderKvStore([
                        'order_id' => $order->id,
                        'kv_quantity' => $value,
                        'kv_store' => $request->input('kv_store')[$key],
                        'kv_month_day' => $request->input('kv_month_day')[$key],
                        'kv_store_price' => $request->input('kv_store_price')[$key],
                        'kv_day_quantity' => $request->input('kv_day_quantity')[$key],
                        'kv_store_total' => $request->input('kv_store_total')[$key],
                    ]);
                }
                $order->order_kv_stores()->saveMany($orderKvStoreModels);
            }


            DB::commit();
            return redirect()->route('orders.index')->with('message', 'Sifariş added successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }
    }


    public function getDirections(Request $request)
    {
        try {
            $id = $request->id;

            if ($id == 1) {
                $addresses = Address::all();
                return response()->json($addresses);
            } elseif ($id == 2) {
                $directions = Direction::all();
                return response()->json($directions);
            } else {
                throw new \Exception('Invalid id');
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getRegionPrice(Request $request)
    {
        try {
            $car_id = $request->car_id;
            $region_id = $request->region_id;
            $direction_id = $request->direction_id;

            if ($region_id == 1) {
                $address = Address::findOrFail($direction_id);
                $id = $address->region_id;
                $prices = RegionPrice::where([['car_id', $car_id], ['region_id', $id]])->first();
            } elseif ($region_id == 2) {
                $prices = DirectionPrice::where([['car_id', $car_id], ['direction_id', $direction_id]])->first();
            } else {
                throw new \Exception('Invalid region_id');
            }

            return response()->json($prices);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getStorePrice(Request $request)
    {
        try {
            $transport_id = $request->transport_id;
            $store_id = $request->store_id;
            $month_day = $request->month_day;
            if($transport_id && $store_id && $month_day){
                $price = TransportPrice::select($month_day)->where([['transport_id', $transport_id],['transport_warehouse_id', $store_id]])->first();
            }

            return response()->json($price);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getStorePrices(Request $request)
    {
        try {
            $kv_quantity = $request->kv_quantity;
            $kv_store_id = $request->kv_store_id;
            $month_day = $request->month_day;
            $plan = Plan::where('from', '<=', $kv_quantity)
                ->where('to', '>=', $kv_quantity)
                ->first();
            $plan_id = $plan->id;
            if($kv_quantity && $kv_store_id && $month_day){
                $price = PlanPrice::select($month_day)->where([['plan_warehouse_id', $kv_store_id],['plan_id', $plan_id]])->first();
            }

            return response()->json($price);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function getThingPrice(Request $request)
    {


        try {
            $thing_id  = $request->thing_id;
            $thing_service_id  = $request->thing_service_id;
            $think_prices = ThingPrice::where([['thing_id',$thing_id],['thing_service_id',$thing_service_id]])->first();
            return response()->json($think_prices);
        }catch (\Exception $exception){
            return $exception->getMessage();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $order = Order::with('order_masters', 'order_workers', 'order_directions')->findOrFail($id);
        return view('orders.show', compact('order'));

    }

    public function get_order($id)
    {

        $order = Order::with('order_masters', 'order_workers', 'order_directions','order_products')->findOrFail($id);
        return view('orders.for_customer', compact('order'));

    }

    public function operator_sifaris($id)
    {
        $order = Order::with('order_masters', 'order_workers', 'order_directions','order_products')->findOrFail($id);
        return view('orders.for_operator', compact('order'));
    }

    public function full_list($id)
    {
        $order = Order::with('order_masters', 'order_workers', 'order_directions','order_products')->findOrFail($id);
        return view('orders.full_list', compact('order'));
    }

    public function change_status(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }

    public function customer_answer($id)
    {

        $order = Order::findOrFail($id);
        $order->update([
            'customer_answer' => true,
        ]);

        return redirect()->back();

    }

    public function customer_full_answer($id)
    {

        $order = Order::findOrFail($id);
        $order->update([
            'customer_full_answer' => true,
        ]);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $kv_stores = PlanWarehouse::all();
        $direction_cars = Car::all();
        $transports = Transport::all();
        $stores = TransportWarehouse::all();
        $products = Product::all();
        $things = Thing::all();
        $directions = Direction::all();
        $addresses = Address::all();
        $thing_services = ThingService::all();
        $workers = Worker::all();
        return view('orders.edit', compact('kv_stores','order','direction_cars','things','thing_services','workers','directions','addresses','products','transports','stores'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
//        dd($request->all());
        DB::beginTransaction();
        try {
            $request->validate([
                'customer_name' => 'required',
                'review_date' => 'required',
                'review_type' => 'required',
                'phone' => 'required',
            ]);

            $order->customer_name = $request->input('customer_name');
            $order->review_date = $request->input('review_date');
            $order->review_type = $request->input('review_type');
            $order->phone = $request->input('phone');
            $order->operator_phone = $request->input('operator_phone');
            $order->email = $request->input('email');

            $order->save();

            self::updateOrderDirections($order, $request);
            self::updateOrderMasters($order, $request);
            self::updateOrderWorkers($order, $request);
            self::updateOrderProducts($order, $request);
            self::updateOrderImages($order,$request);
            self::updateOrderStores($order,$request);
            self::updateKvOrderStores($order,$request);

            DB::commit();
            return redirect()->back()->with('message', 'Order updated successfully');
        }catch (\Exception $exception){
            DB::rollBack();
            return $exception->getMessage();
        }
    }

    private function updateOrderDirections(Order $order, Request $request)
    {
        if ($request->filled('direction_car')) {
            $orderDirectionModels = [];
            foreach ($request->input('direction_car') as $key => $value) {
                $orderDirectionModels[] = [
                    'order_id' => $order->id,
                    'direction_car' => $value,
                    'direction_type' => $request->input('direction_type')[$key],
                    'direction' => $request->input('direction')[$key] ?? null,
                    'direction_price' => $request->input('direction_price')[$key],
                    'direction_quantity' => $request->input('direction_quantity')[$key],
                    'direction_total' => $request->input('direction_total')[$key],
                    'direction_worker_total' => $request->input('direction_worker_total')[$key],
                    'direction_worker_price' => $request->input('direction_worker_price')[$key],
                    'from' => $request->input('from')[$key] ?? null,
                    'to' => $request->input('to')[$key] ?? null,
                ];
            }
            $order->order_directions()->delete();
            $order->order_directions()->createMany($orderDirectionModels);
        }
    }

    private function updateOrderMasters(Order $order, Request $request)
    {
        if ($request->filled('thing')) {
            $orderMasterModels = [];
            foreach ($request->input('thing') as $key => $value) {
                $orderMasterModels[] = [
                    'order_id' => $order->id,
                    'thing' => $value,
                    'thing_service' => $request->input('thing_service')[$key],
                    'thing_price' => $request->input('thing_price')[$key],
                    'thing_quantity' => $request->input('thing_quantity')[$key],
                    'thing_total' => $request->input('thing_total')[$key],
                ];
            }
            $order->order_masters()->delete();
            $order->order_masters()->createMany($orderMasterModels);
        }
    }

    private function updateOrderWorkers(Order $order, Request $request)
    {
        if ($request->filled('worker')) {
            $orderWorkerModels = [];
            foreach ($request->input('worker') as $key => $value) {
                $orderWorkerModels[] = [
                    'order_id' => $order->id,
                    'worker' => $value,
                    'worker_price' => $request->input('worker_price')[$key],
                    'worker_quantity' => $request->input('worker_quantity')[$key],
                    'worker_day' => $request->input('worker_day')[$key],
                    'worker_total' => $request->input('worker_total')[$key],
                ];
            }
            $order->order_workers()->delete();
            $order->order_workers()->createMany($orderWorkerModels);
        }
    }

    private function updateOrderStores(Order $order, Request $request)
    {
        if ($request->filled('transport')) {
            $orderStoreModels = [];
            foreach ($request->input('transport') as $key => $value) {
                $orderStoreModels[] = [
                    'order_id' => $order->id,
                    'transport' => $value,
                    'store' => $request->input('store')[$key],
                    'month_day' => $request->input('month_day')[$key],
                    'store_price' => $request->input('store_price')[$key],
                    'day_quantity' => $request->input('day_quantity')[$key],
                    'store_total' => $request->input('store_total')[$key],
                ];
            }
            $order->order_stores()->delete();
            $order->order_stores()->createMany($orderStoreModels);
        }

    }

    private function updateKvOrderStores(Order $order, Request $request)
    {
        if($request->filled('kv_quantity')){
            $orderKvStoreModels = [];
            foreach ($request->input('kv_quantity') as $key => $value) {
                $orderKvStoreModels[] = [
                    'order_id' => $order->id,
                    'kv_quantity' => $value,
                    'kv_store' => $request->input('kv_store')[$key],
                    'kv_month_day' => $request->input('kv_month_day')[$key],
                    'kv_store_price' => $request->input('kv_store_price')[$key],
                    'kv_day_quantity' => $request->input('kv_day_quantity')[$key],
                    'kv_store_total' => $request->input('kv_store_total')[$key],
                ];
            }

            $order->order_kv_stores()->delete();
            $order->order_kv_stores()->createMany($orderKvStoreModels);
        }
    }

    private function updateOrderProducts(Order $order, Request $request)
    {
        if ($request->filled('product')) {
            $orderProductModels = [];
            foreach ($request->input('product') as $key => $value) {
                $orderProductModels[] = [
                    'order_id' => $order->id,
                    'product' => $value,
                    'product_quantity' => $request->input('product_quantity')[$key],
                ];
            }
            $order->order_products()->delete();
            $order->order_products()->createMany($orderProductModels);
        }
    }

    private function updateOrderImages(Order $order, Request $request){
        if($request->order_images){
            $orderImageModels = [];
            foreach ($request->order_images as $image){

                $file = $image;
                $filename = Str::uuid() . "." . $file->extension();
                $file->storeAs('public/',$filename);
                $orderImageModels[] = [
                    'order_id' => $order->id,
                    'image' => $filename
                ];


            }
            $order->order_images()->createMany($orderImageModels);
        }


    }

    /**
     * Remove the specified resource title storage.
     */
    public function destroy(Order $order)
    {

        $order->delete();

        return redirect()->route('orders.index')->with('message', 'Sifariş deleted successfully');

    }

    public function delete(Request $request)
    {
        $imageId = $request->get('image_id');
        $image = OrderImage::find($imageId);

        if ($image) {
            Storage::delete('public/' . $image->image);

            $image->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }


    public function sendMail($id)
    {
        $order = Order::findOrFail($id);
        $mailSubject = "166 sifariş";
        $mailContent = "Zəhmət olmasa sifarişiniz ilə tanış olun.";

        Mail::to($order->email)->send(new SendEmail($mailSubject, $mailContent, $order));
        return redirect()->back()->with('message', 'Email göndərildi');
    }
}
