<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WorkerController::class, "read"])->name('root');;

Route::get('/worker/create', [WorkerController::class, "create"])->middleware('auth');
Route::post('/worker/', [WorkerController::class, "store"])->middleware('auth');

Route::delete('/worker/', [WorkerController::class, "delete"])->middleware('auth');

Route::get('/worker/{worker}/update', [WorkerController::class, "update"])->middleware('auth');
Route::put('/worker/{worker}', [WorkerController::class, "edit"])->middleware('auth');

Route::delete('/workers/delete', [WorkerController::class, "delete_all"])->middleware('auth');

Route::post('/workers/export/', [WorkerController::class, 'export'])->middleware('auth');

Route::get('/workers/file_upload', [WorkerController::class, "file_upload"])->middleware('auth');
Route::put('/workers/import', [WorkerController::class, 'import'])->middleware('auth');

Route::get('/authorize', function(Request $request) {
    $fields = $request->validate([
        'name' => 'required',
        'password' => 'required'
    ]);    
    if(auth()->attempt($fields)) {
        $request->session()->regenerate();
        return redirect('/');
    }
    return back()->withErrors(['name' => 'Invalid Input'])->onlyInput('name');
});
Route::get('/logout', function(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

    return redirect('/');
})->middleware('auth');