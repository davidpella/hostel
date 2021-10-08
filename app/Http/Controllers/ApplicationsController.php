<?php

namespace App\Http\Controllers;

use App\Exports\ApplicationsExport;
use App\Models\AcademicYear;
use App\Models\Application;
use App\Models\Course;
use App\Models\Hostel;
use App\Models\Invoice;
use App\Models\RoomType;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ApplicationsController extends Controller
{
    public function __invoke(): Response
    {
        $academicYears = AcademicYear::get();

        $courses = Course::get();

        $roomTypes = RoomType::get();

        return Inertia::render('Application', [
            'academicYears' => $academicYears,
            'courses' => $courses,
            'roomTypes' => $roomTypes,
        ]);
    }

    public function index(Request $request): Response
    {
        $applications = Application::search($request->get('search'))
            ->with(['student.course', 'roomType', 'academicYear'])
            ->latest()
            ->paginate();

        $courses = Course::get();

        $hostels = Hostel::get();

        $academicYears = AcademicYear::get();

        return Inertia::render('Applications/Index', [
            'applications' => $applications,
            'hostels' => $hostels,
            'courses' => $courses,
            'academicYears' => $academicYears,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'phone' => [
                'required', 'string', 'min:9', 'max:25', 'unique:students'
            ],
            'email' => [
                'required', 'string', 'email', 'unique:users'
            ],
            'gender' => [
                'required', 'string', Rule::in(['male', 'female'])
            ],
            'course_id' => [
                'required', 'exists:courses,id'
            ],
            'continuation' => [
                'required', 'string', Rule::in(['continuing', 'fresh'])
            ],
            'registration_number' => [
                'required', 'string', 'max:255', 'unique:students'
            ],
            'registration_number_type' => [
                'required', 'string', Rule::in(['college', 'csee', 'other'])
            ],
            'locale' => [
                'required', 'boolean'
            ],
            'is_disabled' => [
                'required', 'boolean'
            ],
            'academic_year_id' => [
                'required', 'exists:academic_years,id'
            ],
            'room_type_id' => [
                'required', 'exists:room_types,id'
            ],
            'amount' => [
                'required', 'numeric'
            ],
        ]);

        $student = Student::create([
            'name' => request('name'),
            'phone' => request('phone'),
            'gender' => request('gender'),
            'locale' => $request->boolean('locale') ? 'international' : 'domestic',
            'is_disabled' => $request->boolean('is_disabled'),
            'course_id' => request('course_id'),
            'continuation' => request('continuation'),
            'registration_number' => request('registration_number'),
            'registration_number_type' => request('registration_number_type'),
        ]);

        $application = $student->applications()->create([
            'status' => 'pending',
            'amount' => request('amount'),
            'room_type_id' => request('room_type_id'),
            'academic_year_id' => request('academic_year_id'),
        ]);

        Invoice::create([
            'status' => 'pending',
            'amount' => request('amount'),
            'application_id' => $application->id,
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);

        $student->account()->save($user);

        return Redirect::back()->with('success', 'Your application was submitted successfully.');
    }

    public function destroy(Application $application): RedirectResponse
    {
        $application->delete();

        return Redirect::back();
    }

    public function export(Request $request): BinaryFileResponse
    {
        return Excel::download(new ApplicationsExport(), 'applications.xlsx');
    }
}
