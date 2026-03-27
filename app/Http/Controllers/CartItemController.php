<?php

namespace App\Http\Controllers;

   use App\Models\CartItem;
use Illuminate\Http\Request;
class CartItemController extends Controller
{


public function index()
{
    $items = CartItem::all();
    return view('cart_items.index', compact('items'));
}

public function store(Request $request)
{
    CartItem::create($request->all());
    return redirect()->back();
}

public function update(Request $request, string $id)
{
    $item = CartItem::findOrFail($id);
    $item->update($request->all());

    return redirect()->back();
}

public function destroy(string $id)
{
    CartItem::destroy($id);
    return redirect()->back();
}
}
