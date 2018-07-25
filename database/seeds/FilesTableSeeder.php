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
        $files = [
            [
                'users_id' => $users->random(1)->first()->id,
                'original_name' => 'File_1.pdf',
                'hash_name' => md5('File_1.pdf')
            ],
            [
                'users_id' => $users->random(1)->first()->id,
                'original_name' => 'File_2.doc',
                'hash_name' => md5('File_2.doc')
            ],
            [
                'users_id' => $users->random(1)->first()->id,
                'original_name' => 'File_3.xls',
                'hash_name' => md5('File_3.xls')
            ],
        ];
        foreach ($files as $file)
            \App\File::create($file);
    }
}
