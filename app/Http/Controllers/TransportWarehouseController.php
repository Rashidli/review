<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Transport;
use App\Models\TransportWarehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransportWarehouseController extends Controller
{
    public function __construct( )
    {

        $this->middleware('permission:list-transport_warehouses|create-transport_warehouses|edit-transport_warehouses|delete-transport_warehouses', ['only' => ['index','show']]);
        $this->middleware('permission:create-transport_warehouses', ['only' => ['create','store']]);
        $this->middleware('permission:edit-transport_warehouses', ['only' => ['edit']]);
        $this->middleware('permission:delete-transport_warehouses', ['only' => ['destroy']]);

    }

    public function index()
    {

        $transport_warehouses = TransportWarehouse::with('transports')->paginate(10);
        $transports = Transport::all();
        return view('transport_warehouses.index', compact( 'transport_warehouses', 'transports'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $transports = Transport::all();
        return view('transport_warehouses.create', compact( 'transports'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {


            $transport_warehouse = new TransportWarehouse();
            $transport_warehouse->title = $request->title;
            $transport_warehouse->save();

            $transportIds = $request->transport_id;
            $monthPrices = $request->monthly_price;
            $dayPrices = $request->daily_price;


            $transportData = [];

            foreach ($transportIds as $index => $transport_id) {
                $transportData[$transport_id] = [
                    'monthly_price' => $monthPrices[$index],
                    'daily_price' => $dayPrices[$index],
                ];
            }

            $transport_warehouse->transports()->attach($transportData);

            DB::commit();

            return redirect()->route('transport_warehouses.index')->with('message', 'Anbar added successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransportWarehouse $transport_warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $transport_warehouse = TransportWarehouse::with('transports')->findOrFail($id);

        $transports = Transport::all();
        return view('transport_warehouses.edit', compact('transport_warehouse', 'transports'));

    }


    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $transport_warehouse = TransportWarehouse::findOrFail($id);
            $transport_warehouse->title = $request->title;
            $transport_warehouse->save();

            $transportIds = $request->transport_id;
            $minPrices = $request->monthly_price;
            $maxPrices = $request->daily_price;

            if (count($transportIds) !== count($minPrices) || count($minPrices) !== count($maxPrices)) {
                throw new \Exception("Invalid input data.");
            }

            $transportData = [];

            foreach ($transportIds as $index => $transport_id) {
                $transportData[$transport_id] = [
                    'monthly_price' => $minPrices[$index],
                    'daily_price' => $maxPrices[$index],
                ];
            }

            $transport_warehouse->transports()->sync($transportData);

            DB::commit();

            return redirect()->route('transport_warehouses.index')->with('message', 'Anbar updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransportWarehouse $transport_warehouse)
    {

        $transport_warehouse->delete();

        return redirect()->route('transport_warehouses.index')->with('message', 'Anbar deleted successfully');

    }
}
