<?php

use Illuminate\Database\Seeder;

class SecretLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [
                'name' => 'T',
                'level' => 2,
                'active' => true
            ]
        ];
        foreach ($levels as $level)
            \App\SecretLevel::create($level);
    }
}
