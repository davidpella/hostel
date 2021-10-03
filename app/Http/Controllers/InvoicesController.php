<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\Hostel;
use App\Models\Invoice;
use App\Models\Room;
use App\Models\Semester;
use App\Models\Student;
use App\Rules\RoomCapacity;
use App\Rules\StudentHasRoom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class InvoicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Response
    {
        $invoices = Invoice::search($request->search)
            ->with([
                'room',
                'application.student.course',
                'application.roomType',
                'application.academicYear',
            ])
            ->latest()
            ->paginate(5);

        $courses = Course::get();

        $hostels = Hostel::get();

        $academicYears = AcademicYear::get();

        return Inertia::render('Invoices/Index', [
            'invoices' => $invoices,
            'hostels' => $hostels,
            'courses' => $courses,
            'academicYears' => $academicYears,
        ]);
    }

    public function create(Request $request): Response
    {
        $academicYears = Semester::with(['academicYear'])->get();

        $rooms = Room::with(['hostel'])
            ->when($request->has('academicYear_id'), function ($builder){
                $builder->available(request('academicYear_id'));
            })
            ->get();

        $students = Student::with(['course'])
            ->when($request->has('academicYear_id'), function ($builder){
                $builder->whereDoesntHave('invoices', function ($builder) {
                    $builder->where('academicYear_id', request('academicYear_id'));
                });
            })
            ->get();

        return Inertia::render('Invoices/Create', [
            'students' => $students,
            'rooms' => $rooms,
            'academicYears' => $academicYears,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => [
                'required', 'numeric',
            ],
            'student_id' => [
                'required', new StudentHasRoom(request('academicYear_id')),
            ],
            'academicYear_id' => [
                'required',
            ],
            'room_id' => [
                'required', new RoomCapacity(request('academicYear_id')),
            ],
        ]);

        Invoice::create($request->only([
            'amount', 'student_id', 'room_id', 'academicYear_id'
        ]));

        return Redirect::route('invoices.index');
    }

    public function edit(Invoice $invoice): Response
    {
        $rooms = Room::with(['hostel'])->get();

        $students = Student::with(['course'])->get();

        return Inertia::render('Invoices/Edit', [
            'invoice' => $invoice,
            'rooms' => $rooms,
            'students' => $students,
        ]);
    }

    public function update(Invoice $invoice, Request $request): RedirectResponse
    {
        $request->validate([
            'amount' => [
                'required', 'numeric',
            ],
            'student_id' => [
                'required',
            ],
            'room_id' => [
                'required', new RoomCapacity(),
            ],
            'academicYear_id' => [
                'required',
            ],
        ]);

        $invoice->update($request->only([
            'amount', 'student_id', 'room_id', 'academicYear_id'
        ]));

        return Redirect::route('invoices.index');
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->delete();

        return Redirect::route('invoices.index');
    }

    public function export(Request $request): BinaryFileResponse
    {
        // dd($request->filled('academicYear'));

        //Invoice::with(['student.course', 'room'])->where('academicYear_id', 1)->get()->groupBy('room_id');

        return Excel::download(new InvoicesExport(), 'invoices.xlsx');
    }
}
