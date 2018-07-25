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
        $organizations = \App\Organization::all();
        $roles = \App\Role::all();
        $users = [
            [
                'organizations_id' => $organizations->random(1)->first()->id,
                'name' => 'User_1',
                'email' => 'user1@udh.loc',
                'password' => bcrypt('password')
            ],
            [
                'organizations_id' => $organizations->random(1)->first()->id,
                'name' => 'User_2',
                'email' => 'user2@udh.loc',
                'password' => bcrypt('password')
            ],
            [
                'organizations_id' => $organizations->random(1)->first()->id,
                'name' => 'User_3',
                'email' => 'user3@udh.loc',
                'password' => bcrypt('password')
            ]
        ];
        foreach ($users as $user) {
            $newUser = \App\User::create($user);
            $newUser->roles()->attach([$roles->random(1)->first()->id => ['id' => uniqid()]]);
        }
    }
}
