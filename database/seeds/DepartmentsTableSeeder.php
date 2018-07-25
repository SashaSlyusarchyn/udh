<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizations = \App\Organization::all();
        foreach ($organizations as $organization)
            for ($i = 0; $i < 10; $i++)
                $organization->departments()->create([
                    'name' => 'Department name '.$i,
                    'description' => 'Department description '.$i,
                    'active' => true
                ]);
    }
}
