<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function __construct( )

    {

        $this->middleware('permission:list-workers|create-workers|edit-workers|delete-workers', ['only' => ['index','show']]);
        $this->middleware('permission:create-workers', ['only' => ['create','store']]);
        $this->middleware('permission:edit-workers', ['only' => ['edit']]);
        $this->middleware('permission:delete-workers', ['only' => ['destroy']]);

    }
    public function index()
    {

        $workers = Worker::paginate(10);
        return view('workers.index', compact('workers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('workers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'shift'=>'required',
            'hours' => 'nullable',
            'price' => 'required|numeric'
        ]);



        $worker = new Worker();

        $worker->shift = $request->shift;
        $worker->hours = $request->hours;
        $worker->price = $request->price;

        $worker->save();

        return redirect()->route('workers.index')->with('message','Worker added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Worker $worker)
    {

        return view('workers.edit', compact('worker'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Worker $worker)
    {

        $request->validate([
            'shift'=>'required',
            'hours' => 'nullable',
            'price' => 'required|numeric'
        ]);


        $worker->shift = $request->shift;
        $worker->hours = $request->hours;
        $worker->price = $request->price;


        $worker->save();

        return redirect()->back()->with('message','Worker updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {

        $worker->delete();

        return redirect()->route('workers.index')->with('message', 'Worker deleted successfully');

    }
}
