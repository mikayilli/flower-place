<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserStoreRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.add-edit', ["pageTitle" => "Create", 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request, UserService $service)
    {
        $service->createOrUpdate($request);
        return redirect()->route('users.index')->with("message", "Successfully done!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $pageTitle = "Update";
        $roles = Role::all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('admin.users.add-edit', compact('pageTitle', 'user', 'roles', 'userRole'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->deleteOrFail();

        return response()->json(["message" => "deleted"]);
    }

    public function filter(Request $request)
    {
        return UserService::filter($request);
    }
}
