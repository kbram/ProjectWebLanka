<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        $user = User ::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'contact_number' => '(076) - 7000 - 249',
            'home_address' => "Colombo, Sri Lanka.",
            'password' => Hash::make('password'),
        ]);
      
    }
}
