<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;

class OrderController extends Controller
{
    public function getOrders()
    {
        $orders = Order::addSelect(['names' => User::select('names')
            ->whereColumn('id', 'orders.userId')
            ->orderBy('id', 'desc')
            ->limit(1)])
            ->addSelect(['phone' => User::select('phone')
                ->whereColumn('id', 'orders.userId')
                ->orderBy('id', 'desc')
                ->limit(1)])
            ->addSelect(['email' => User::select('email')
                ->whereColumn('id', 'orders.userId')
                ->orderBy('id', 'desc')
                ->limit(1)])->get();
        return response()->json($orders);
    }
    public function getMyOrders()
    {
        $userId = auth()->user()->id;
        $orders = Order::where('userId', $userId)
            ->addSelect(['names' => User::select('names')
                ->whereColumn('id', 'orders.userId')
                ->orderBy('id', 'desc')
                ->limit(1)])
            ->addSelect(['phone' => User::select('phone')
                ->whereColumn('id', 'orders.userId')
                ->orderBy('id', 'desc')
                ->limit(1)])
            ->addSelect(['email' => User::select('email')
                ->whereColumn('id', 'orders.userId')
                ->orderBy('id', 'desc')
                ->limit(1)])->get();
        return response()->json($orders);
    }
    public function getProductOrders()
    {
        $userId = auth()->user()->id;
        $orders = DB::table('order_details')
            ->join('products', 'products.id', '=', 'order_details.productId')
            ->join('orders', 'orders.id', '=', 'order_details.orderId')
            ->select('order_details.*', 'products.name as product', 'orders.refNo')
            ->where('products.added_by', '=', $userId)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json($orders);
    }
    public function getOrderDetails()
    {
        $details = OrderDetail::addSelect(['product' => Product::select('name')->whereColumn('productId', 'products.id')
            ->orderBy('id', 'desc')
            ->limit(1)])->get();
        return response()->json($details);
    }
    public function artistConfirmation(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'isConfirmed' => 'required|min:3|string'
        ]);
        $order = OrderDetail::find($request->id);
        try {
            $order->isConfirmed = $request->isConfirmed;
            $order->save();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
        $orders = $this->getProductOrders();
        return $orders;
    }
    public function orderCompletion(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'orderCompleted' => 'required|min:3|string'
        ]);
        $order = Order::find($request->id);
        try {
            $order->orderCompleted = $request->orderCompleted;
            $order->save();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
        return response()->json($order);
    }
}
