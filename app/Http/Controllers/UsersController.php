<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Response
    {
        $users = User::staff()
            ->search($request->search)
            ->latest()
            ->paginate();

        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Users/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'email' => [
                'required', 'string', 'max:255'
            ],
            'password' => [
                'required', 'string', 'max:255'
            ],
        ]);

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return Redirect::route('users.index');
    }

    public function edit(User $user): Response
    {
        return Inertia::render('Users/Edit', [
            'user' => $user
        ]);
    }

    public function update(User $user, Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255'
            ],
            'email' => [
                'required', 'string', 'max:255'
            ],
        ]);

        $user->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        return Redirect::route('users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return Redirect::back();
    }
}
