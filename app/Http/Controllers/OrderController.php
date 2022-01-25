<?php

namespace App\Http\Controllers;

use App\Notifications\OrderShipmentNotification;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        //request()->session()->flash('success','Saved succesfully!');
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    // order_placed, prep, make, quality_check, out for delivery
    public function ship(Request $request)
    {
        $order = Order::findOrFail($request->order);
        $order->status = Order::ORDER_PLACED;
        $order->buyer()->associate(auth()->user());
        $order->update();

        // ProcessOrderShipped::dispatch(new OrderShipped($order))
        //     ->onQueue('order-shipped');
        //event(new OrderUpdated($order));
        //event(new OrderShipment($order->food));

        if (is_null($order->food))
        {
            $request->session()->flash('error','No existe el plato para dicha orden');
            return view('orders.index', compact('orders'));
        }
        $order->food->notify((new OrderShipmentNotification())->onQueue('broadcasts'));
        return redirect()->route('orders.index');
    }
}
