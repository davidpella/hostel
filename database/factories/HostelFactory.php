<?php

namespace Database\Factories;

use App\Models\Hostel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostelFactory extends Factory
{
    protected $model = Hostel::class;

    public function definition(): array
    {
        return [
            'name' => 'HKMU Main Campus Hostel',
            'type' => 'in campus',
            'has_floors' => true,
            'floor_count' => 4,
        ];
    }
}
