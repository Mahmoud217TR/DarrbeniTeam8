<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class CourseQuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseQuestion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $course = Course::inRandomOrder()->first();

        return [
            'uuid' => Str::uuid(),
            'question' => $this->faker->sentence,
            'course_id' => $course->id
        ];
    }

    /**
     * Indicate that the model's reference should be created.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withReference()
    {
        return $this->afterCreating(function (CourseQuestion $courseQuestion) {
            $courseQuestion->reference()->create([
                'uuid' => Str::uuid(),
                'reference' => $this->faker->sentence,
            ]);
        });
    }
}
