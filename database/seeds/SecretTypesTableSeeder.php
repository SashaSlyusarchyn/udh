<?php

use Illuminate\Database\Seeder;

class SecretTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $secretTypes = [
            [
                'name' => 'Т',
                'type' => 't',
                'active' => true
            ],
            [
                'name' => 'ЦТ',
                'type' => 'ct',
                'active' => true
            ],
            [
                'name' => 'Публічні',
                'type' => 'public',
                'active' => true
            ],
            [
                'name' => 'Службові',
                'type' => 'private',
                'active' => true
            ]
        ];

        foreach ($secretTypes as $secretType)
            \App\SecretType::create($secretType);
    }
}
