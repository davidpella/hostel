<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class HostelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Response
    {
        $hostels = Hostel::query()
            ->search($request->search)
            ->latest()
            ->paginate(5);

        return Inertia::render('Hostels/Index', [
            'hostels' => $hostels
        ]);
    }

    public function create(): Response
    {
        $hostels = Hostel::all();

        return Inertia::render('Hostels/Create', [
            'hostels' => $hostels
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'type' => [
                'required', 'string', 'max:255'
            ],
            'has_floors' => [
                'required', 'boolean'
            ],
            'floor_count' => [
                'required', 'integer'
            ],
        ]);

        Hostel::create($request->only([
            'name', 'type', 'has_floors', 'floor_count'
        ]));

        return Redirect::route('hostels.index');
    }

    public function edit(Hostel $hostel): Response
    {
        $hostels = Hostel::all();

        return Inertia::render('Hostels/Edit', [
            'hostel' => $hostel,
            'hostels' => $hostels,
        ]);
    }

    public function update(Hostel $hostel, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'type' => [
                'required', 'string', 'max:255'
            ],
            'has_floors' => [
                'required', 'boolean'
            ],
            'floor_count' => [
                'required', 'integer'
            ],
        ]);

        $hostel->update($request->only([
            'name', 'type', 'has_floors', 'floor_count'
        ]));

        return Redirect::route('hostels.index');
    }

    public function destroy(Hostel $hostel): RedirectResponse
    {
        $hostel->delete();

        return Redirect::route('hostels.index');
    }
}
