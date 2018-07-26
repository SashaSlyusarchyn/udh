<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = \App\Department::all();
        $roles = \App\Role::all();
        $secret_levels = \App\SecretLevel::all();
        for ($i = 0; $i < 100; $i++) {
            $newUser = \App\User::create([
                'departments_id' => $departments->random(1)->first()->id,
                'secret_levels_id' => $secret_levels->first()->id,
                'name' => 'User_'.$i,
                'email' => 'user'.$i.'@udh.loc',
                'password' => bcrypt('password'),
                'active' => true
            ]);
            $newUser->roles()->attach([$roles->random(1)->first()->id => ['id' => uniqid()]]);
        }
    }
}
