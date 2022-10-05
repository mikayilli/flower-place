<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.colors.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Create";
        return view('admin.colors.add-edit', compact('pageTitle'));
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
            "name" => "required_without:id|max:30"
        ]);

        Color::updateOrcreate([
            "id" => $request->id
        ],[
            "name" => $request->name,
            "code" => $request->code,
            "rank" => 1,
            "status" => $request->status,
            "user_id" => $request->user()->id
        ]);

        return  redirect()->route("colors.index")->with("message", "Successfully Done!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        $pageTitle = "Update";
        return view('admin.colors.add-edit', compact('color','pageTitle'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->deleteOrFail();

        return response()->json(["message" => "deleted"], 200);
    }

    public function filter(Request $request)
    {
        return Color::when($request->name, fn($query) => $query->where("name", "LIKE", '%' .$request->name. '%'))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->with('user')
            ->paginate(20);
    }
}
