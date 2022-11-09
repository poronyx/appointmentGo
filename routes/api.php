<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/survey', \App\Http\Controllers\SurveyController::class);

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/patient-dashboard', [\App\Http\Controllers\PatientDashboardController::class, 'index']);

    
    
});
//Materials
Route::post('/material/create',[\App\Http\Controllers\MaterialController::class,'createMaterial']);
Route::get('/material/get',[\App\Http\Controllers\MaterialController::class,'getMaterial']);
//Institutes
Route::post('/institute/create',[\App\Http\Controllers\InstituitionController::class,'createInstituition']);
Route::get('/institute/get',[\App\Http\Controllers\InstituitionController::class,'getInstituition']);
Route::post('/institute/delete',[\App\Http\Controllers\InstituitionController::class,'deleteInstitute']);
Route::post('/institute/update',[\App\Http\Controllers\InstituitionController::class,'updateInstitute']);


//For Slots
Route::post('/institute/generateSlots',[\App\Http\Controllers\SlotController::class,'createSlots']);
//Specialty
Route::post('/specialty/create',[\App\Http\Controllers\SpecialtyController::class,'createSpecialty']);
Route::get('/specialty/get',[\App\Http\Controllers\SpecialtyController::class,'getSpecialty']);
Route::post('/specialty/delete',[\App\Http\Controllers\SpecialtyController::class,'deleteSpecialty']);
Route::post('/specialty/update',[\App\Http\Controllers\SpecialtyController::class,'updateSpecialty']);

//For Group Admin Manage Account
Route::get('/users/getAll',[\App\Http\Controllers\AuthController::class,'getUsers']);
Route::post('/users/deleteUser',[\App\Http\Controllers\AuthController::class,'deleteUser']);
Route::post('/users/suspendUser',[\App\Http\Controllers\AuthController::class,'suspendUser']);
Route::post('/users/unSuspendUser',[\App\Http\Controllers\AuthController::class,'unSuspendUser']);
Route::post('/users/updateUser',[\App\Http\Controllers\AuthController::class,'updateUser']);

//For appointmet Table 
Route::post('/appointment/create',[\App\Http\Controllers\AppointmentController::class,'createAppointment']);
Route::post('/appointment/getDoctor',[\App\Http\Controllers\AppointmentController::class,'getApointmentsForDoctor']);
Route::post('/appointment/patientGetAppointments',[\App\Http\Controllers\AppointmentController::class,'patientGetAppointments']);
Route::post('/appointment/doctorGetAppointments',[\App\Http\Controllers\AppointmentController::class,'doctorGetAppointments']);
Route::post('/appointment/getAppointmentById',[\App\Http\Controllers\AppointmentController::class,'getAppointmentById']);
Route::post('/appointment/nurseGetAppointments',[\App\Http\Controllers\AppointmentController::class,'nurseGetAppointments']);

//For Patient making appointment page 
Route::post('/patient/getDoctorsFromInstitute', [AuthController::class, 'getDoctorsFromInstitute']);
Route::get('/patient/getDoctors', [AuthController::class, 'getAllDoctors']);
Route::post('/patient/getDoctorAvailability', [AppointmentController::class, 'patientGetDoctorAvailability']);
Route::post('/patient/getDoctorsFromSpecialty', [AuthController::class, 'getDoctorsFromSpecialty']);

//For Doctor page
Route::get('/doctor/getPatients', [AuthController::class, 'getAllPatients']);
Route::get('/survey-by-slug/{survey:slug}', [\App\Http\Controllers\SurveyController::class, 'showForGuest']);
Route::post('/survey/{survey}/answer', [\App\Http\Controllers\SurveyController::class, 'storeAnswer']);

//For Nurse page 
Route::post('/nurse/getDoctors', [AuthController::class, 'getAllDoctorsFromInstitute']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

