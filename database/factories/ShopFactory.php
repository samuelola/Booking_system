<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $suffix = [
        'Villa',
        'House',
        'Cottage',
        'Luxury Villa',
        'Cheap House',
        'Rooms',
        'Luxury Rooms',
        'Fancy Rooms',
    ];
        return [
            "title" => Arr::random($suffix),
            'description'=> fake()->text(),
            "image"    => "https://www.w3schools.com/html/pic_trulli.jpg",
            "price"    => random_int(150,500),
            "uuid"     => Str::uuid(),

        ];
    }
}
