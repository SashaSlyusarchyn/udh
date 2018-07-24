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
                'name' => 'File_1.pdf',
                'hash' => md5('File_1.pdf')
            ],
            [
                'users_id' => $users->random(1)->first()->id,
                'name' => 'File_2.doc',
                'hash' => md5('File_2.doc')
            ],
            [
                'users_id' => $users->random(1)->first()->id,
                'name' => 'File_3.xls',
                'hash' => md5('File_3.xls')
            ],
        ];
    }
}
