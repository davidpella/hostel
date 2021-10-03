<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RoomTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Response
    {
        $roomTypes = RoomType::search($request->get('search'))
            ->latest()
            ->paginate();

        return Inertia::render('RoomTypes/Index', [
            'roomTypes' => $roomTypes
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('RoomTypes/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'price' => [
                'required', 'numeric'
            ],
            'capacity' => [
                'required', 'numeric'
            ],
        ]);

        RoomType::create($request->only([
            'name', 'price', 'capacity'
        ]));

        return Redirect::route('roomTypes.index');
    }

    public function edit(RoomType $roomType): Response
    {
        return Inertia::render('RoomTypes/Edit', [
            'roomType' => $roomType,
        ]);
    }

    public function update(RoomType $roomType, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'price' => [
                'required', 'numeric'
            ],
            'capacity' => [
                'required', 'numeric'
            ],
        ]);

        $roomType->update($request->only([
            'name', 'price', 'capacity'
        ]));

        return Redirect::route('roomTypes.index');
    }

    public function destroy(RoomType $roomType): RedirectResponse
    {
        $roomType->delete();

        return Redirect::route('roomTypes.index');
    }
}
