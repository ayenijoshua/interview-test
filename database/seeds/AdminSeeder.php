<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 1)->states('is_admin')->create()->each(function ($user) {
            $user->roles()->attach(factory(Role::class)->states('admin_role')->create());
        });

        // factory(\App\User::class)->state('is_admin')->create([
        //     'first_name' => 'admin',
        //     'last_name'=>'admin',
        //     'email' => 'admin@mail.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     //'remember_token' => '123456',
        // ]);
    }

    
}
