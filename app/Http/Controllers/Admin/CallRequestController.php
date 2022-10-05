<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallRequest;
use Illuminate\Http\Request;

class CallRequestController extends Controller
{

    public function all()
    {
        return view('admin.callRequest.all');
    }

    public function callRequestFilter(Request $request)
    {
        return CallRequest::when($request->name, fn($query) => $query->where("call_full_name", "LIKE", "%" . $request->name . "%"))
            ->when($request->phone, fn($query) => $query->where("call_phone", "LIKE", "%" . $request->phone . "%"))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->when($request->filled('wp'), fn($query) => $query->where("wp", $request->wp))
            ->orderBy('id', "ASC")
            ->paginate(20);
    }
}
