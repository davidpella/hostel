<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperApplication
 */
class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function roomType(): BelongsTo
    {
        return $this->belongsTo(RoomType::class);
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
                    ->orWhereRelation('student', 'name', "LIKE", "%{$token}%")
                    ->orWhereRelation('student', 'gender', "LIKE", "%{$token}%")
                    ->orWhereRelation('student', 'registration_number', "LIKE", "%{$token}%")
                    ->orWhereRelation('student.course', 'name', "LIKE", "%{$token}%")
                    ->orWhereRelation('roomType', 'name', "LIKE", "%{$token}%")
                    ->orWhereRelation('roomType', 'capacity', "LIKE", "%{$token}%");
            });
    }

    public function scopeWithRoomTypeNumber(Builder $builder)
    {
        $builder->addSelect(['room_type_name' => RoomType::select('name')
            ->whereColumn('room_types.id', 'applications.room_type_id')
        ]);
    }

    public function scopeWithRoomTypeCapacity(Builder $builder)
    {
        $builder->addSelect(['room_type_capacity' => RoomType::select('capacity')
            ->whereColumn('room_types.id', 'applications.room_type_id')
        ]);
    }

    public function scopeWithTenantName(Builder $builder)
    {
        $builder->addSelect(['tenant_name' => Student::select('name')
            ->whereColumn('students.id', 'applications.student_id')
        ]);
    }

    public function scopeWithTenantPhoneNumber(Builder $builder)
    {
        $builder->addSelect(['tenant_phone' => Student::select('phone')
            ->whereColumn('students.id', 'applications.student_id')
        ]);
    }

    public function scopeWithTenantGender(Builder $builder)
    {
        $builder->addSelect(['tenant_gender' => Student::select('gender')
            ->whereColumn('students.id', 'applications.student_id')
        ]);
    }

    public function scopeWithTenantRegistrationNumber(Builder $builder)
    {
        $builder->addSelect(['tenant_registration_number' => Student::select('registration_number')
            ->whereColumn('students.id', 'applications.student_id')
        ]);
    }

    public function scopeWithTenantLocale(Builder $builder)
    {
        $builder->addSelect(['tenant_locale' => Student::select('locale')
            ->whereColumn('students.id', 'applications.student_id')
        ]);
    }

    public function scopeWithTenantCourseName(Builder $builder)
    {
        $builder->addSelect(['tenant_course_name' => Course::select('courses.name')
            ->leftJoin('students', 'students.course_id', 'courses.id')
            ->whereColumn('students.id', 'applications.student_id')
            ->take(1)
        ]);
    }
}
