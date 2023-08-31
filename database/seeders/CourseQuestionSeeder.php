<?php

namespace Database\Seeders;

use App\Models\CourseQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 
// protected $fillable=['question','course_id','uuid'];


class CourseQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        CourseQuestion::factory()->count(100)->withReference()->create();
        // $courseQuestion1 = CourseQuestion::create([
        //     'uuid' => Str::uuid(),
        //     'question' => 'question1',
        //     'course_id' => '1'
        // ]);
        
        // $reference1 = $courseQuestion1->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference1'
        // ]);
        
        // $courseQuestion2 = CourseQuestion::create([
        //     'uuid' => Str::uuid(),
        //     'question' => 'question2',
        //     'course_id' => '1'
        // ]);
        
        // $reference2 = $courseQuestion2->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference2'
        // ]);
        
         
        // $courseQuestion3= CourseQuestion::create([
        //     'uuid'=>Str::uuid(),

        //     'question' => ' question3',
            
        //     'course_id'=>'1'
        //    ]);
        //    $reference3 = $courseQuestion3->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference3'
        // ]);
        //    $courseQuestion4=   CourseQuestion::create([
        //     'uuid'=>Str::uuid(),

        //     'question' => ' question4S',
            
        //     'course_id'=>'2'
        //    ]);
        //    $reference4 = $courseQuestion4->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference4'
        // ]);
        //    $courseQuestion5=CourseQuestion::create([
        //     'uuid'=>Str::uuid(),

        //     'question' => ' question5',
            
        //     'course_id'=>'2'
        //    ]);
        //    $reference5 = $courseQuestion5->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference5'
        // ]);
        //    $courseQuestion6=   CourseQuestion::create([
        //     'uuid'=>Str::uuid(),

        //     'question' => ' question6',
            
        //     'course_id'=>'2'
        //    ]);
        //    $reference6 = $courseQuestion6->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference6'
        // ]);
        //    $courseQuestion7=  CourseQuestion::create([
        //     'uuid'=>Str::uuid(),

        //     'question' => ' question7',
            
        //     'course_id'=>'10'
        //    ]);  
        //    $reference7 = $courseQuestion7->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference7'
        // ]);
        //    $courseQuestion8=   CourseQuestion::create([
        //     'uuid'=>Str::uuid(),

        //     'question' => ' question8',
            
        //     'course_id'=>'10'
        //    ]); 
        //    $reference8 = $courseQuestion8->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference8'
        // ]);
        //    $courseQuestion9=     CourseQuestion::create([
        //     'uuid'=>Str::uuid(),

        //     'question' => ' question9',
            
        //     'course_id'=>'10'
        //    ]);
        //    $reference9 = $courseQuestion9->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference9'
        // ]);
 
           
    }
}
