<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get("/", [AuthController::class, 'index'])->name('login');
Route::post("/login", [AuthController::class, 'processLogin'])->name('auth.processLogin');

Route::get("register", [AuthController::class, 'registerForm'])->name('auth.register');
Route::post("register", [AuthController::class, 'ProcessRegister'])->name('process.register');




Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    //--------------------------------categories routes-------------------------------
    Route::get('/all-categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/all-work-categories', [CategoryController::class, 'workIndex'])->name('category.work.index');
    Route::get('/all-personal-categories', [CategoryController::class, 'personalIndex'])->name('category.personal.index');
    Route::get('/all-shopping-categories', [CategoryController::class, 'shoppingIndex'])->name('category.shopping.index');
    Route::get('/create-category', [CategoryController::class, 'creaetCategoryForm'])->name('category.create');
    Route::get('/edit-category/{id}', [CategoryController::class, 'editCategoryForm'])->name('category.edit');
    Route::put('/edit-category/{id}', [CategoryController::class, 'updateCategoryFormData'])->name('category.update');
    Route::post('/store-category', [CategoryController::class, 'storeCategoryForm'])->name('category.store');
    Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');

    //---------------------------------Tasks Routes----------------------------------------------
    Route::get('/all-tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/create-task', [TaskController::class, 'createTask'])->name('tasks.create');
    Route::get('/edit-task/{id}', [TaskController::class, 'editTask'])->name('task.edit');
    Route::get('/show-task/{id}', [TaskController::class, 'showTask'])->name('task.show');
    Route::post('/store-task', [TaskController::class, 'storeTask'])->name('task.store');
    Route::put('/update-task/{id}', [TaskController::class, 'updateTask'])->name('task.update');
    Route::delete('/delete-task/{id}', [TaskController::class, 'deleteTask'])->name('task.delete');
    Route::post('/tasks/{id}/toggle', [TaskController::class, 'toggleComplete'])->name('task.toggle.complete');
    Route::post('/task/{id}/toggle-important', [TaskController::class, 'toggleImportant'])->name('task.toggle.important');
    Route::get('/task/today', [TaskController::class, 'todayTask'])->name('task.today');
    Route::get('/task/important', [TaskController::class, 'taskImportant'])->name('task.important');
    Route::get('/task/completed', [TaskController::class, 'taskCompleted'])->name('task.completed');
    Route::get('/task/overdue', [TaskController::class, 'taskOverdue'])->name('task.overdue');
    Route::get('/category/tasks/{id}', [TaskController::class, 'categoryTasks'])->name('category.tasks');

    // -----------------------------------Profile Routes----------------------------------------
    Route::get('/profile/show', [ProfileController::class, 'index'])->name('profile.show');
    
    
    // -----------------------------------Settings Routes----------------------------------------
    Route::get('/settings/show', [SettingsController::class, 'index'])->name('settings.show');

    //------------------------------------blog testing routes------------------------------------
    Route::get('/settings/show/blog', [SettingsController::class, 'blog'])->name('settings.blog');

});








//-------------------------------------Email verfication routes--------------------------
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    
    return redirect()->route('dashboard')
        ->with('success', 'Email verified successfully!');
})->middleware(['auth', 'signed'])->name('verification.verify');
