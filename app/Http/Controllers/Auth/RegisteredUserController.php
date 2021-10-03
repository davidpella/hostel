<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\Alumnus;
use App\Models\Course;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\CarbonPeriod;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Countries;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return Response
     */
    public function create(): Response
    {
        $periods = CarbonPeriod::create('now', '-1 year', 10);

        $graduationYears = collect($periods)->map(function ($date){
            return $date->year;
        });

        $countries = Countries::sortBy('name')->all()->pluck('name.common');

        return Inertia::render('Auth/Register', [
            'graduatedCourses' => Course::get(),
            'countries' => $countries,
            'graduationYears' => $graduationYears,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param RegistrationRequest $request
     * @return RedirectResponse
     */
    public function store(RegistrationRequest $request): RedirectResponse
    {
        $alumnus = Alumnus::create($request->only([
            'type',
            'first_name',
            'last_name',
            'middle_name',
            'email',
            'phone_number',
            'gender',
            'city',
            'country',
            'course_id',
            'graduation_year',
            'educational_level',
            'current_employee',
            'position',
        ]));

        $user = User::create([
            'name' => $request->get('first_name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $alumnus->account()->save($user);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
