<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OnbordingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Onboarding Endpoints
Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [OnbordingController::class, 'registerNewUser']);
    Route::post('/login', [OnbordingController::class, 'Login']);
});

Route::group(['prefix' => 'company', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [CompanyController::class, 'list']);
    Route::get('/{companyId}', [CompanyController::class, 'show']);
    Route::post('/create', [CompanyController::class, 'createCompany']);
    Route::patch('/{companyId}', [CompanyController::class, 'updateCompany']);
    Route::delete('/{companyId}', [CompanyController::class, 'deleteCompany']);
    Route::post('/{companyId}', [CompanyController::class, 'companyLogo']);

});

Route::group(['prefix' => 'employee', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [EmployeeController::class, 'listEmployee']);
    Route::post('/add', [EmployeeController::class, 'createEmployee']);
    Route::get('/{employeeId}', [EmployeeController::class, 'showEmployee']);
    Route::patch('/{employeeId}', [EmployeeController::class, 'updateEmployee']);
    Route::delete('/{employeeId}', [EmployeeController::class, 'deleteEmployee']);

});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
