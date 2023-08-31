<?php

namespace Database\Seeders;

use App\Models\CourseAnswerQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 
// protected $fillable=['course_answer_id','course_question_id','status','uuid'];

class CourseAnswerQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionsCount = 100;
     


        $questionsCount = 100;
        $answersPerQuestion = 4;

        for ($question = 1; $question <= $questionsCount; $question++) {
            $statuses = [0, 0, 0, 1]; // Array of statuses, with one '1' for the correct answer
            shuffle($statuses); // Randomly shuffle the statuses array

            for ($i = 1; $i <= $answersPerQuestion; $i++) {
                CourseAnswerQuestion::create([
                    'uuid' => Str::uuid(),
                    'course_question_id' => $question,
                    'course_answer_id' => $question ,
                    'status' => $statuses[$i - 1] // Use the shuffled statuses array
                ]);
            }
        }








        // CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'1',

        //     'course_answer_id' =>  '1', 
        //     'status'=>'1',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'1',

        //     'course_answer_id' =>  '2', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'1',

        //     'course_answer_id' =>  '3', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'1',

        //     'course_answer_id' =>  '4', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'2',

        //     'course_answer_id' =>  '5', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'2',

        //     'course_answer_id' =>  '6', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'2',

        //     'course_answer_id' =>  '7', 
        //     'status'=>'1',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'2',

        //     'course_answer_id' =>  '8', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'3',

        //     'course_answer_id' =>  '9', 
        //     'status'=>'1',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'3',

        //     'course_answer_id' =>  '10', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'3',

        //     'course_answer_id' =>  '11', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'3',

        //     'course_answer_id' =>  '12', 
        //     'status'=>'0',
            
           
        //    ]); 
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'4',

        //     'course_answer_id' =>  '13', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'4',

        //     'course_answer_id' =>  '14', 
        //     'status'=>'1',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'4',

        //     'course_answer_id' =>  '15', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'4',

        //     'course_answer_id' =>  '16', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'5',

        //     'course_answer_id' =>  '17', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'5',

        //     'course_answer_id' =>  '18', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'5',

        //     'course_answer_id' =>  '19', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'5',

        //     'course_answer_id' =>  '20', 
        //     'status'=>'1',
            
           
        //    ]); 
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'6',

        //     'course_answer_id' =>  '21', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'6',

        //     'course_answer_id' =>  '22', 
        //     'status'=>'1',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'6',

        //     'course_answer_id' =>  '23', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'6',

        //     'course_answer_id' =>  '24', 
        //     'status'=>'0',
            
           
        //    ]);  
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'7',

        //     'course_answer_id' =>  '25', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'7',

        //     'course_answer_id' =>  '26', 
        //     'status'=>'1',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'7',

        //     'course_answer_id' =>  '27', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'7',

        //     'course_answer_id' =>  '28', 
        //     'status'=>'0',
            
           
        //    ]);




        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'8',

        //     'course_answer_id' =>  '29', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'8',

        //     'course_answer_id' =>  '30', 
        //     'status'=>'1',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'8',

        //     'course_answer_id' =>  '31', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'8',

        //     'course_answer_id' =>  '32', 
        //     'status'=>'0',
            
           
        //    ]); 




        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'9',

        //     'course_answer_id' =>  '33', 
        //     'status'=>'1',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'9',

        //     'course_answer_id' =>  '34', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'9',

        //     'course_answer_id' =>  '35', 
        //     'status'=>'0',
            
           
        //    ]);
        //    CourseAnswerQuestion::create([
        //     'uuid'=>Str::uuid(), 
        //     'course_question_id'=>'9',

        //     'course_answer_id' =>  '36', 
        //     'status'=>'0',
            
           
        //    ]);















    }
}
