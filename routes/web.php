		<?php

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
		Route::get('/clear-cache', function() {
		$exitCode = Artisan::call('cache:clear');
		// return what you want
		});
		Route::get('/', 'AdminController@index');
		Route::get('/check_login', 'AdminController@check_login')->name('check.login');

Route::group(['prefix' => 'admin','middleware' => 'App\Http\Middleware\Auth::class'], function () {

	Route::get('/', 'AdminController@index');
	Route::get('/home', 'AdminController@home')->name('admin.home');
	Route::get('/changepassword', 'AdminController@changepassword')->name('changepassword.edit');
	Route::post('/updatepassword', 'AdminController@updatepassword')->name('admin.updatepassword');
	Route::get('/logout', 'AdminController@logout')->name('logout.add');
	Route::get('/add-company', 'AdminController@AddCompany')->name('add-company');
	Route::post('/insert_company', 'AdminController@InsertCompany')->name('insert_company');
	Route::get('/get_company_list', 'AdminController@GetCompanyList')->name('get_company_list');
	Route::get('/get_company_list_view', 'AdminController@GetCompanyListView')->name('get_company_list_view');
	Route::get('/edit_company/{id}/', 'AdminController@EditCompany')->name('edit_company');
	Route::post('/useredit/', 'AdminController@useredit')->name('user.edit');
	Route::get('/view_company/{id}/', 'AdminController@ViewCompany')->name('view_company');
	Route::get('/company_delete/{id}/', 'AdminController@CompanyDelete')->name('company_delete');
	Route::post('/UpdateStatus/', 'AdminController@UpdateStatus')->name('UpdateStatus');
	Route::get('/get_technicians_list', 'AdminController@GetTechniciansList')->name('get_technicians_list');
	Route::get('/get_technicians_list_view', 'AdminController@GetTechniciansListView')->name('get_technicians_list_view');
	Route::get('/get_user_list', 'AdminController@GetUserList')->name('get_user_list');
	Route::get('/get_user_list_view', 'AdminController@GetUserListView')->name('get_user_list_view');
	Route::get('/edit_tecnician/{id}/', 'AdminController@EditTecnician')->name('edit_tecnician');
	Route::post('/update_tecnician/', 'AdminController@UpdateTecnician')->name('update_tecnician');
	Route::get('/technicians_delete/{id}/', 'AdminController@techniciansDelete')->name('technicians_delete');
	Route::get('/edit_user/{id}/', 'AdminController@EditUser')->name('edit_user');
	Route::post('/update_user/', 'AdminController@UpdateUser')->name('update_user');
	Route::get('/user_delete/{id}/', 'AdminController@UserDelete')->name('user_delete');
	Route::get('/add-ctechnician/', 'AdminController@AddCTechnician')->name('admin.cadd-technician');
	Route::post('/insert-ctechnician/', 'AdminController@InsertCTechnician')->name('insert-ctechnician');
	Route::get('/add-cuser/', 'AdminController@AddCuser')->name('admin.uadd-cuser');
	Route::post('/insert-cuser/', 'AdminController@InsertCuser')->name('insert-cuser');


	Route::get('/tutorial_catagory/', 'AdminController@TutorialCatagory')->name('tutorial_catagory');
	Route::get('/get_tutorial_list_view/', 'AdminController@GettutorialListView')->name('get_tutorial_list_view');
	Route::get('/add-tutorial/', 'AdminController@AddTutorial')->name('add-tutorial');
	Route::post('/insert-tutorial/', 'AdminController@InsertTutorial')->name('insert-tutorial');
	Route::get('/edit-tutorial/{id}/', 'AdminController@Edittutorial')->name('edit-tutorial');
	Route::post('/update-tutorial/', 'AdminController@Updatetutorial')->name('update-tutorial');
	Route::get('/delete-tutorial/{id}/', 'AdminController@DeleteTutorial')->name('delete-tutorial');

	Route::get('/tutorial/', 'AdminController@Tutorial')->name('tutorial');
	Route::get('/tutorial_list_view/', 'AdminController@TutorialListView')->name('tutorial_list_view');
	Route::get('/tutorial_view/{id}/', 'AdminController@TutorialView')->name('tutorial_view');
	Route::get('/add-ututorial/', 'AdminController@AddtUtutorial')->name('admin.add-tutorial');
	Route::post('/insert-ututorial/', 'AdminController@InserttUtutorial')->name('admin.insert-tutorial');
	Route::get('/edit-ututorial/{id}/', 'AdminController@EditUtutorial')->name('edit-ututorial');
	Route::post('/update-ututorial/', 'AdminController@UpdateUtutorial')->name('update-ututorial');
	Route::get('/delete-ututorial/{id}/', 'AdminController@DeleteUtutorial')->name('delete-ututorial');

	Route::get('/report/', 'AdminController@Report')->name('report');
	Route::get('/company_report_list_view/', 'AdminController@CompanyReportListView')->name('company_report_list_view');

	Route::get('/customer_report/', 'AdminController@CustomerReport')->name('customer_report');
	Route::get('/customer_report_list_view/', 'AdminController@CustomerReportListView')->name('customer_report_list_view');

	Route::get('/technicians_report/', 'AdminController@techniciansReport')->name('technicians_report');
	Route::get('/technicians_report_list_view/', 'AdminController@techniciansReportListView')->name('technicians_report_list_view');

	Route::get('/request_report/', 'AdminController@requestReport')->name('request_report');
	Route::get('/request_report_list_view/', 'AdminController@requestReportListView')->name('request_report_list_view');

	Route::get('/reject_request/{id}/', 'AdminController@Rejectrequest')->name('reject_request');
	Route::get('/accept_request/{id}/', 'AdminController@acceptrequest')->name('accept_request');
	Route::get('/check_mobile/', 'AdminController@check_mobile')->name('check_mobile');
	Route::get('/check_email/', 'AdminController@check_email')->name('check_email');
	Route::get('/subscription_plan_list/', 'AdminController@SubscriptionPlanList')->name('subscription_plan_list');
	Route::get('/get_subscription_plan_list/', 'AdminController@GetSubscriptionPlanList')->name('get_subscription_plan_list');
	Route::get('/add-subscription/', 'AdminController@AddSubscription')->name('add-subscription');
	Route::post('/insert-subscription/', 'AdminController@Inserttsubscription')->name('admin.insert-subscription');
	Route::get('/edit_subscription/{id}', 'AdminController@Editsubscription')->name('edit_subscription');
	Route::post('/update-subscription/', 'AdminController@Updatesubscription')->name('update-subscription');
	Route::get('/delete-subscription/{id}/', 'AdminController@Deletesubscription')->name('delete-subscription');
	Route::get('/equipment_list/', 'AdminController@EquipmentPlanList')->name('equipment_list');
	Route::get('/get_equipment_list/', 'AdminController@Getequipmentlist')->name('get_equipment_list');
	Route::get('/add-equipment/', 'AdminController@Addequipment')->name('add-equipment');
	Route::post('/insert-equipment/', 'AdminController@Inserttequipment')->name('admin.insert-equipment');
	Route::get('/edit_equipment/{id}', 'AdminController@Editequipment')->name('edit_equipment');
	Route::get('/view_equipment/{id}', 'AdminController@Viewequipment')->name('view_equipment');
	Route::post('/update-equipment/', 'AdminController@Updateequipment')->name('update-equipment');
	Route::get('/delete-equipment/{id}/', 'AdminController@Deleteequipment')->name('delete-equipment');

	Route::get('/get_employe_list', 'AdminController@GetemployeList')->name('get_employe_list');
	Route::get('/get_employe_list_view', 'AdminController@GetemployeListView')->name('get_employe_list_view');
	Route::get('/add-employe/', 'AdminController@Addemploye')->name('admin.uadd-employe');
	Route::post('/insert-employe/', 'AdminController@Insertemploye')->name('admin.insert-employe');
	Route::get('/edit_employe/{id}/', 'AdminController@Editemploye')->name('edit_employe');
	Route::post('/update_employe/', 'AdminController@Updateemploye')->name('update_employe');
    Route::get('/employe_delete/{id}/', 'AdminController@EmployeDelete')->name('employe_delete');
          
		});

