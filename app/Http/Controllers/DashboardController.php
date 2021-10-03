<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * @return Response
     */
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard', [
//            'totalRoomSlots' => Room::sum('capacity'),
            'totalRoomSlots' => 60,
        ]);
    }
}
