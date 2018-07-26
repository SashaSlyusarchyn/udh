<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            OrganizationsTableSeeder::class,
            DepartmentsTableSeeder::class,
            RolesTableSeeder::class,
            SecretLevelsTableSeeder::class,
            UsersTableSeeder::class,
            FilesTableSeeder::class,
            UsersHasFilesTableSeeder::class,
        ]);
    }
}
