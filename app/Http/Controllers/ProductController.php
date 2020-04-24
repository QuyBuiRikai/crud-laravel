<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $search = $request->input('search');

        // $products = DB::table('products')->paginate(5);
        $products = Product::latest()
            ->paginate(5);

        // dd($products = Product::table('products')->paginate(5));
  
        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    public function search(Request $request, Product $products)
    {   
      
        $q = Product::query()
            ->name($request)
            ->detail($request);

        // ------------Query Ok-----------------
        // $q = Product::query();
        // if ($request->has('name')) {
        //     $q->where('name', 'LIKE', '%' . $request->name . '%');
        // }
        // if ($request->has('detail')) {
        //     $q->where('detail', 'LIKE', '%' . $request->detail . '%');
        // }
        // dd($q->get());
        $products = $q->orderBy('id')->paginate(5);

        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        Product::create($request->all());
   
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        $product->update($request->all());
  
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
  
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function deleteAll(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'detail' => 'required',
        // ]);
  
        // Product::create($request->all());
   
        // return redirect()->route('products.index')
        //                 ->with('success','Product created successfully.');
        $dbs = $request->get('ids');
        // $dbs = Product::latest()->whereIn('id', explode(',', $ids))->delete();
        $products = Product::table()->delete();
        // $product = DB::table('delete from products where id in ('.implode(",", $ids).')')->dd(); 
        // Product::delete($request->all());
        // $product->delete();
        // $products = Product::table('products')
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
