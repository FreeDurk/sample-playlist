<?php

namespace Database\Factories;
use App\Models\Song;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SongFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
	protected $model = Song::class;

    public function definition()
    {
        return [
            'url' => 'https://source.unsplash.com/random',
            'title' => $this->faker->word(),
            'duration' => $this->faker->numberBetween(1,5).':'.$this->faker->numberBetween(1,60),
            'artist_name' => $this->faker->name()
        ];
    }
}
