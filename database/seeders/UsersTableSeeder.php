<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole= Role::where('name', 'admin')->first();
        $userRole= Role::where('name', 'user')->first();

        $admin = User::create([
            'emp_id' => '2018123456',
            'name' => 'admin',
            'lname' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678')
        ]);

        $user = User::create([
            'emp_id' => '2018123654',
            'name' => 'Jomilen',
            'lname' => 'Dela Torre',
            'email' => 'user@mail.com',
            'password' => Hash::make('12345678')
        ]);

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
    }
}
