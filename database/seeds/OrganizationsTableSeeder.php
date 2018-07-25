<?php

use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i++)
            \App\Organization::create([
                'name' => 'Organization name '.$i,
                'description' => 'Organization description',
                'active' => true,
            ]);
    }
}
