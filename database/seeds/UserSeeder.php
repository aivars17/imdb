<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $user = new User();
        $user->name = 'Aivaras';
        $user->email = 'amalosevskis@gmail.com';
        $user->password = bcrypt('slaptas');
        $user->role = 'admin';
        $user->save();



    }
}
