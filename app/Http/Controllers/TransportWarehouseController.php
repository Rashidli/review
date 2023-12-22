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
//        dd($request->all());
        DB::beginTransaction();

        try {
//            $request->validate([
//                'title' => 'required',
//                'transport_warehouse.*.transport_warehouse_transport_id' => 'required',
//                'transport_warehouse.*.min_price' => 'nullable|numeric',
//                'transport_warehouse.*.max_price' => 'nullable|numeric',
//            ]);

            $transport_warehouse = new TransportWarehouse();
            $transport_warehouse->title = $request->title;
            $transport_warehouse->save();

            $transports = $request->transports;

            $transportData = [];

            foreach ($transports as $transport) {
                $transportData[$transport['transport_id']] = [
                    'monthly_price' => $transport['monthly_price'],
                    'daily_price' => $transport['daily_price'],
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
//            $request->validate([
//                'title' => 'required',
//                'transport_warehouse.*.min_price' => 'nullable|numeric',
//                'transport_warehouse.*.max_price' => 'nullable|numeric',
//            ]);

            $transport_warehouse = TransportWarehouse::findOrFail($id);
            $transport_warehouse->title = $request->title;
            $transport_warehouse->save();

            $transports = $request->transports;

            $transportData = [];

            foreach ($transports as $transport) {
                $transportData[$transport['transport_id']] = [
                    'monthly_price' => $transport['monthly_price'],
                    'daily_price' => $transport['daily_price'],
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
