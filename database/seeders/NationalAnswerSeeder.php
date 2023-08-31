<?php

namespace Database\Seeders;

use App\Models\NationalAnswer;
use Database\Factories\NationalAnswerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class NationalAnswerSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = \Faker\Factory::create();

        // Loop through each question
        $questionsCount = 100;
        $answersPerQuestion = 4;

        for ($questionId = 1; $questionId <= $questionsCount; $questionId++) {
            $statuses = [1, 0, 0, 0]; // Array of statuses, with one '1' for the correct answer
            shuffle($statuses); // Randomly shuffle the statuses array

            for ($i = 1; $i <= $answersPerQuestion; $i++) {
                NationalAnswer::create([
                    'uuid' => Str::uuid(),
                    'answer' => $faker->sentence, // Replace this with your logic to generate answers
                    'status' => $statuses[$i - 1], // Use the shuffled statuses array
                    'national_question_id' => $questionId
                ]);
            }
        }
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer1',
        //     'status' => '1',
        //     'national_question_id' => '1'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer2',
        //     'status'=>'0',
        //     'national_question_id' => '1'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer3',
        //     'status'=>'0',
        //     'national_question_id' => '1'
        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer4',
        //     'status'=>'0',
        //     'national_question_id' => '1'
        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer5',
        //     'status'=>'0',
        //     'national_question_id' => '2'
        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer6',
        //     'status' => '1',
        //     'national_question_id' => '2'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer7',
        //     'status'=>'0',
        //     'national_question_id' => '2'
        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer8',
        //     'status'=>'0',
        //     'national_question_id' => '2'
        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer9',
        //     'status'=>'0',
        //     'national_question_id' => '3'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer10',
        //     'status' => '0',
        //     'national_question_id' => '3'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer11',
        //     'status' => '1',
        //     'national_question_id' => '3'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer12',
        //     'status' => '0',
        //     'national_question_id' => '3'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer13',
        //     'status' => '1',
        //     'national_question_id' => '4'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer14',
        //     'status' => '0',
        //     'national_question_id' => '4'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer15',
        //     'status' => '0',
        //     'national_question_id' => '4'


        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer16',
        //     'status' => '0',
        //     'national_question_id' => '4'


        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer17',
        //     'status' => '0',
        //     'national_question_id' => '5'


        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer18',
        //     'status' => '0',
        //     'national_question_id' => '5'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer19',
        //     'status' => '0',
        //     'national_question_id' => '5'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer20',
        //     'status' => '1',
        //     'national_question_id' => '5'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer21',
        //     'status' => '0',
        //     'national_question_id' => '6'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer22',
        //     'status' => '0',
        //     'national_question_id' => '6'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer23',
        //     'status' => '0',
        //     'national_question_id' => '6'

        // ]);
        // NationalAnswer::create([
        //     'uuid' => Str::uuid(),

        //     'answer' => ' answer24',
        //     'status' => '1',
        //     'national_question_id' => '6'

        // ]);
      
        }
}
