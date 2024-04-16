<?php

use App\Livewire\Admin;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
auth()->loginUsingId(1);
Volt::route('/', 'users.index');

Route::get('tickets', Admin\Ticket\Index::class)->name('ticket.index');
Route::get('tickets/cadastrar', Admin\Ticket\Create::class)->name('ticket.create');
