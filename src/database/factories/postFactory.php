<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class postFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        $titles = array(
            "昔の出来事",
            "パワースポット",
            "超能力物語",
            "梅干しの行方",
            "走る海"
        );

        return [
            "title" => $titles[rand(0,4)] . " version" . rand(1,3),
            "content" => $this->faker->realText()
        ];
    }
}