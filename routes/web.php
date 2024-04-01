<?php

    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('dashboard')->name('dashboard.')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::prefix('ticket')->name('ticket.')->group(function() {
        Route::get('/new', [DashboardController::class, 'newTicket'])->name('new');
        Route::get('/view/{ticket_id}', [DashboardController::class, 'viewTicket'])->name('view');

        Route::post('/new', [DashboardController::class, 'createTicket'])->name('create');
        Route::post('/create-comment', [DashboardController::class, 'createTicketComment'])->name('create.comment');
    });
})->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
