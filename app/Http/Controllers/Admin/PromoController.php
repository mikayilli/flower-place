<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.promo.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Create";
        return view('admin.promo.add-edit', compact('pageTitle'));
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
            "type" => "required|in:percent,fix",
            "percent" => "required_if:type,percent|integer|min:0|max:100",
            "fix_amount" => "required_if:type,fix|numeric",
            "min_amount" => "required",
            "max_amount" => "required_if:type,percent|numeric",
            "code" => "required",
            "start_date" => "required",
            "end_date" => "required",
            "quantity" => "required",
            "status" => "required"
        ]);

        Promo::updateOrcreate([
            "id" => $request->id
        ],[
            "user_id" => $request->user()->id,
            "code" => $request->code,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
            "percent" => $request->percent,
            "quantity" => $request->quantity,
            "fix_amount" => $request->fix_amount,
            "type" => $request->type,
            "min_amount" => $request->min_amount,
            "max_amount" => $request->max_amount,
            "current_quantity" => $request->quantity, //should take value of quantity as a default
            "status" => $request->status,
        ]);

        return  redirect()->route("promos.index")->with("message", "Successfully Done!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function edit(Promo $promo)
    {
        $pageTitle = "Update";
        return view('admin.promo.add-edit', compact('promo','pageTitle'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promo  $promo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promo $promo)
    {
        $promo->deleteOrFail();

        return response()->json(["message" => "deleted"], 200);
    }

    public function filter(Request $request)
    {
        return Promo::when($request->code, fn($query) => $query->where("code", "LIKE", '%' .$request->code. '%'))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->with('user')
            ->paginate(20);
    }
}
