<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\Hostel;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Kaboda Sugwejo',
            'email' => 'sugwejos02@gmail.com',
            'password' => Hash::make('6569670a@A')
        ]);

        $hostel = Hostel::factory()->create();

        RoomType::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => 'Double', 'capacity' => 2, 'price' => 890000],
                ['name' => 'Triple', 'capacity' => 3, 'price' => 640000],
                ['name' => 'Fourfold', 'capacity' => 4, 'price' => 640000],
            ))
            ->has(
                Room::factory()
                    ->count(12)
                    ->state(new Sequence(
                        ['number' => 'G001', 'hostel_id' => $hostel->id, 'location' => 'Ground Floor'],
                        ['number' => 'G002', 'hostel_id' => $hostel->id, 'location' => 'Ground Floor'],
                        ['number' => 'G003', 'hostel_id' => $hostel->id, 'location' => 'Ground Floor'],

                        ['number' => 'A001', 'hostel_id' => $hostel->id, 'location' => '1st Floor'],
                        ['number' => 'A002', 'hostel_id' => $hostel->id, 'location' => '1st Floor'],
                        ['number' => 'A003', 'hostel_id' => $hostel->id, 'location' => '1st Floor'],

                        ['number' => 'B001', 'hostel_id' => $hostel->id, 'location' => '2st Floor'],
                        ['number' => 'B002', 'hostel_id' => $hostel->id, 'location' => '2st Floor'],
                        ['number' => 'B003', 'hostel_id' => $hostel->id, 'location' => '2st Floor'],

                        ['number' => 'C001', 'hostel_id' => $hostel->id, 'location' => '3st Floor'],
                        ['number' => 'C002', 'hostel_id' => $hostel->id, 'location' => '3st Floor'],
                        ['number' => 'C003', 'hostel_id' => $hostel->id, 'location' => '3st Floor']
                    ))
            )
            ->create();

        AcademicYear::factory()
            ->has(
                Semester::factory()
                    ->count(10)
                    ->sequence(function ($sequence) {
                        $number = $sequence->index + 1;

                        $number = sprintf('%02d', $number);

                        return ['name' => "Semester {$number}"];
                    })
            )
            ->create();

        Course::factory()->create();
    }
}
