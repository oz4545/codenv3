<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuizController;

Route::middleware('web')->group(function () {

    // Rutas para usuarios invitados

    Route::middleware('guest')->group(function () {
        Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
        Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/', [AuthController::class, 'login'])->name('login');
    });

    // Ruta para cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Ruta para el dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('auth')->name('dashboard');

    // Rutas de Quiz
    Route::middleware('auth')->group(function () {
        //Rutas Formularios

    Route::get('quiz/{formId}/question/{questionId}', [QuizController::class, 'showQuestion'])
    ->name('quiz.show')
    ->defaults('questionId', 1);

    Route::post('quiz/{formId}/question/{questionId}/validate', [QuizController::class, 'validateAnswer'])
    ->name('quiz.validate');

    Route::get('quiz/{formId}/completed', [QuizController::class, 'completed'])
    ->name('quiz.completed');

    });

    // Rutas adicionales para menús y usuarios comentadas
});

