<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use App\Models\ThingPrice;
use App\Models\ThingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

class ThingController extends Controller
{

    public function __construct( )
    {

        $this->middleware('permission:list-things|create-things|edit-things|delete-things', ['only' => ['index','show']]);
        $this->middleware('permission:create-things', ['only' => ['create','store']]);
        $this->middleware('permission:edit-things', ['only' => ['edit']]);
        $this->middleware('permission:delete-things', ['only' => ['destroy']]);

    }

    public function index()
    {

        $things = Thing::with('thing_services')->paginate(10);
//        dd($things);
        $thing_services = ThingService::all();
        return view('things.index', compact( 'things', 'thing_services'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $thing_services = ThingService::all();
        return view('things.create', compact( 'thing_services'));

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
//                'thing.*.thing_service_id' => 'required',
//                'thing.*.min_price' => 'nullable|numeric',
//                'thing.*.max_price' => 'nullable|numeric',
//            ]);

            $thing = new Thing();
            $thing->title = $request->title;
            $thing->save();

            $thing_services = $request->thing_services;

            $thingServiceData = [];

            foreach ($thing_services as $thing_service) {
                $thingServiceData[$thing_service['thing_service_id']] = [
                    'min_price' => $thing_service['min_price'],
                    'max_price' => $thing_service['max_price'],
                ];
            }

            $thing->thing_services()->attach($thingServiceData);

            DB::commit();

            return redirect()->route('things.index')->with('message', 'Price added successfully');
        } catch (\Exception $exception) {
            DB::rollBack();

            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Thing $thing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $thing = Thing::with('thing_services')->findOrFail($id);

        $thing_services = ThingService::all();

        return view('things.edit', compact('thing', 'thing_services'));

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
//                'thing.*.min_price' => 'nullable|numeric',
//                'thing.*.max_price' => 'nullable|numeric',
//            ]);

            $thing = Thing::findOrFail($id);
            $thing->title = $request->title;
            $thing->save();

            $thing_services = $request->thing_services;

            $thingServiceData = [];

            foreach ($thing_services as $thing_service) {
                $thingServiceData[$thing_service['thing_service_id']] = [
                    'min_price' => $thing_service['min_price'],
                    'max_price' => $thing_service['max_price'],
                ];
            }

            $thing->thing_services()->sync($thingServiceData);

            DB::commit();

            return redirect()->route('things.index')->with('message', 'Price updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception->getMessage();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thing $thing)
    {

        $thing->delete();
        return redirect()->route('things.index')->with('message', 'Price deleted successfully');

    }
}
