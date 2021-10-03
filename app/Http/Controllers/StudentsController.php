<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\student;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Response
    {
        $students = Student::search($request->get('search'))
            ->with(['course'])
            ->latest()
            ->paginate();

        return Inertia::render('Students/Index', [
            'students' => $students
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Students/Create', [
            'courses' => Course::get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'phone' => [
                'required', 'string', 'min:9', 'max:25'
            ],
            'email' => [
                'required', 'string', 'email'
            ],
            'gender' => [
                'required', 'string', Rule::in(['male', 'female'])
            ],
            'course_id' => [
                'required'
            ],
            'continuation' => [
                'required', 'string', Rule::in(['continuing', 'fresh'])
            ],
            'registration_number' => [
                'required', 'string', 'max:255'
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

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make('password'),
        ]);

        $student->account()->save($user);

        event(new Registered($user));

        return Redirect::route('students.index');
    }

    public function edit(student $student): Response
    {
        return Inertia::render('Students/Edit', [
            'student' => $student,
            'courses' => Course::get(),
        ]);
    }

    public function update(student $student, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'registration_number' => [
                'required', 'string', 'max:255'
            ],
            'phone_number' => [
                'required', 'string', 'max:16', 'min:9'
            ],
            'sex' => [
                'required', 'string', Rule::in(['male', 'female'])
            ],
            'course_id' => [
                'required',
            ],
        ]);

        $student->update($request->only([
            'name', 'registration_number', 'phone_number', 'sex', 'course_id'
        ]));

        return Redirect::route('students.index');
    }

    public function show(Student $student): Response
    {
        return Inertia::render('Students/Show', [
            'student' => $student
        ]);
    }

    public function destroy(student $student): RedirectResponse
    {
        $student->delete();

        return Redirect::route('students.index');
    }
}