Route::group(['prefix' => 'company','middleware' => 'App\Http\Middleware\Auth::class'], function () {


			Route::get('/index/{id}/', 'CompanyController@index')->name('index');
			Route::get('/home', 'CompanyController@home')->name('company.home');
			Route::get('/add-technician/{id}/', 'CompanyController@AddTechnician')->name('add-technician');
			Route::post('/insert-technician/', 'CompanyController@InsertTechnician')->name('insert-technician');
			Route::get('/add-user/{id}/', 'CompanyController@AddUser')->name('add-user');
			Route::post('/insert-user/', 'CompanyController@InsertUser')->name('insert-user');

			Route::get('/get_company_technicians_list/{id}', 'CompanyController@GetCompanyTechniciansList')->name('get_company_technicians_list');
			Route::get('/get_companytechnicians_list_view/{id}', 'CompanyController@GetCompanyTechniciansListView')->name('get_companytechnicians_list_view');

			Route::get('/get_companyuser_list/{id}', 'CompanyController@GetCompanyUserList')->name('get_companyuser_list');
			Route::get('/get_companyuser_list_view/{id}', 'CompanyController@GetCompanyUserListView')->name('get_companyuser_list_view');
			Route::get('/view_technician/{userid}&{id}/', 'CompanyController@ViewTechnician')->name('view_technician');
			Route::get('/view_user/{userid}&{id}/', 'CompanyController@ViewUser')->name('view_user');
			Route::get('/edit_perticular_company/{id}/', 'CompanyController@EditPerticularCompany')->name('edit_perticular_company');
			Route::post('/company_user_edit/', 'CompanyController@CompanyUseredit')->name('company_user_edit');
			Route::get('/service_catagory/{id}/', 'CompanyController@ServiceCatagory')->name('service_catagory');
			Route::get('/get_catagory_list_view/{id}/', 'CompanyController@GetCatagoryListView')->name('get_catagory_list_view');
			Route::get('/add-caragory/{id}/', 'CompanyController@AddCaragory')->name('add-caragory');
			Route::post('/insert-catagroy/', 'CompanyController@InsertCatagroy')->name('insert-catagroy');
			Route::get('/edit-caragory/{userid}&{id}/', 'CompanyController@EditCaragory')->name('edit-caragory');
			Route::post('/update-catagroy/', 'CompanyController@UpdateCatagroy')->name('update-catagroy');
			Route::get('/delete-catagroy/{userid}&{id}/', 'CompanyController@DeleteCatagroy')->name('delete-catagroy');

			Route::get('/service/{id}/', 'CompanyController@service')->name('service');
			Route::get('/get_service_list_view/{id}/', 'CompanyController@GetServiceListView')->name('get_service_list_view');
			Route::get('/add-service/{id}/', 'CompanyController@AddService')->name('add-service');
			Route::post('/insert-service/', 'CompanyController@InsertService')->name('insert-service');
			Route::get('/edit-service/{userid}&{id}/', 'CompanyController@EditService')->name('edit-service');
            Route::post('/update-service/', 'CompanyController@UpdateService')->name('update-service');
           Route::get('/delete-service/{userid}&{id}/', 'CompanyController@DeleteService')->name('delete-service');
           Route::get('/company_tutorial/{id}/', 'CompanyController@CompanyTutorial')->name('company_tutorial');
           Route::get('/company_tutorial_list_view/{id}/', 'CompanyController@CompanyTutorialListView')->name('company_tutorial_list_view');
           Route::get('/company_tutorial_view/{userid}&{id}/', 'CompanyController@CompanyTutorialView')->name('company_tutorial_view');
           Route::post('/report_detail/', 'CompanyController@ReportDetail')->name('report_detail');
           Route::post('/report_detail_custom/', 'CompanyController@ReportDetailCustom')->name('report_detail_custom');
			Route::get('/get_cemploye_list/{id}', 'CompanyController@GetcEmployeUserList')->name('get_cemploye_list');
		   Route::get('/get_cemploye_list_view/{id}', 'CompanyController@GetCemployeListView')->name('get_cemploye_list_view');
			Route::get('/add-employe/{id}/', 'CompanyController@Addemploye')->name('add-employe');
			Route::post('/insert-employe/', 'CompanyController@InsertEmploye')->name('insert-employe');
            Route::get('/view_employe/{userid}&{id}/', 'CompanyController@Viewemploye')->name('view_employe');
			
           

		});

Auth::routes();
Route::get('/login', 'HomeController@index')->name('home');
Route::post('/forgetpassworda/', 'AdminController@forgetpassworda')->name('forgetpassworda.get');  