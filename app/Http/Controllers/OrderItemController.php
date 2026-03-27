<?php

namespace App\Http\Controllers;

 use App\Models\OrderItem;
use Illuminate\Http\Request;
class OrderItemController extends Controller
{
  

public function store(Request $request)
{
    OrderItem::create($request->all());
    return redirect()->back();
}

public function update(Request $request, string $id)
{
    $item = OrderItem::findOrFail($id);
    $item->update($request->all());

    return redirect()->back();
}

public function destroy(string $id)
{
    OrderItem::destroy($id);
    return redirect()->back();
}
}
