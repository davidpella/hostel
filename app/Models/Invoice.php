<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperInvoice
 */
class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function scopeSearch(Builder $builder, $query)
    {
        collect(explode(' ', $query))
            ->map(function($token){
                return $token;
            })
            ->each(function($token) use ($builder){
                $builder->where("amount", "LIKE", "%{$token}%")
                    ->orWhereRelation('room', 'number', "LIKE", "%{$token}%");
            });
    }

    public function scopeWithRoomNumber(Builder $builder)
    {
        $builder->addSelect(['room_number' => Room::select('number')
            ->whereColumn('rooms.id', 'invoices.room_id')
        ]);
    }

    public function scopeWithRoomCapacity(Builder $builder)
    {
        $builder->addSelect(['room_capacity' => Room::select('capacity')
            ->whereColumn('rooms.id', 'invoices.room_id')
        ]);
    }

    public function scopeWithTenantName(Builder $builder)
    {
        $builder->addSelect(['tenant_name' => Student::select('name')
            ->whereColumn('students.id', 'invoices.student_id')
        ]);
    }

    public function scopeWithTenantGender(Builder $builder)
    {
        $builder->addSelect(['tenant_gender' => Student::select('gender')
            ->whereColumn('students.id', 'invoices.student_id')
        ]);
    }

    public function scopeWithTenantRegistrationNumber(Builder $builder)
    {
        $builder->addSelect(['tenant_registration_number' => Student::select('registration_number')
            ->whereColumn('students.id', 'invoices.student_id')
        ]);
    }

    public function scopeWithTenantLocale(Builder $builder)
    {
        $builder->addSelect(['tenant_locale' => Student::select('locale')
            ->whereColumn('students.id', 'invoices.student_id')
        ]);
    }

    public function scopeWithTenantCourseName(Builder $builder)
    {
        $builder->addSelect(['tenant_course_name' => Course::select('courses.name')
            ->leftJoin('students', 'students.course_id', 'courses.id')
            ->whereColumn('students.id', 'invoices.student_id')
            ->take(1)
        ]);
    }
}
