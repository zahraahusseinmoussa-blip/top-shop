<?php

namespace App\Http\Controllers;

   use App\Models\Order;
use Illuminate\Http\Request;
class OrderController extends Controller
{


public function index()
{
    $orders = Order::all();
    return view('orders.index', compact('orders'));
}

public function show(string $id)
{
    $order = Order::findOrFail($id);
    return view('orders.show', compact('order'));
}

public function store(Request $request)
{
    Order::create($request->all());
    return redirect()->route('orders.index');
}

public function update(Request $request, string $id)
{
    $order = Order::findOrFail($id);
    $order->update($request->all());

    return redirect()->route('orders.index');
}

public function destroy(string $id)
{
    Order::destroy($id);
    return redirect()->route('orders.index');
}
}
