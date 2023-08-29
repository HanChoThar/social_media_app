<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user-create', function () {
    User::create([
        'name' => 'cho', 'email' => 'devidthan90@gmail.com', 'password' => 'admin@123', 'system_status' => 'active', 'profile_image_id' => null
    ]);

    echo 'done';
});

Route::get('/truncate', function () {
    User::truncate();
    echo 'done';
});

Route::get('/test-connection', function() {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        if($dbName){
            echo "Database connection is established - $dbName";
        }
    } catch (\Exception $e) {
        echo "Database connection could not be established.";
    }
});


