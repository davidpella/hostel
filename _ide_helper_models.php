<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AcademicYear
 *
 * @mixin IdeHelperAcademicYear
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Semester[] $semesters
 * @property-read int|null $semesters_count
 * @method static \Database\Factories\AcademicYearFactory factory(...$parameters)
 * @method static Builder|AcademicYear newModelQuery()
 * @method static Builder|AcademicYear newQuery()
 * @method static Builder|AcademicYear query()
 * @method static Builder|AcademicYear search($query)
 * @method static Builder|AcademicYear whereCreatedAt($value)
 * @method static Builder|AcademicYear whereDeletedAt($value)
 * @method static Builder|AcademicYear whereId($value)
 * @method static Builder|AcademicYear whereName($value)
 * @method static Builder|AcademicYear whereUpdatedAt($value)
 */
	class IdeHelperAcademicYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Application
 *
 * @mixin IdeHelperApplication
 * @property int $id
 * @property float $amount
 * @property int $student_id
 * @property int $room_type_id
 * @property int $academic_year_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\AcademicYear $academicYear
 * @property-read \App\Models\RoomType $roomType
 * @property-read \App\Models\Student $student
 * @method static \Database\Factories\ApplicationFactory factory(...$parameters)
 * @method static Builder|Application newModelQuery()
 * @method static Builder|Application newQuery()
 * @method static Builder|Application query()
 * @method static Builder|Application search($query)
 * @method static Builder|Application whereAcademicYearId($value)
 * @method static Builder|Application whereAmount($value)
 * @method static Builder|Application whereCreatedAt($value)
 * @method static Builder|Application whereDeletedAt($value)
 * @method static Builder|Application whereId($value)
 * @method static Builder|Application whereRoomTypeId($value)
 * @method static Builder|Application whereStatus($value)
 * @method static Builder|Application whereStudentId($value)
 * @method static Builder|Application whereUpdatedAt($value)
 * @method static Builder|Application withRoomTypeCapacity()
 * @method static Builder|Application withRoomTypeNumber()
 * @method static Builder|Application withTenantCourseName()
 * @method static Builder|Application withTenantGender()
 * @method static Builder|Application withTenantLocale()
 * @method static Builder|Application withTenantName()
 * @method static Builder|Application withTenantRegistrationNumber()
 */
	class IdeHelperApplication extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Course
 *
 * @mixin IdeHelperCourse
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Database\Factories\CourseFactory factory(...$parameters)
 * @method static Builder|Course newModelQuery()
 * @method static Builder|Course newQuery()
 * @method static Builder|Course query()
 * @method static Builder|Course search($query)
 * @method static Builder|Course whereCreatedAt($value)
 * @method static Builder|Course whereDeletedAt($value)
 * @method static Builder|Course whereId($value)
 * @method static Builder|Course whereName($value)
 * @method static Builder|Course whereUpdatedAt($value)
 */
	class IdeHelperCourse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Hostel
 *
 * @mixin IdeHelperHostel
 * @property int $id
 * @property string $name
 * @property string $type
 * @property bool $has_floors
 * @property int|null $floor_count
 * @property string|null $activate_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Room[] $rooms
 * @property-read int|null $rooms_count
 * @method static \Database\Factories\HostelFactory factory(...$parameters)
 * @method static Builder|Hostel newModelQuery()
 * @method static Builder|Hostel newQuery()
 * @method static Builder|Hostel query()
 * @method static Builder|Hostel search($query)
 * @method static Builder|Hostel whereActivateAt($value)
 * @method static Builder|Hostel whereCreatedAt($value)
 * @method static Builder|Hostel whereDeletedAt($value)
 * @method static Builder|Hostel whereFloorCount($value)
 * @method static Builder|Hostel whereHasFloors($value)
 * @method static Builder|Hostel whereId($value)
 * @method static Builder|Hostel whereName($value)
 * @method static Builder|Hostel whereType($value)
 * @method static Builder|Hostel whereUpdatedAt($value)
 */
	class IdeHelperHostel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Invoice
 *
 * @mixin IdeHelperInvoice
 * @property int $id
 * @property float $amount
 * @property int|null $room_id
 * @property int $application_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\AcademicYear $academicYear
 * @property-read \App\Models\Application $application
 * @property-read \App\Models\Room|null $room
 * @property-read \App\Models\Student $student
 * @method static \Database\Factories\InvoiceFactory factory(...$parameters)
 * @method static Builder|Invoice newModelQuery()
 * @method static Builder|Invoice newQuery()
 * @method static Builder|Invoice query()
 * @method static Builder|Invoice search($query)
 * @method static Builder|Invoice whereAmount($value)
 * @method static Builder|Invoice whereApplicationId($value)
 * @method static Builder|Invoice whereCreatedAt($value)
 * @method static Builder|Invoice whereDeletedAt($value)
 * @method static Builder|Invoice whereId($value)
 * @method static Builder|Invoice whereRoomId($value)
 * @method static Builder|Invoice whereStatus($value)
 * @method static Builder|Invoice whereUpdatedAt($value)
 * @method static Builder|Invoice withRoomCapacity()
 * @method static Builder|Invoice withRoomNumber()
 * @method static Builder|Invoice withTenantCourseName()
 * @method static Builder|Invoice withTenantGender()
 * @method static Builder|Invoice withTenantLocale()
 * @method static Builder|Invoice withTenantName()
 * @method static Builder|Invoice withTenantRegistrationNumber()
 */
	class IdeHelperInvoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Room
 *
 * @mixin IdeHelperRoom
 * @property int $id
 * @property string $number
 * @property string|null $location
 * @property int $hostel_id
 * @property int $room_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Hostel $hostel
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @property-read \App\Models\RoomType $type
 * @method static Builder|Room available($id)
 * @method static \Database\Factories\RoomFactory factory(...$parameters)
 * @method static Builder|Room newModelQuery()
 * @method static Builder|Room newQuery()
 * @method static Builder|Room query()
 * @method static Builder|Room search($query)
 * @method static Builder|Room whereCreatedAt($value)
 * @method static Builder|Room whereDeletedAt($value)
 * @method static Builder|Room whereHostelId($value)
 * @method static Builder|Room whereId($value)
 * @method static Builder|Room whereLocation($value)
 * @method static Builder|Room whereNumber($value)
 * @method static Builder|Room whereRoomTypeId($value)
 * @method static Builder|Room whereUpdatedAt($value)
 */
	class IdeHelperRoom extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RoomType
 *
 * @mixin IdeHelperRoomType
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $capacity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Room[] $room
 * @property-read int|null $room_count
 * @method static \Database\Factories\RoomTypeFactory factory(...$parameters)
 * @method static Builder|RoomType newModelQuery()
 * @method static Builder|RoomType newQuery()
 * @method static Builder|RoomType query()
 * @method static Builder|RoomType search($query)
 * @method static Builder|RoomType whereCapacity($value)
 * @method static Builder|RoomType whereCreatedAt($value)
 * @method static Builder|RoomType whereDeletedAt($value)
 * @method static Builder|RoomType whereId($value)
 * @method static Builder|RoomType whereName($value)
 * @method static Builder|RoomType wherePrice($value)
 * @method static Builder|RoomType whereUpdatedAt($value)
 */
	class IdeHelperRoomType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Semester
 *
 * @mixin IdeHelperSemester
 * @property int $id
 * @property string $name
 * @property int $academic_year_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\AcademicYear $academicYear
 * @method static \Database\Factories\SemesterFactory factory(...$parameters)
 * @method static Builder|Semester newModelQuery()
 * @method static Builder|Semester newQuery()
 * @method static Builder|Semester query()
 * @method static Builder|Semester search($query)
 * @method static Builder|Semester whereAcademicYearId($value)
 * @method static Builder|Semester whereCreatedAt($value)
 * @method static Builder|Semester whereDeletedAt($value)
 * @method static Builder|Semester whereId($value)
 * @method static Builder|Semester whereName($value)
 * @method static Builder|Semester whereUpdatedAt($value)
 */
	class IdeHelperSemester extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @mixin IdeHelperStudent
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $gender
 * @property string $continuation
 * @property string $locale
 * @property string $registration_number_type
 * @property string|null $registration_number
 * @property int $course_id
 * @property int $is_disabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User|null $account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Application[] $applications
 * @property-read int|null $applications_count
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Invoice[] $invoices
 * @property-read int|null $invoices_count
 * @method static \Database\Factories\StudentFactory factory(...$parameters)
 * @method static Builder|Student newModelQuery()
 * @method static Builder|Student newQuery()
 * @method static Builder|Student query()
 * @method static Builder|Student search($query)
 * @method static Builder|Student whereContinuation($value)
 * @method static Builder|Student whereCourseId($value)
 * @method static Builder|Student whereCreatedAt($value)
 * @method static Builder|Student whereDeletedAt($value)
 * @method static Builder|Student whereGender($value)
 * @method static Builder|Student whereId($value)
 * @method static Builder|Student whereIsDisabled($value)
 * @method static Builder|Student whereLocale($value)
 * @method static Builder|Student whereName($value)
 * @method static Builder|Student wherePhone($value)
 * @method static Builder|Student whereRegistrationNumber($value)
 * @method static Builder|Student whereRegistrationNumberType($value)
 * @method static Builder|Student whereUpdatedAt($value)
 */
	class IdeHelperStudent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @mixin IdeHelperUser
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $account_type
 * @property int|null $account_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $accounts
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User search($query)
 * @method static Builder|User staff()
 * @method static Builder|User whereAccountId($value)
 * @method static Builder|User whereAccountType($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
	class IdeHelperUser extends \Eloquent {}
}

