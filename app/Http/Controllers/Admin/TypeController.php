<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.types.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Create";
        return view('admin.types.add-edit', compact('pageTitle'));
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

        Type::updateOrcreate([
            "id" => $request->id
        ],[
            "name" => $request->name,
            "description" => $request->description,
            "status" => $request->status,
            "user_id" => $request->user()->id
        ]);

        return  redirect()->route("types.index")->with("message", "Successfully Done!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        $pageTitle = "Update";
        return view('admin.types.add-edit', compact('type','pageTitle'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->deleteOrFail();

        return response()->json(["message" => "deleted"], 200);
    }

    public function filter(Request $request)
    {
        return Type::when($request->name, fn($query) => $query->where("name", "LIKE", '%' .$request->name. '%'))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->with('user')
            ->paginate(20);
    }
}
