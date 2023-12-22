<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function __construct( )

    {

        $this->middleware('permission:list-addresses|create-addresses|edit-addresses|delete-addresses', ['only' => ['index','show']]);
        $this->middleware('permission:create-addresses', ['only' => ['create','store']]);
        $this->middleware('permission:edit-addresses', ['only' => ['edit']]);
        $this->middleware('permission:delete-addresses', ['only' => ['destroy']]);

    }
    public function index($id)
    {
        $addresses = Address::where('region_id', $id)->paginate(10);
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('addresses.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required',
        ]);

        $address = new Address();

        $address->title = $request->title;
        $address->region_id = $request->region_id;

        $address->save();

        return redirect()->back()->with('message','Address added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {

        return view('addresses.edit', compact('address'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {

        $request->validate([
            'title'=>'required',
        ]);


        $address->title = $request->title;

        $address->save();

        return redirect()->back()->with('message','Address updated successfully');

    }

    /**
     * Remove the specified resource title storage.
     */
    public function destroy(Address $address)
    {

        $address->delete();

        return redirect()->route('addresses.index')->with('message', 'Address deleted successfully');

    }
}
