<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',"UserController@login"); 
Route::post('/login',"UserController@login"); 
Route::get('logout','UserController@logout');
Route::get('unauthoirze','UserController@unauthoirze');

Route::group(['middleware' => ['checkuser']], function () {
    Route::get('home', 'HomeController@index'); 
    Route::get('/users',"UserController@index");
	Route::get('/user/add',"UserController@add");
	Route::get('/employees',"EmployeeController@index");
	Route::get('/employee/add',"EmployeeController@add");
	Route::get('/departments',"DepartmentController@index");
	Route::get('/departments/add',"DepartmentController@department_add");
	Route::get('/subdepartments',"DepartmentController@sub_departments");
	Route::get('/subdepartment/add',"DepartmentController@sub_department_add");
	Route::get('/roles',"RoleController@index");
	Route::get('/role/add',"RoleController@add"); 
	Route::post('/role/add',"RoleController@add"); 
	Route::get('/role/edit/{id}',"RoleController@edit");
	Route::post('/role/update/{id}',"RoleController@update");
	Route::get('/role/delete/{id}',"RoleController@delete");
});