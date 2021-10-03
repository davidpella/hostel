<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Response
    {
        $courses = Course::query()
            ->search($request->search)
            ->latest()
            ->paginate(5);

        return Inertia::render('Courses/Index', [
            'courses' => $courses
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Courses/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['name' => [
            'required', 'string', 'max:255'
        ]]);

        Course::create([
            'name' => $request->get('name'),
        ]);

        return Redirect::route('courses.index');
    }

    public function edit(Course $course): Response
    {
        return Inertia::render('Courses/Edit', [
            'course' => $course
        ]);
    }

    public function update(Course $course, Request $request): RedirectResponse
    {
        $request->validate(['name' => [
            'required', 'string', 'max:255'
        ]]);

        $course->update([
            'name' => $request->get('name'),
        ]);

        return Redirect::route('courses.index');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $course->delete();

        return Redirect::back();
    }
}
