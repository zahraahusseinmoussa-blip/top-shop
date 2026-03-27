<?php

namespace App\Http\Controllers;

   use App\Models\ProductSize;
use Illuminate\Http\Request;
class ProductSizeController extends Controller
{


public function index()
{
    $sizes = ProductSize::all();
    return view('product_sizes.index', compact('sizes'));
}

public function store(Request $request)
{
    ProductSize::create($request->all());
    return redirect()->back();
}

public function update(Request $request, string $id)
{
    $size = ProductSize::findOrFail($id);
    $size->update($request->all());

    return redirect()->back();
}

public function destroy(string $id)
{
    ProductSize::destroy($id);
    return redirect()->back();
}
}
