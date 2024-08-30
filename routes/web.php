<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;

Route::view('/','student')->name('home');
Route::post('add-employee',[EmployeeController::class, 'createEmployee'])->name('createEmp');
Route::get('get-employee',[EmployeeController::class, 'getEmployee'])->name('getEmp');
Route::post('edit-employee',[EmployeeController::class, 'editEmployee'])->name('editEmployee');
Route::post('add-student',[StudentController::class, 'createStudent'])->name('createStudent');
Route::get('get-student',[StudentController::class, 'getStudent'])->name('getStudent');
Route::post('edit-student',[StudentController::class, 'editStudent'])->name('editStudent');
Route::post('delete-student',[StudentController::class, 'deleteStudents'])->name('deleteStudent');