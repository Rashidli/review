<?php

namespace App\Http\Controllers;

use App\Models\ThingService;
use Illuminate\Http\Request;

class ThingServiceController extends Controller
{
    public function __construct( )

    {

        $this->middleware('permission:list-thing_services|create-thing_services|edit-thing_services|delete-thing_services', ['only' => ['index','show']]);
        $this->middleware('permission:create-thing_services', ['only' => ['create','store']]);
        $this->middleware('permission:edit-thing_services', ['only' => ['edit']]);
        $this->middleware('permission:delete-thing_services', ['only' => ['destroy']]);

    }
    public function index()
    {

        $thing_services = ThingService::paginate(10);
        return view('thing_services.index', compact('thing_services'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('thing_services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required',
        ]);



        $thing_service = new ThingService();

        $thing_service->title = $request->title;

        $thing_service->save();

        return redirect()->route('thing_services.index')->with('message','Service added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(ThingService $thing_service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ThingService $thing_service)
    {

        return view('thing_services.edit', compact('thing_service'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ThingService $thing_service)
    {

        $request->validate([
            'title'=>'required',
        ]);


        $thing_service->title = $request->title;


        $thing_service->save();

        return redirect()->back()->with('message','Service updated successfully');

    }

    /**
     * Remove the specified resource title storage.
     */
    public function destroy(ThingService $thing_service)
    {

        $thing_service->delete();

        return redirect()->route('thing_services.index')->with('message', 'Service deleted successfully');

    }
}
