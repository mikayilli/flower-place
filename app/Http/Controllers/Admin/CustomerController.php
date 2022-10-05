<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Discount;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function all()
    {
        return view('admin.customers.all');
    }

    public function view(Customer $customer)
    {
        return view('admin.customers.view', compact('customer'));
    }

    public function filter(Request $request)
    {
        return Customer::when($request->name, fn($query) => $query->where("name", "LIKE", '%' .$request->name. '%'))
            ->when($request->email, fn($query) => $query->where("email", "LIKE", '%' .$request->email. '%'))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->paginate(20);
    }
}
