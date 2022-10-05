<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.stores.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Create";
        $managers = User::all();
        return view('admin.stores.add-edit', compact('pageTitle', 'managers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "manager_id" => "required",
            "name" => "required|max:30",
            "address" => "required",
            "phone" => "required",
            "email" => "nullable",
            "status" => "required"
        ]);

        Store::updateOrcreate([
            "id" => $request->id
        ], [
            "manager_id" => $request->manager_id,
            "name" => $request->name,
            "slug" => Str::slug($request->name . $request->address),
            "status" => $request->status,
            "address" => $request->address,
            "phone" => $request->phone,
            "email" => $request->email,
            "user_id" => $request->user()->id
        ]);

        return redirect()->route("stores.index")->with("message", "Successfully Done!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Store $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $pageTitle = "Update";
        $managers = User::all();
        return view('admin.stores.add-edit', compact('store', 'pageTitle', 'managers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Store $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->deleteOrFail();

        return response()->json(["message" => "deleted"], 200);
    }

    public function filter(Request $request)
    {
        return Store::when($request->name, fn($query) => $query->where("name", "LIKE", '%' . $request->name . '%'))
            ->when($request->filled('phone'), fn($query) => $query->where("phone", "LIKE", '%' . $request->phone . '%'))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->with('manager')
            ->paginate(20);
    }
}
