<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Null_;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'full_name' => 'Flower Place',
            'photo' => 'fake.webp',
            'email' => 'flowerplace@gmail.com',
            'phone' => '79999990397',
            'email_verified_at' => now(),
            'password' => 'flwrplc1414!@#$',
            'status' => 1,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

    }
}
