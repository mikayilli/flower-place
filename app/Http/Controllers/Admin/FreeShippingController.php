<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreeShipping;
use Illuminate\Http\Request;

class FreeShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.freeShipping.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Create";
        return view('admin.freeShipping.add-edit', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "min_amount" => "required",
            "limit" => "required",
            "status" => "required",
        ]);

        FreeShipping::updateOrcreate([
            "id" => $request->id
        ],[
            "user_id" => $request->user()->id,
            "name" => $request->name,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "min_amount" => $request->min_amount,
            "limit" => $request->limit,
            "status" => $request->status,
        ]);

        return  redirect()->route("free-shipping.index")->with("message", "Successfully Done!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FreeShipping  $freeShipping
     * @return \Illuminate\Http\Response
     */
    public function edit(FreeShipping $freeShipping)
    {
        $pageTitle = "Update";
        return view('admin.freeShipping.add-edit', compact('freeShipping','pageTitle'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FreeShipping  $freeShipping
     * @return \Illuminate\Http\Response
     */
    public function destroy(FreeShipping $freeShipping)
    {
        $freeShipping->deleteOrFail();

        return response()->json(["message" => "deleted"], 200);
    }

    public function filter(Request $request)
    {
        return FreeShipping::when($request->name, fn($query) => $query->where("name", "LIKE", '%' .$request->name. '%'))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->with('user')
            ->paginate(20);
    }
}
