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
        $secret_levels = \App\SecretLevel::all();
        foreach ($users as $user)
            for ($i = 0; $i < 30; $i++)
                $user->ownFiles()->create([
                    'secret_levels_id' => $secret_levels->first()->id,
                    'original_name' => 'File_'.$i.'.pdf',
                    'hash_name' => md5('File_'.$i.'.pdf'),
                    'active' => true
                ]);
    }
}
