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
        $organizations = [
            [
                'name' => 'Organization 1'
            ],
            [
                'name' => 'Organization 2'
            ],
            [
                'name' => 'Organization 3'
            ],
        ];
        foreach ($organizations as $organization)
            \App\Organization::create($organization);
    }
}
