<?php

namespace Database\Seeders;

use App\Models\CourseAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CourseAnswerSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            CourseAnswer::create([
                'uuid' => Str::uuid(),
                'answer' => 'answer' . $i,
            ]);
        }




        // CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer1',
            
            
        //    ]); 
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer2',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer3',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer4',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer5',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer6',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer7',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer8',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer9',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer10',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer11',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer12',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer13',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer14',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer15',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer16',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer17',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer18',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer19',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer20',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer21',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer22',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer23',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer24',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer25',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer26',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer27',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer28',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer29',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer30',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer31',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer32',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer33',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer34',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer35',
            
            
        //    ]);
        //    CourseAnswer::create([
        //     'uuid'=>Str::uuid(),

        //     'answer' => ' answer36',
            
            
        //    ]);


           
    }
}
