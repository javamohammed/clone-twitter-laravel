<?php

namespace Database\Factories;

use App\Models\Hashtag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HashtagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hashtag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hashtags =array (0=>"#science",1=> "#earthquake",2=> "#yes", 3=> "#Hakim", 4 => "#islam");
        return [
            'hashtag' => $hashtags[$this->faker->numberBetween($min = 0, $max = 4)],
            'tweet_id' =>  $this->faker->numberBetween($min = 1, $max = 109)
        ];
    }
}
