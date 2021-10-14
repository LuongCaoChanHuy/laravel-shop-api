<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;
use File;
use Storage;
// use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ProductResource::collection(Product::paginate(20));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return ProductResource::collection(Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 'title'
        // 'description'
        // 'price'
        // 'ratings'
        // 'reviews'
        // 'isAddedToCart'
        // 'isAddedBtn'
        // 'isFavourite'
        // 'quantity'
        // 'store'
        // 'image'
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->store = $request->store;
        if($request->image){
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $name = time().'_'.$image->getClientOriginalName();
            Storage::disk('public')->put($name,File::get($image));
            $product->image = $name;
        }else{
            $product->image = 'default.jpg';
        }
        if ($request->author_id == -1) {
            $author = new Author();
            $author->name = $request->author_name;
            $author->status = 1;
            $author->save();
            $product->author_id = $author->id;
        } else {
            $author = Author::find($request->author_id);
            $product->author_id = $author->id;
        }
        $product->category_id = $request->category_id;
        $product->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->store = $request->store;
        if($request->image){
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $name = time().'_'.$image->getClientOriginalName();
            Storage::disk('public')->put($name,File::get($image));
            $product->image = $name;
        }else{
            $product->image = 'default.jpg';
        }
        if ($request->author_id == -1) {
            $author = new Author();
            $author->name = $request->author_name;
            $author->status = 1;
            $author->save();
            $product->author_id = $author->id;
        } else {
            $author = Author::find($request->author_id);
            $product->author_id = $author->id;
        }
        $product->category_id = $request->category_id;
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
    }

    public function topProducts()
    {
        return ProductResource::collection(Product::orderBy('created_at','asc')->limit(4)->get());
    }
}
