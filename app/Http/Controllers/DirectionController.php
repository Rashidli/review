<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use App\Models\DirectionPrice;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectionController extends Controller
{
    public function __construct( )
    {

        $this->middleware('permission:list-directions|create-directions|edit-directions|delete-directions', ['only' => ['index','show']]);
        $this->middleware('permission:create-directions', ['only' => ['create','store']]);
        $this->middleware('permission:edit-directions', ['only' => ['edit']]);
        $this->middleware('permission:delete-directions', ['only' => ['destroy']]);

    }

    public function index()
    {

        $directions = Direction::with('direction_cars')->paginate(10);
        $direction_cars = Car::all();
        return view('directions.index', compact( 'directions', 'direction_cars'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $direction_cars = Car::all();
        return view('directions.create', compact( 'direction_cars'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        DB::beginTransaction();

        try {

            $direction = new Direction();
            $direction->to = $request->to;
            $direction->distance = $request->distance;
            $direction->save();

            $directionCarData = [];

            $carIds = $request->car_id;
            $maxPrices = $request->max_price;

            foreach ($carIds as $index => $carId) {
                $directionCarData[$carId] = [
                    'max_price' => $maxPrices[$index],
                ];
            }

            $direction->direction_cars()->attach($directionCarData);

            DB::commit();

            return redirect()->route('directions.index')->with('message', 'Price added successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Direction $direction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $direction = Direction::with('direction_cars')->findOrFail($id);

        $direction_cars = Car::all();
        return view('directions.edit', compact('direction', 'direction_cars'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        DB::beginTransaction();

        try {
            $direction = Direction::findOrFail($id);
            $direction->title = $request->title;
            $direction->distance = $request->distance;
            $direction->save();

            $directionCarData = [];

            $carIds = $request->car_id;
            $maxPrices = $request->max_price;

            foreach ($carIds as $index => $carId) {
                $directionCarData[$carId] = [
                    'max_price' => $maxPrices[$index],
                ];
            }

            $direction->direction_cars()->sync($directionCarData, false);

            DB::commit();

            return redirect()->back()->with('message', 'Price updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direction $direction)
    {

        $direction->delete();

        return redirect()->route('directions.index')->with('message', 'Price deleted successfully');

    }
}
