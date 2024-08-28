<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return redirect()->route('company.index');
    })->name('home');

    //Route Companies
    Route::resource('company', CompanyController::class);

    //Route Employees
    Route::get('company/{companyId}/employee', [EmployeController::class, 'index'])->name('employee.index');
    Route::get('company/{companyId}/employee/create', [EmployeController::class, 'create'])->name('employee.create');
    Route::post('company/{companyId}/employee', [EmployeController::class, 'store'])->name('employee.store');
    Route::get('company/{companyId}/employee/{id}', [EmployeController::class, 'show'])->name('employee.show');
    Route::get('company/{companyId}/employee/{id}/edit', [EmployeController::class, 'edit'])->name('employee.edit');
    Route::patch('company/{companyId}/employee/{id}', [EmployeController::class, 'update'])->name('employee.update');
    Route::delete('company/{companyId}/employee/{id}', [EmployeController::class, 'destroy'])->name('employee.destroy');
});
