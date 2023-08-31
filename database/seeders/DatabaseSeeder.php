<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CategorySeeder::class,
            CollageSeeder::class,
           SpecializationSeeder::class,
           UserSeeder::class,
           RoleSeeder::class,
           RoleUserSeeder::class,
           CodeSeeder::class,
           CourseSeeder::class,
           CourseAnswerSeeder::class,
           CourseQuestionSeeder::class,
           CourseAnswerQuestionSeeder::class,
          NationalQuestionSeeder::class,
          NationalAnswerSeeder::class,
          AboutUsSeeder::class,

          
        ]);
    }
}
