<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RoomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Response
    {
        $rooms = Room::with(['hostel', 'type'])
            ->search($request->search)
            ->latest()
            ->paginate();

        return Inertia::render('Rooms/Index', [
            'rooms' => $rooms
        ]);
    }

    public function create(): Response
    {
        $hostels = Hostel::get();

        $roomTypes = RoomType::get();

        return Inertia::render('Rooms/Create', [
            'hostels' => $hostels,
            'roomTypes' => $roomTypes,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'number' => [
                'required', 'string', 'max:255'
            ],
            'location' => [
                'required', 'string', 'max:255'
            ],
            'hostel_id' => [
                'required', 'exists:hostels,id'
            ],
            'room_type_id' => [
                'required', 'exists:room_types,id'
            ],
        ]);

        Room::create($request->only([
            'number', 'location', 'hostel_id', 'room_type_id'
        ]));

        return Redirect::route('rooms.index');
    }

    public function edit(Room $room): Response
    {
        $roomTypes = RoomType::get();

        $hostels = Hostel::get();

        return Inertia::render('Rooms/Edit', [
            'room' => $room,
            'hostels' => $hostels,
            'roomTypes' => $roomTypes,
        ]);
    }

    public function update(Room $room, Request $request): RedirectResponse
    {
        $request->validate([
            'number' => [
                'required', 'string', 'max:255'
            ],
            'location' => [
                'required', 'string', 'max:255'
            ],
            'hostel_id' => [
                'required', 'exists:hostels,id'
            ],
            'room_type_id' => [
                'required', 'exists:room_types,id'
            ],
        ]);

        $room->update($request->only([
            'number', 'location', 'hostel_id', 'room_type_id'
        ]));

        return Redirect::route('rooms.index');
    }

    public function destroy(Room $room): RedirectResponse
    {
        $room->delete();

        return Redirect::route('rooms.index');
    }
}
