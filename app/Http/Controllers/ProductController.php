<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct( )
    {

        $this->middleware('permission:list-products|create-products|edit-products|delete-products', ['only' => ['index','show']]);
        $this->middleware('permission:create-products', ['only' => ['create','store']]);
        $this->middleware('permission:edit-products', ['only' => ['edit']]);
        $this->middleware('permission:delete-products', ['only' => ['destroy']]);

    }

    public function index()
    {

        $products = Product::paginate(10);
        return view('products.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title'=>'required',
        ]);



        $product = new Product();

        $product->title = $request->title;

        $product->save();

        return redirect()->route('products.index')->with('message','Product added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        return view('products.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'title'=>'required',
        ]);


        $product->title = $request->title;


        $product->save();

        return redirect()->back()->with('message','Product updated successfully');

    }

    /**
     * Remove the specified resource title storage.
     */
    public function destroy(Product $product)
    {

        $product->delete();

        return redirect()->route('products.index')->with('message', 'Product deleted successfully');

    }
}
