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
    /*user*/
    Route::get('/user/setting',"HomeController@setting");
    Route::post('/user/setting/update',"HomeController@update_setting");
	/* Department Route */	
	Route::get('/departments',"DepartmentController@index");
	Route::get('/department/add',"DepartmentController@department_add");
	Route::post('/department/add',"DepartmentController@department_add");	
	Route::post('/department/update/{id}',"DepartmentController@department_update"); 
	Route::get('/department/edit/{id}',"DepartmentController@department_edit");
	Route::get('/department/delete/{id}',"DepartmentController@department_delete");

	/* Sub Department Route */	
	Route::get('/subdepartments',"DepartmentController@sub_departments");
	Route::get('/subdepartment/add',"DepartmentController@sub_department_add");
	Route::post('/subdepartment/add',"DepartmentController@sub_department_add");
	Route::post('/subdepartment/update/{id}',"DepartmentController@sub_department_update");
	Route::get('/subdepartment/edit/{id}',"DepartmentController@sub_department_edit");   
    Route::get('/subdepartment/delete/{id}',"DepartmentController@sub_department_delete");

	/* User Role Route */	
	Route::get('/roles',"RoleController@index");
	Route::get('/role/add',"RoleController@add"); 
	Route::post('/role/add',"RoleController@add"); 
	Route::get('/role/edit/{id}',"RoleController@edit");
	Route::post('/role/update/{id}',"RoleController@update");
	Route::get('/role/delete/{id}',"RoleController@delete");

	/* User Route */
	Route::get('/users',"UserController@index");
	Route::get('/user/add',"UserController@add"); 
	Route::post('/user/add',"UserController@add"); 
	Route::get('/user/edit/{id}',"UserController@edit");
	Route::post('/user/update/{id}',"UserController@update");
	Route::get('/user/delete/{id}',"UserController@delete");

    // Employee Route
    Route::get('/employees',"EmployeeController@index");
    Route::get('/employee/add',"EmployeeController@add");
    Route::post('/employee/add',"EmployeeController@add");
    Route::get('/employee/edit/{id}',"EmployeeController@edit"); 
    Route::post('/employee/update/{id}',"EmployeeController@update");
    Route::get('/employee/delete/{id}',"EmployeeController@delete"); 

    //Thank Card Route
    Route::get('home', 'HomeController@index'); 
    Route::post('search', 'HomeController@index'); 
    Route::get('thankcard/inbox/{id}','ThankCardController@receive');
    Route::post('thankcard/reply/{id}','ThankCardController@reply');
    Route::get('thankcard/sent','ThankCardController@sent');
    Route::post('thankcard/sent','ThankCardController@sent');
    Route::get('thankcard/sent/detail/{id}','ThankCardController@sent_detail');
    Route::get('thankcard/employees','ThankCardController@employeelist');
    Route::post('thankcard/employees/search','ThankCardController@employeelist');
    Route::get('thankcard/create/{name}/{id}','ThankCardController@createThankCard');
 	Route::post('thankcard/create/{name}/{id}','ThankCardController@createThankCard'); 
    Route::post('thankcard/print/card','ThankCardController@printThankCard');

 	//Report
 	Route::get('reports/department/thankcard/score','ReportController@thankCardScoreByDepartment');
 	Route::post('reports/department/thankcard/score','ReportController@thankCardScoreByDepartment');
 	Route::get('reports/employee/thankcard/receive/score','ReportController@receiveScoreByEmployee');
 	Route::post('reports/employee/thankcard/receive/score','ReportController@receiveScoreByEmployee');
 	Route::get('reports/employee/thankcard/receive/detail/{t_emp_id}/{dept_id}/{subdep_id}/{f_date}/{t_date}','ReportController@receiveScoreByEmployeeDetail'); 

 	Route::get('reports/employee/thankcard/sent/score','ReportController@sentScoreByEmployee');
 	Route::post('reports/employee/thankcard/sent/score','ReportController@sentScoreByEmployee');
 	Route::get('reports/employee/thankcard/sent/detail/{f_emp_id}/{dept_id}/{subdep_id}/{f_date}/{t_date}',
 		'ReportController@sentScoreByEmployeeDetail'); 

    Route::get('reports/thankcard/department/relation','ReportController@departmentRelation');
    Route::post('reports/thankcard/department/relation','ReportController@departmentRelation');

    //PDFReport
    Route::post('pdfreports/department/thankcard/score','ReportController@scoreByDepartmentPDF');
    Route::post('pdfreports/employee/thankcard/receive/score','ReportController@receiveScoreByEmployeePDF');
    Route::post('pdfreports/employee/thankcard/receive/detail','ReportController@receiveScoreDetailByEmployeePDF');
    Route::post('pdfreports/employee/thankcard/sent/score','ReportController@sentScoreByEmployeePDF');
    Route::post('pdfreports/employee/thankcard/sent/detail','ReportController@sentScoreDetailByEmployeePDF');
    Route::post('pdfreports/thankcard/department/relation','ReportController@departmentRelationPDF');

    //Activities
    Route::get('activities','HomeController@activities');
});