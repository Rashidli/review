<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __construct( )

    {

        $this->middleware('permission:list-cars|create-cars|edit-cars|delete-cars', ['only' => ['index','show']]);
        $this->middleware('permission:create-cars', ['only' => ['create','store']]);
        $this->middleware('permission:edit-cars', ['only' => ['edit']]);
        $this->middleware('permission:delete-cars', ['only' => ['destroy']]);

    }
    public function index()
    {

        $cars = Car::paginate(10);
        return view('cars.index', compact('cars'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required',
            'worker_count'=>'required',
            'worker_price'=>'required',
        ]);



        $car = new Car();

        $car->title = $request->title;
        $car->worker_count = $request->worker_count;
        $car->worker_price = $request->worker_price;

        $car->save();

        return redirect()->route('cars.index')->with('message','Car added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {

        return view('cars.edit', compact('car'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {

        $request->validate([
            'title'=>'required',
            'worker_count'=>'required',
            'worker_price'=>'required',
        ]);

        $car->title = $request->title;
        $car->worker_count = $request->worker_count;
        $car->worker_price = $request->worker_price;

        $car->save();

        return redirect()->back()->with('message','Car updated successfully');

    }

    /**
     * Remove the specified resource title storage.
     */
    public function destroy(Car $car)
    {

        $car->delete();

        return redirect()->route('cars.index')->with('message', 'Car deleted successfully');

    }
}
