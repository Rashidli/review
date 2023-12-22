<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function __construct( )

    {

        $this->middleware('permission:list-regions|create-regions|edit-regions|delete-regions', ['only' => ['index','show']]);
        $this->middleware('permission:create-regions', ['only' => ['create','store']]);
        $this->middleware('permission:edit-regions', ['only' => ['edit']]);
        $this->middleware('permission:delete-regions', ['only' => ['destroy']]);

    }
    public function index()
    {

        $regions = Region::paginate(10);
        $cars = Car::all();
        return view('regions.index', compact('regions', 'cars'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars  = Car::all();
        return view('regions.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required',
        ]);


        $region = new Region();

        $region->title = $request->title;

        $region->save();

        $region_cars = $request->region_cars;

        $regionCarData = [];

        foreach ($region_cars as $region_car) {
            $regionCarData[$region_car['car_id']] = [
                'min_price' => $region_car['min_price'],
                'max_price' => $region_car['max_price'],
            ];
        }

        $region->region_cars()->attach($regionCarData);

        return redirect()->route('regions.index')->with('message','Region added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        $cars  = Car::all();
        return view('regions.edit', compact('region','cars'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region)
    {

        $request->validate([
            'title'=>'required',
        ]);


        $region->title = $request->title;


        $region->save();

        $region_cars = $request->region_cars;

        $regionCarData = [];

        foreach ($region_cars as $region_car) {
            $regionCarData[$region_car['car_id']] = [
                'min_price' => $region_car['min_price'],
                'max_price' => $region_car['max_price'],
            ];
        }

        $region->region_cars()->sync($regionCarData);

        return redirect()->back()->with('message','Region updated successfully');

    }

    /**
     * Remove the specified resource title storage.
     */
    public function destroy(Region $region)
    {

        $region->delete();

        return redirect()->route('regions.index')->with('message', 'Region deleted successfully');

    }
}
