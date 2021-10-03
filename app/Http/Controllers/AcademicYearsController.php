<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class AcademicYearsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Response
    {
        $academicYears = AcademicYear::query()
            ->search($request->search)
            ->latest()
            ->paginate(5);

        return Inertia::render('AcademicYears/Index', [
            'academicYears' => $academicYears
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('AcademicYears/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['name' => [
            'required', 'string', 'max:255'
        ]]);

        AcademicYear::create([
            'name' => $request->get('name'),
        ]);

        return Redirect::route('academicYears.index');
    }

    public function edit(AcademicYear $academicYear): Response
    {
        return Inertia::render('AcademicYears/Edit', [
            'academicYear' => $academicYear
        ]);
    }

    public function update(AcademicYear $academicYear, Request $request): RedirectResponse
    {
        $request->validate(['name' => [
            'required', 'string', 'max:255'
        ]]);

        $academicYear->update([
            'name' => $request->get('name'),
        ]);

        return Redirect::route('academicYears.index');
    }

    public function destroy(AcademicYear $academicYear): RedirectResponse
    {
        $academicYear->delete();

        return Redirect::back();
    }
}
