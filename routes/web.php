<?php

use App\Http\Controllers\AcademicYearsController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HostelsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\RoomTypesController;
use App\Http\Controllers\SemestersController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Models\AcademicYear;
use App\Models\Invoice;
use App\Models\Room;
use App\Models\Semester;
use Illuminate\Support\Facades\Route;

Route::inertia('components', 'Components');

Route::get('/', [WelcomeController::class, '__invoke']);
Route::get('apply', [ApplicationsController::class, '__invoke'])->name('applications');
Route::post('apply', [ApplicationsController::class, 'store'])->name('applications.store');

Route::get('users', [UsersController::class, 'index'])->name('users.index');
Route::post('users', [UsersController::class, 'store'])->name('users.store');
Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
Route::put('users/{user}', [UsersController::class, 'update'])->name('users.update');
Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('users.destroy')->middleware(['password.confirm']);

Route::get('courses', [CoursesController::class, 'index'])->name('courses.index');
Route::get('courses/create', [CoursesController::class, 'create'])->name('courses.create');
Route::post('courses', [CoursesController::class, 'store'])->name('courses.store');
Route::get('courses/{course}/edit', [CoursesController::class, 'edit'])->name('courses.edit');
Route::put('courses/{course}', [CoursesController::class, 'update'])->name('courses.update');
Route::delete('courses/{course}', [CoursesController::class, 'destroy'])->name('courses.destroy')->middleware(['password.confirm']);

Route::get('rooms', [RoomsController::class, 'index'])->name('rooms.index');
Route::get('rooms/create', [RoomsController::class, 'create'])->name('rooms.create');
Route::post('rooms', [RoomsController::class, 'store'])->name('rooms.store');
Route::get('rooms/{room}/edit', [RoomsController::class, 'edit'])->name('rooms.edit');
Route::put('rooms/{room}', [RoomsController::class, 'update'])->name('rooms.update');
Route::delete('rooms/{room}', [RoomsController::class, 'destroy'])->name('rooms.destroy')->middleware(['password.confirm']);

Route::get('room-types', [RoomTypesController::class, 'index'])->name('roomTypes.index');
Route::get('room-types/create', [RoomTypesController::class, 'create'])->name('roomTypes.create');
Route::post('room-types', [RoomTypesController::class, 'store'])->name('roomTypes.store');
Route::get('room-types/{roomType}/edit', [RoomTypesController::class, 'edit'])->name('roomTypes.edit');
Route::put('room-types/{roomType}', [RoomTypesController::class, 'update'])->name('roomTypes.update');
Route::delete('room-types/{roomType}', [RoomTypesController::class, 'destroy'])->name('roomTypes.destroy')->middleware(['password.confirm']);

Route::get('hostels', [HostelsController::class, 'index'])->name('hostels.index');
Route::get('hostels/create', [HostelsController::class, 'create'])->name('hostels.create');
Route::post('hostels', [HostelsController::class, 'store'])->name('hostels.store');
Route::get('hostels/{hostel}/edit', [HostelsController::class, 'edit'])->name('hostels.edit');
Route::put('hostels/{hostel}', [HostelsController::class, 'update'])->name('hostels.update');
Route::delete('hostels/{hostel}', [HostelsController::class, 'destroy'])->name('hostels.destroy')->middleware(['password.confirm']);

Route::get('students', [StudentsController::class, 'index'])->name('students.index');
Route::get('students/create', [StudentsController::class, 'create'])->name('students.create');
Route::post('students', [StudentsController::class, 'store'])->name('students.store');
Route::get('students/{student}/edit', [StudentsController::class, 'edit'])->name('students.edit');
Route::put('students/{student}', [StudentsController::class, 'update'])->name('students.update');
Route::get('students/{student}', [StudentsController::class, 'show'])->name('students.show');
Route::delete('students/{student}', [StudentsController::class, 'destroy'])->name('students.destroy')->middleware(['password.confirm']);

Route::get('semesters', [SemestersController::class, 'index'])->name('semesters.index');
Route::get('semesters/create', [SemestersController::class, 'create'])->name('semesters.create');
Route::post('semesters', [SemestersController::class, 'store'])->name('semesters.store');
Route::get('semesters/{semester}/edit', [SemestersController::class, 'edit'])->name('semesters.edit');
Route::put('semesters/{semester}', [SemestersController::class, 'update'])->name('semesters.update');
Route::delete('semesters/{semester}', [SemestersController::class, 'destroy'])->name('semesters.destroy')->middleware(['password.confirm']);

Route::get('academic-years', [AcademicYearsController::class, 'index'])->name('academicYears.index');
Route::get('academic-years/create', [AcademicYearsController::class, 'create'])->name('academicYears.create');
Route::post('academic-years', [AcademicYearsController::class, 'store'])->name('academicYears.store');
Route::get('academic-years/{academicYear}/edit', [AcademicYearsController::class, 'edit'])->name('academicYears.edit');
Route::put('academic-years/{academicYear}', [AcademicYearsController::class, 'update'])->name('academicYears.update');
Route::delete('academic-years/{academicYear}', [AcademicYearsController::class, 'destroy'])->name('academicYears.destroy')->middleware(['password.confirm']);

Route::get('invoices', [InvoicesController::class, 'index'])->name('invoices.index');
Route::get('invoices/create', [InvoicesController::class, 'create'])->name('invoices.create');
Route::get('invoices/export', [InvoicesController::class, 'export'])->name('invoices.export');
Route::post('invoices', [InvoicesController::class, 'store'])->name('invoices.store');
Route::get('invoices/{invoice}/edit', [InvoicesController::class, 'edit'])->name('invoices.edit');
Route::put('invoices/{invoice}', [InvoicesController::class, 'update'])->name('invoices.update');
Route::delete('invoices/{invoice}', [InvoicesController::class, 'destroy'])->name('invoices.destroy')->middleware(['password.confirm']);

Route::get('applications', [ApplicationsController::class, 'index'])->name('applications.index');
Route::get('applications/export', [ApplicationsController::class, 'export'])->name('applications.export');
Route::delete('applications/{application}', [ApplicationsController::class, 'destroy'])->name('applications.destroy')->middleware(['password.confirm']);

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');
Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->middleware('auth')->name('verification.notice');
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->middleware('auth')->name('password.confirm');
Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])->middleware('auth');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');
