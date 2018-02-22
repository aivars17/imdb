<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class users_table extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'User')->first();
        $role_author = Role::where('name', 'Author')->first();
        $role_admin = Role::where('name', 'Admin')->first();

        $user = new User();
        $user->name = 'Bambukass';
        $user->email = 'bams@smik.com';
        $user->password = bcrypt('slaptas');
        $user->role = 'svecias';
        $user->save();
        $user->roles()->attach($role_user);

        $userau = new User();
        $userau->name = 'Rasytojass';
        $userau->email = 'rasytojass@smik.com';
        $userau->password = bcrypt('slaptas');
        $userau->role = 'svecias';
        $userau->save();
        $userau->roles()->attach($role_author);

        $userad = new User();
        $userad->name = 'Adminass';
        $userad->email = 'adminass@smik.com';
        $userad->password = bcrypt('slaptas');
        $userad->role = 'svecias';
        $userad->save();
        $userad->roles()->attach($role_admin);
    }
}
