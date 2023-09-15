<?php

use App\Models\User;
use Faker\Provider\ar_EG\Company;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

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

Route::get('/testy', function () {
    $uppercase = Str::random(1, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    $lowercase = Str::random(1, 'abcdefghijklmnopqrstuvwxyz');
    $number = Str::random(1, '0123456789');
    $specialChar = Str::random(1, '!@#$%^&*()_+-=[]{}|;:,.<>?');

    $allChars = $uppercase . $lowercase . $number . $specialChar;

    $remainingChars = Str::random(4, $allChars);

    $password = str_shuffle($allChars . $remainingChars);

    echo $password;
});

