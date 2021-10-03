<?php

namespace App\Rules;

use App\Models\Invoice;
use Illuminate\Contracts\Validation\Rule;

class StudentHasRoom implements Rule
{
    private $semesterId;

    public function __construct($semesterId)
    {
        $this->semesterId = $semesterId;
    }

    public function passes($attribute, $value): bool
    {
        return Invoice::query()
            ->where('student_id', $value)
            ->where('semester_id', $this->semesterId)
            ->doesntExist();
    }

    public function message()
    {
        return 'Student already has a room';
    }
}
