<?php

namespace App\Rules;

use App\Models\Invoice;
use App\Models\Room;
use Illuminate\Contracts\Validation\Rule;

class RoomCapacity implements Rule
{
    private $semesterId;

    public function __construct($semesterId)
    {
        $this->semesterId = $semesterId;
    }

    public function passes($attribute, $value): bool
    {
        $room = Room::find($value);

        $tenantCount = Invoice::query()
            ->where('room_id', $value)
            ->where('semester_id', $this->semesterId)
            ->count();

        if ($room->capacity > $tenantCount) {
            return true;
        }

        return false;
    }

    public function message(): string
    {
        return 'The room should not exceeded limited capacity.';
    }
}
