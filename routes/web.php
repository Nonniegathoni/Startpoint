<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OpportunityTypeController;
use App\Http\Controllers\CompensationTypeController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CohortController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\DocumentController;
// routes/web.php

Route::middleware(['auth'])->group(function () {
    Route::resource('opportunity-types', OpportunityTypeController::class);
    Route::resource('compensation-types', CompensationTypeController::class);
    Route::resource('titles', TitleController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('cohorts', CohortController::class);
    Route::resource('opportunities', OpportunityController::class);
    Route::resource('documents', DocumentController::class);
    
    // Special routes for pivot table operations
    Route::post('opportunities/{opportunity}/users/{user}/attach', [OpportunityController::class, 'attachUser'])->name('opportunities.attach-user');
    Route::delete('opportunities/{opportunity}/users/{user}/detach', [OpportunityController::class, 'detachUser'])->name('opportunities.detach-user');
});