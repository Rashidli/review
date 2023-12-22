<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\PlanWarehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanWarehouseController extends Controller
{
    public function __construct( )
    {

        $this->middleware('permission:list-plan_warehouses|create-plan_warehouses|edit-plan_warehouses|delete-plan_warehouses', ['only' => ['index','show']]);
        $this->middleware('permission:create-plan_warehouses', ['only' => ['create','store']]);
        $this->middleware('permission:edit-plan_warehouses', ['only' => ['edit']]);
        $this->middleware('permission:delete-plan_warehouses', ['only' => ['destroy']]);

    }

    public function index()
    {

        $plan_warehouses = PlanWarehouse::with('plans')->paginate(10);
        $plans = Plan::all();
        return view('plan_warehouses.index', compact( 'plan_warehouses', 'plans'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $plans = Plan::all();
        return view('plan_warehouses.create', compact( 'plans'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
//            $request->validate([
//                'title' => 'required',
//                'plan_warehouse.*.plan_warehouse_plan_id' => 'required',
//                'plan_warehouse.*.min_price' => 'nullable|numeric',
//                'plan_warehouse.*.max_price' => 'nullable|numeric',
//            ]);

            $plan_warehouse = new PlanWarehouse();
            $plan_warehouse->title = $request->title;
            $plan_warehouse->save();

            $plans = $request->plans;

            $planData = [];

            foreach ($plans as $plan) {
                $planData[$plan['plan_id']] = [
                    'monthly_price' => $plan['monthly_price'],
                    'daily_price' => $plan['daily_price'],
                    'monthly_price_per_square_meter' => isset($plan['monthly_price_per_square_meter']),
                    'daily_price_per_square_meter' => isset($plan['daily_price_per_square_meter']),
                ];
            }

            $plan_warehouse->plans()->attach($planData);

            DB::commit();

            return redirect()->route('plan_warehouses.index')->with('message', 'Anbar added successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanWarehouse $plan_warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $plan_warehouse = PlanWarehouse::with('plans')->findOrFail($id);

        $plans = Plan::all();
        return view('plan_warehouses.edit', compact('plan_warehouse', 'plans'));

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
//                'plan_warehouse.*.min_price' => 'nullable|numeric',
//                'plan_warehouse.*.max_price' => 'nullable|numeric',
//            ]);

            $plan_warehouse = PlanWarehouse::findOrFail($id);
            $plan_warehouse->title = $request->title;
            $plan_warehouse->save();

            $plans = $request->plans;

            $planData = [];

            foreach ($plans as $plan) {
                $planData[$plan['plan_id']] = [
                    'monthly_price' => $plan['monthly_price'],
                    'daily_price' => $plan['daily_price'],
                    'monthly_price_per_square_meter' => isset($plan['monthly_price_per_square_meter']),
                    'daily_price_per_square_meter' => isset($plan['daily_price_per_square_meter']),
                ];
            }

            $plan_warehouse->plans()->sync($planData);

            DB::commit();

            return redirect()->route('plan_warehouses.index')->with('message', 'Anbar updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanWarehouse $plan_warehouse)
    {

        $plan_warehouse->delete();

        return redirect()->route('plan_warehouses.index')->with('message', 'Anbar deleted successfully');

    }
}
