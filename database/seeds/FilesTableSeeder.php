<?php

use Illuminate\Database\Seeder;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::all();
        foreach ($users as $user)
            for ($i = 0; $i < 30; $i++)
                $user->ownFiles()->create([
                    'original_name' => 'File_'.$i.'.pdf',
                    'hash_name' => md5('File_'.$i.'.pdf'),
                    'active' => true
                ]);
    }
}
