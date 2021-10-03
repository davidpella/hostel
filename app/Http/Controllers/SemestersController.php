<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Semester;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class SemestersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Response
    {
        $semesters = Semester::search($request->search)
            ->with(['academicYear'])
            ->latest()
            ->paginate()
            ->withQueryString();

        return Inertia::render('Semesters/Index', [
            'semesters' => $semesters
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Semesters/Create', [
            'academicYears' => AcademicYear::get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'academic_year_id' => [
                'required',
            ]
        ]);

        Semester::create($request->only([
            'name', 'academic_year_id'
        ]));

        return Redirect::route('semesters.index');
    }

    public function edit(Semester $semester): Response
    {
        return Inertia::render('Semesters/Edit', [
            'semester' => $semester,
            'academicYears' => AcademicYear::get()
        ]);
    }

    public function update(Semester $semester, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'academic_year_id' => [
                'required',
            ]
        ]);

        $semester->update($request->only([
            'name', 'academic_year_id'
        ]));

        return Redirect::route('semesters.index');
    }

    public function destroy(Semester $semester): RedirectResponse
    {
        $semester->delete();

        return Redirect::back();
    }
}
