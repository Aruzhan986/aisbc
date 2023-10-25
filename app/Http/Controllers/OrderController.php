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

    public function create()
    {
        return view('orders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required|exists:clients,id',
            'dateBuy' => 'required|date',
        ]);

        Order::create($validated);
        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'client_id' => 'required|exists:clients,id',
            'dateBuy' => 'required|date',
        ]);

        $order->update($validated);
        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }
}
