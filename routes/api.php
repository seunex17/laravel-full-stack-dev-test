<?php

    use App\Http\Controllers\DashboardController;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;

    Route::get('/user', function(Request $request)
    {
        return $request->user();
    })
        ->middleware('auth:sanctum');


    Route::prefix('ticket')
        ->name('ticket.')
        ->group(function()
        {
            Route::get('/new', [DashboardController::class, 'newTicket']);

            Route::post('/new', [DashboardController::class, 'createTicket']);
        });
