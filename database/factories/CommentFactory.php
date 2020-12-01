<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'comment_text' => $this->faker->sentence($nbWords = 8, $variableNbWords = true),
            'tweet_id' =>  $this->faker->numberBetween($min = 1, $max = 109) ,
            'user_id' => $this->faker->numberBetween($min = 1, $max = 500) ,
        ];
    }
}
