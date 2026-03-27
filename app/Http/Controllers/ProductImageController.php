<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
   use App\Models\ProductImage;
class ProductImageController extends Controller
{


public function index()
{
    $images = ProductImage::all();
    return view('product_images.index', compact('images'));
}

public function create()
{
    return view('product_images.create');
}

public function store(Request $request)
{
    ProductImage::create($request->all());
    return redirect()->route('product-images.index');
}

public function show(string $id)
{
    $image = ProductImage::findOrFail($id);
    return view('product_images.show', compact('image'));
}

public function edit(string $id)
{
    $image = ProductImage::findOrFail($id);
    return view('product_images.edit', compact('image'));
}

public function update(Request $request, string $id)
{
    $image = ProductImage::findOrFail($id);
    $image->update($request->all());

    return redirect()->route('product-images.index');
}

public function destroy(string $id)
{
    ProductImage::destroy($id);
    return redirect()->route('product-images.index');
}
}
