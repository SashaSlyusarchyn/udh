<?php

use Illuminate\Database\Seeder;

class UsersHasFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        $files = \App\File::all();
        foreach ($users as $user)
            $user->availableFiles()->attach([
                $files->random(1)->first()->id => ['id' => uniqid()],
                $files->random(1)->first()->id => ['id' => uniqid()],
                $files->random(1)->first()->id => ['id' => uniqid()],
            ]);
    }
}
