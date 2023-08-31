<?php

namespace Database\Seeders;

use App\Models\CourseQuestion;
use App\Models\NationalQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str; 
// protected $fillable=['question','course_id','uuid'];


class NationalQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NationalQuestion::factory()->count(100)->create();
        // $courseQuestion1 = NationalQuestion::create([
        //     'uuid' => Str::uuid(),
        //     'question' => 'National question1',
        //     'date'=>'2/2/2020',

        //     'spacialization_id' => '1',
        //     'course_id' => '1'
        // ]);
        
        // $reference1 = $courseQuestion1->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference1'
        // ]);
        
        // $courseQuestion2 = NationalQuestion::create([
        //     'uuid' => Str::uuid(),
        //     'question' => 'National question2',
        //     'date'=>'2/2/2020',
        //     'spacialization_id' => '1',
        //     'course_id' => '1'

        // ]);
        
        // $reference2 = $courseQuestion2->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference2'
        // ]);
        
         
        // $courseQuestion3= NationalQuestion::create([
        //     'uuid'=>Str::uuid(),

        //     'question' => ' National question3',
        //     'date'=>'2/11/2020',
            
        //     'spacialization_id'=>'1',
        //     'course_id' => '1'

        //    ]);
        //    $reference3 = $courseQuestion3->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference3'
        // ]);






        // $courseQuestion12 = NationalQuestion::create([
        //     'uuid' => Str::uuid(),
        //     'question' => 'National question12',
        //     'date'=>'2/2/2019',

        //     'spacialization_id' => '2',
        //     'course_id' => '7'

        // ]);
        
        // $reference12 = $courseQuestion12->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference12'
        // ]);
        
        // $courseQuestion22 = NationalQuestion::create([
        //     'uuid' => Str::uuid(),
        //     'question' => 'National question22',
        //     'date'=>'2/2/2019',
        //     'spacialization_id' => '2',
        //     'course_id' => '7'

        // ]);
        
        // $reference22 = $courseQuestion22->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference22'
        // ]);
        
         
        // $courseQuestion32= NationalQuestion::create([
        //     'uuid'=>Str::uuid(),

        //     'question' => ' National question32',
        //     'date'=>'2/11/2020',
            
        //     'spacialization_id'=>'2',
        //     'course_id' => '8'

        //    ]);
        //    $reference32 = $courseQuestion32->reference()->create([
        //     'uuid'=>Str::uuid(),

        //     'reference' => 'reference32'
        // ]);
    }
}
