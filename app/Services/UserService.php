<?php


namespace App\Services;


use App\Models\User;

class UserService
{
    public static function filter($request)
    {
        return User::when($request->name, fn($query) => $query->where("full_name", "LIKE", "%" . $request->name . "%"))
            ->when($request->phone, fn($query) => $query->where("phone", "LIKE", "%" . $request->phone . "%"))
            ->when($request->email, fn($query) => $query->where("email", "LIKE", "%" . $request->email . "%"))
            ->orderBy('id', "ASC")
            ->with('roles')
            ->paginate(20);
    }

    public function createOrUpdate($request)
    {
        $data = [];
        if ($request->hasFile('image')) {
            $request->file('image')->store("user", "public");
            $data['photo'] = $request->file('image')->hashName();
        }

        $user = User::updateOrCreate(['id' => $request->id], $request->all() + $data);
        $user->syncRoles($request->input('roles'));
    }

}
