<?php

use App\Livewire\Admin\Users\UserPermission;
use Illuminate\Support\Facades\Route;
use App\Livewire\User\Index;
Use App\Livewire\Admin\Users\UserList;
Use App\Livewire\Admin\Dashboard\DashboardPage;


//Route::get('/users', Index::class)->name('users.index');

Route::prefix('admin')->group(function(){
    Route::get('/users',UserList::class)->name('admin.users');
    Route::get('/role', UserPermission::class)->name('admin.role');
});

Route::get('/dashboard',DashboardPage::class)->name('admin.dashboard');
