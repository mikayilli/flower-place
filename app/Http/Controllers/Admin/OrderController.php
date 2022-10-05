<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function all()
    {
        return view('admin.orders.all');
    }

    public function view(Order $order)
    {
        return view('admin.orders.view', compact('order'));
    }

    public function filter(Request $request)
    {
        $isCustomerSelectable = $request->name || $request->phone || $request->email;
        return Order::select("orders.*")
            ->when($request->total, fn($query) => $query->where("total", "LIKE", '%' .$request->total. '%'))
            ->when($request->pay_type, fn($query) => $query->where("payment_type", "LIKE", '%' .$request->pay_type. '%'))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->when($isCustomerSelectable, function($query) use($request){
                $query->join("customers", "customers.id", "=", "orders.customer_id");
            })
            ->when($request->name, function($query) use($request){
                $query->where('customers.full_name', "LIKE", "%{$request->name}%");
            })
            ->when($request->phone, function($query) use($request){
                $query->where('customers.phone', "LIKE", "%{$request->phone}%");
            })
            ->when($request->email, function($query) use($request){
                $query->where('customers.email', "LIKE", "%{$request->email}%");
            })
            ->with('customer')
            ->paginate(20);
    }
}
