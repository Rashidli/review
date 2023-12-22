<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Car;
use App\Models\Direction;
use App\Models\DirectionPrice;
use App\Models\Order;
use App\Models\OrderDirection;
use App\Models\OrderMaster;
use App\Models\OrderWorker;
use App\Models\RegionPrice;
use App\Models\Thing;
use App\Models\ThingPrice;
use App\Models\ThingService;
use App\Models\Worker;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\MagicConst\Dir;

class OrderController extends Controller
{
    public function __construct( )
    {

        $this->middleware('permission:list-orders|create-orders|edit-orders|delete-orders', ['only' => ['index','show']]);
        $this->middleware('permission:create-orders', ['only' => ['create','store']]);
        $this->middleware('permission:edit-orders', ['only' => ['edit']]);
        $this->middleware('permission:delete-orders', ['only' => ['destroy']]);

    }

    public function index()
    {

        $orders = Order::paginate(10);
        return view('orders.index', compact('orders'));

    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $direction_cars = Car::all();
        $things = Thing::all();
        $thing_services = ThingService::all();
        $workers = Worker::all();
        return view('orders.create', compact('direction_cars','things','thing_services','workers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'customer_name'=>'required',
                'review_date'=>'required',
                'review_type'=>'required',
            ]);



            $order = new Order();
            $order->customer_name = $request->customer_name;
            $order->review_date = $request->review_date;
            $order->review_type = $request->review_type;


            $order->save();

            $order_directions = $request->order_directions;
            $order_masters = $request->order_masters;
            $order_workers = $request->order_workers;

            $orderDirectionModels = [];
            foreach ($order_directions as $directionData) {
                $orderDirectionModels[] = new OrderDirection($directionData);
            }
            $order->order_directions()->saveMany($orderDirectionModels);

            $orderMasterModels = [];
            foreach ($order_masters as $masterData) {
                $orderMasterModels[] = new OrderMaster($masterData);
            }
            $order->order_masters()->saveMany($orderMasterModels);

            $orderWorkerModels = [];
            foreach ($order_workers as $workerData) {
                $orderWorkerModels[] = new OrderWorker($workerData);
            }
            $order->order_workers()->saveMany($orderWorkerModels);

            return redirect()->route('orders.index')->with('message','Sifariş added successfully');
        }catch (\Exception $exception){
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
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $direction_cars = Car::all();
        $things = Thing::all();
        $thing_services = ThingService::all();
        $workers = Worker::all();
        return view('orders.edit', compact('order','direction_cars','things','thing_services','workers'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {

        $request->validate([
            'customer_name'=>'required',
            'review_date'=>'required',
            'review_type'=>'required',
        ]);


        $order->customer_name = $request->customer_name;
        $order->review_date = $request->review_date;
        $order->review_type = $request->review_type;


        $order->save();

        return redirect()->back()->with('message','Sifariş updated successfully');

    }

    /**
     * Remove the specified resource title storage.
     */
    public function destroy(Order $order)
    {

        $order->delete();

        return redirect()->route('orders.index')->with('message', 'Sifariş deleted successfully');

    }
}
