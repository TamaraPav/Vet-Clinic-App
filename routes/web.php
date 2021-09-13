<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/login',[HomeController::class, 'login']);
Route::get("/logout",[HomeController::class, 'logout']);
Route::post('/register',[HomeController::class, 'register']);

Route::middleware('auth.user')->group(function(){
    Route::get('/user', [UsersController::class, 'index'])->name('user');
    Route::get('/user/edit', [UsersController::class, 'editUser'])->name('editUserU');
    Route::put('/user/update', [UsersController::class, 'updateUser'])->name('updateUser');

    Route::get('/user/{pet}', [PetController::class, 'showPet'])->name('pet');
    Route::get('/addPets', [PetController::class, 'addPet'])->name('addPets');
    Route::post('/addPet', [PetController::class, 'storePet'])->name('addPet');
    Route::get('/user/{pet}/edit', [PetController::class, 'editPet'])->name('editPet');
    Route::put('/user/{pet}', [PetController::class, 'updatePet'])->name('updatePet');
    Route::get('/user/deletePet/delete', [PetController::class, 'deletePet']);

    Route::get('/addApps/{pet}/add', [AppointmentsController::class, 'addApp'])->name('addApps');
    Route::post('/addApp', [AppointmentsController::class, 'storeApp'])->name('addApp');
    Route::delete('/addApps/{app}', [AppointmentsController::class, 'destroy'])->name('app.destroy');
    Route::get('/addVisit/{app}-{pet}', [VisitsController::class, 'addVisit'])->name('addVisit');
    Route::post('/addVisit/add', [VisitsController::class, 'storeVisit'])->name('addV');

    Route::get('/doctor', [DoctorController::class, 'index'])->name('doctor');
    Route::post('/doctors', [AppointmentsController::class, 'showAppToday'])->name('docAppsToday');
    Route::post('/doctor/addAppointment', [AppointmentsController::class, 'storeApp'])->name('doctor.addAppointment');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'],function(){
    Route::get('/activity',[ActivityController::class,'index'])->name('admin');
    Route::get('/activities',[ActivityController::class,'sort'])->name('activity');

    Route::get('/appointments',[AppointmentsController::class,'apps'])->name('admin.appointments');
    Route::get('/approve/{id}', [AppointmentsController::class, 'approve'])->name('admin.appointments.approve');
    Route::get('/decline/{id}', [AppointmentsController::class, 'decline'])->name('admin.appointments.decline');

    Route::get('/users',[UsersController::class,'showAllUsers'])->name('admin.users');
    Route::post('/add', [UsersController::class, 'addNewUser'])->name('addNewUser');

    Route::get('/pets',[PetController::class,'showAllPets'])->name('admin.pets');
    Route::get('/search',[PetController::class,'searchPet'])->name('admin.pets');

    Route::get('/doctors',[DoctorController::class,'showDoctors'])->name('admin.doctors');

    Route::get('/medications',[VisitsController::class,'showMeds'])->name('admin.medications');
    Route::post('/addNewMed',[VisitsController::class,'addMed'])->name('admin.addNewMed');

    Route::get('/diagnosis',[VisitsController::class,'showDiagnosis'])->name('admin.diagnosis');
    Route::post('/addNewDg',[VisitsController::class,'addDg'])->name('admin.addNewDg');

    Route::get('/types',[PetController::class,'showPetTypes'])->name('admin.types');
    Route::post('/addNewType',[PetController::class,'addType'])->name('admin.addNewType');
});

Route::middleware('auth.admin')->group(function(){
    Route::get('admin/deleteUser/{id}', [UsersController::class, 'deleteUser']);
    Route::get('admin/deleteType', [PetController::class, 'deleteType']);
    Route::get('admin/deleteMed', [VisitsController::class, 'deleteMed']);
    Route::get('admin/deleteDg', [VisitsController::class, 'deleteDg']);
    Route::get('admin/deletePet', [PetController::class, 'deletePet']);
    Route::get('admin/{pet}/edit', [PetController::class, 'editPet'])->name('editPet');
    Route::get('admin/updateUser/{id}', [UsersController::class, 'editUser'])->name('editUser');
    Route::post('admin/updateUser', [UsersController::class, 'updateUser'])->name('editUser');
});

Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::get('/author', [PagesController::class, 'author'])->name('author');

Route::get('/mail',[PagesController::class, 'contactAdmin'])->name('mail');
