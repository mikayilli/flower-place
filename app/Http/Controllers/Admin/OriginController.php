<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Origin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OriginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.origins.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Create";
        return view('admin.origins.add-edit', compact('pageTitle'));
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

        Origin::updateOrcreate([
            "id" => $request->id
        ],[
            "name" => $request->name,
            "slug" => Str::slug($request->name),
            "status" => $request->status,
            "user_id" => $request->user()->id
        ]);

        return  redirect()->route("origins.index")->with("message", "Successfully Done!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function edit(Origin $origin)
    {
        $pageTitle = "Update";
        return view('admin.origins.add-edit', compact('origin','pageTitle'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Origin  $origin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Origin $origin)
    {
        $origin->deleteOrFail();

        return response()->json(["message" => "deleted"], 200);
    }

    public function filter(Request $request)
    {
        return Origin::when($request->name, fn($query) => $query->where("name", "LIKE", '%' .$request->name. '%'))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->with('user')
            ->paginate(20);
    }
}
