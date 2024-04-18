<?php

use App\Livewire\Admin;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
auth()->loginUsingId(5);
Volt::route('/', 'users.index');

Volt::route('/login', 'login')->name('login');
Volt::route('/register', 'register')->name('register');

Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
});

Route::middleware('auth')->group(function () {
    Route::get('tickets', Admin\Ticket\Index::class)->name('ticket.index');
    Route::get('tickets/cadastrar', Admin\Ticket\Create::class)->name('ticket.create');
    Route::get('tickets/{ticket}', Admin\Ticket\Show::class)->name('ticket.show');

    Route::get('usuarios', Admin\User\Index::class)->name('users.index');
    Route::get('usuarios/cadastrar', Admin\User\Create::class)->name('users.create');
});

