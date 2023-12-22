<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function __construct( )
    {

        $this->middleware('permission:list-transports|create-transports|edit-transports|delete-transports', ['only' => ['index','show']]);
        $this->middleware('permission:create-transports', ['only' => ['create','store']]);
        $this->middleware('permission:edit-transports', ['only' => ['edit']]);
        $this->middleware('permission:delete-transports', ['only' => ['destroy']]);

    }
    public function index()
    {

        $transports = Transport::paginate(10);
        return view('transports.index', compact('transports'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required',
        ]);



        $transport = new Transport();

        $transport->title = $request->title;

        $transport->save();

        return redirect()->route('transports.index')->with('message','Transport added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Transport $transport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transport $transport)
    {

        return view('transports.edit', compact('transport'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transport $transport)
    {

        $request->validate([
            'title'=>'required',
        ]);


        $transport->title = $request->title;


        $transport->save();

        return redirect()->back()->with('message','Transport updated successfully');

    }

    /**
     * Remove the specified resource title storage.
     */
    public function destroy(Transport $transport)
    {

        $transport->delete();

        return redirect()->route('transports.index')->with('message', 'Transport deleted successfully');

    }
}
