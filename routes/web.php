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

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('user_logout');
Route::get('/task/creative/view/{id}', 'Project\TaskController@view')->name('view_creatives');

Route::get('/clearcache', function() {
   Artisan::call('config:clear');
   Artisan::call('route:clear');
   Artisan::call('view:clear');
   Artisan::call('cache:clear');
   // return what you want
   echo 'All Cache Cleared!';
});
Route::group( ['middleware' => ['web', 'auth'] ], function()
{
//Users
// Route::get('/users', 'UserController@all')->name('all_users');
// Route::get('/users/json', 'UserController@index_json')->name('all_users_json');
// Route::get('/users/new', 'UserController@new_user')->name('new_user');

Route::get('get_all_leads', 'LeadsController@import')->name('import-all-leads');
Route::get('reupdate_lead_audit', 'LeadsController@reupdate_lead_audit')->name('reupdate_lead_audit');
Route::get('get_leads/{project}', 'LeadsController@import_leads')->name('import-leads');
Route::get('/leads/agr/datatables', 'LeadsController@agr_datatables')->name('agr_leads_datatable');
Route::get('/leads/hg/datatables', 'LeadsController@hg_datatables')->name('hg_leads_datatable');
Route::get('/leads/os/datatables', 'LeadsController@os_datatables')->name('os_leads_datatable');
Route::get('/leads/tsai/datatables', 'LeadsController@tsai_datatables')->name('tsai_leads_datatable');
Route::get('/leads/vib/datatables', 'LeadsController@vib_datatables')->name('vib_leads_datatable');
Route::get('/leads/et/datatables', 'LeadsController@et_datatables')->name('et_leads_datatable');
Route::get('/leads/jr/datatables', 'LeadsController@jr_datatables')->name('jr_leads_datatable');
Route::get('/leads/bp/datatables', 'LeadsController@bp_datatables')->name('bp_leads_datatable');
Route::get('/leads/js/datatables', 'LeadsController@js_datatables')->name('js_leads_datatable');
Route::get('/leads/padur/datatables', 'LeadsController@padur_datatables')->name('padur_leads_datatable');
Route::get('/leads/siruseri/datatables', 'LeadsController@siruseri_datatables')->name('siruseri_leads_datatable');
Route::get('/leads/ameenpur/datatables', 'LeadsController@ameenpur_datatables')->name('ameenpur_leads_datatable');
Route::get('/leads/bachu/datatables', 'LeadsController@bachu_datatables')->name('bachu_leads_datatable');
Route::get('/leads/gandimaisamma/datatables', 'LeadsController@gandimaisamma_datatables')->name('gandimaisamma_leads_datatable');
Route::get('/leads/{project}', 'LeadsController@index')->name('leads_index');
Route::get('/leads/view/{table_name}/{lead_id}', 'LeadsController@view')->name('lead_view');
Route::post('/lead_audits/store', 'LeadsController@store_lead_audit')->name('store_lead_audit');
Route::put('/lead_audits/update/{id}', 'LeadsController@update_lead_audit')->name('update_lead_audit');
Route::get('/audit_index/datatables', 'LeadsController@audit_index_datatables')->name('audit_index_datatable');
Route::get('/audit_index', 'LeadsController@audit_index')->name('audit_index');
Route::get('/agent_report', 'LeadsController@agent_report')->name('agent_report');
Route::get('/red_alert', 'LeadsController@red_alert')->name('red_alert');
Route::get('/zero_tolerance', 'LeadsController@zero_tolerance')->name('zero_tolerance');
Route::get('/export_lead_audit', 'LeadsController@export_lead_audit')->name('export_lead_audit');
Route::get('/get_lp_leads_data', 'LeadsController@get_lp_leads_data')->name('get_lp_leads_data');
Route::get('/send_red_alert_email', 'LeadsController@send_red_alert_email')->name('send_red_alert_email');

Route::get('/get_today_stage_activity/{project}', 'LeadsController@get_today_stage_activity')->name('get_today_stage_activity');



Route::get('/internal_leads_datatables', 'LeadsController@internal_leads_datatables')->name('internal_leads_datatables');
Route::get('/internal_leads_index', 'LeadsController@internal_leads_index')->name('internal_leads_index');
Route::get('/fb_leads_datatables', 'LeadImportController@fb_leads_datatables')->name('fb_leads_datatables');
Route::get('/fb_leads_index', 'LeadImportController@fb_leads_index')->name('fb_leads_index');
Route::get('/get_imported_leads_data', 'LeadImportController@get_imported_leads_data')->name('get_imported_leads_data');
Route::get('/get_lead_id/{project}/{number}', 'LeadImportController@get_lead_id')->name('get_lead_id');
Route::get('/update_lead_import_list', 'LeadImportController@update_lead_import_list')->name('update_lead_import_list');

Route::get('/get_leads_data', 'LeadsController@get_leads_data')->name('get_leads_data');
Route::get('/delete_lead_audit/{id}', 'LeadsController@delete_lead_audit')->name('delete_lead_audit');
Route::get('/get_google_analytics', 'LeadsController@get_google_analytics')->name('get_google_analytics');
Route::post('/facebook_lead_import', 'LeadImportController@facebook_lead_import')->name('facebook_lead_import');
Route::post('/facebook_lead_store', 'LeadImportController@facebook_lead_store')->name('facebook_lead_store');
Route::post('/tsai_lead_store', 'LeadImportController@tsai_lead_store')->name('tsai_lead_store');

//Users
Route::get('/users', 'UserController@index')->name('all_users');
Route::get('/users/datatables', 'UserController@datatables')->name('all_users_datatable');
Route::get('/users/new', 'UserController@new_user')->name('new_user');
Route::post('/users/store', 'UserController@store')->name('store_new_user');
Route::get('/users/edit/{id}', 'UserController@edit')->name('edit_user');
Route::get('/profile/{id}', 'UserController@profile')->name('profile_user');
Route::get('/activity/{id}', 'UserController@activity')->name('activity_user');
Route::post('/users/update/{id}', 'UserController@update')->name('update_user');
Route::post('/users/update_profile/{id}', 'UserController@update_profile')->name('update_profile');
Route::delete('/users/delete/{id}', 'UserController@delete')->name('delete_user');

//Users Prifle
Route::get('/profile/{id}', 'UserController@profile')->name('user_profile');

//Storage Routes
Route::get('/media_bunny_files', 'MediaController@index')->name('media_bunny_files');
Route::post('/store_media', 'MediaController@store_media')->name('store_media');


//DashBoard
Route::get('/', 'HomeController@index')->name('home');
Route::get('/get_email', 'HomeController@get_email')->name('get_email');
Route::get('/send_activity', 'HomeController@send_activity')->name('send_activity');
Route::get('/test_mail', 'HomeController@test_mail')->name('test_mail');
Route::get('/email_datatables', 'HomeController@email_datatables')->name('email_datatables');
Route::get('/mail_inbox', 'HomeController@mail_inbox')->name('mail_inbox');
Route::get('/create_task/{id}', 'HomeController@create_task')->name('create_task');
Route::get('/start_work', 'AttendanceController@start_work')->name('start_work');
Route::get('/stop_work', 'AttendanceController@stop_work')->name('stop_work');
Route::get('/stop_work_remote', 'AttendanceController@stop_work_remote')->name('stop_work_remote');
Route::get('/stop_all', 'AttendanceController@stop_all')->name('stop_all');
Route::get('/export_attendance', 'AttendanceController@exportAttendance')->name('export_attendance');
Route::get('/home', 'HomeController@index')->name('home');


Route::get('/permissions/datatables', 'Auth\PermissionController@datatables')->name('permissions_datatable');
Route::get('permissions', 'Auth\PermissionController@index')->name('permissions.index');
Route::get('permissions/create', 'Auth\PermissionController@create')->name('permissions.create');
Route::post('register_permissions', 'Auth\PermissionController@store')->name('register-new-permissions');
Route::get('/permissions/edit/{id}', 'Auth\PermissionController@edit')->name('edit_permissions');
Route::post('/permissions/update/{id}', 'Auth\PermissionController@update')->name('update_permissions');
Route::delete('/permissions/delete/{id}', 'Auth\PermissionController@destroy')->name('delete_permissions');

Route::get('/role/datatables', 'Auth\RoleController@datatables')->name('role_datatable');
Route::get('role', 'Auth\RoleController@index')->name('role.index');
Route::get('role/create', 'Auth\RoleController@create')->name('role.create');
Route::post('register_role', 'Auth\RoleController@store')->name('register-new-role');
Route::get('/role/edit/{id}', 'Auth\RoleController@edit')->name('edit_role');
Route::post('/role/update/{id}', 'Auth\RoleController@update')->name('update_role');
Route::delete('/role/delete/{id}', 'Auth\RoleController@destroy')->name('delete_role');

//Creative Task

Route::get('/task/datatables/{department}', 'Project\TaskController@datatables')->name('task_datatable');
Route::get('/web_push_notification', 'Project\TaskController@web_push_notification')->name('web_push_notification');
// Route::get('/tasks/all', 'Project\TaskController@index')->name('all_task');
Route::get('/get_task_data/{department}', 'Project\TaskController@get_task_data')->name('get_task_data');

Route::get('/task/adj', 'Project\TaskController@adj')->name('adj');

Route::get('/tasks/modal_view/{id}', 'Project\TaskController@modal_view')->name('modal_view');
Route::get('/tasks/quick_update', 'Project\TaskController@quick_update')->name('task_quick_update');
Route::get('/tasks/carbon_status_update', 'Project\TaskController@carbon_status_update')->name('carbon_status_update');
Route::post('/tasks/store_new_task', 'Project\TaskController@store')->name('store_new_task');
Route::get('/tasks/clone_task/{id}', 'Project\TaskController@clone')->name('clone_task');
Route::get('/tasks/delete_task/{id}', 'Project\TaskController@delete')->name('delete_task');
Route::get('/tasks/view_task/{id}', 'Project\TaskController@edit')->name('view_task');
Route::get('/tasks/task_delete/{id}', 'Project\TaskController@task_delete')->name('task_delete');
Route::put('/tasks/update_task/{id}', 'Project\TaskController@update_task')->name('update_task_details');
Route::put('/tasks/update_status/{id}', 'Project\TaskController@update_status')->name('task_update_status');
Route::put('/tasks/creative_status_update/{id}', 'Project\TaskController@creative_status_update')->name('creative_status_update');
//Creative Approval
Route::get('/task/approval/{id}', 'Project\TaskController@approval')->name('creative_approval');
Route::put('/task/approval_update/{id}', 'Project\TaskController@approval_update')->name('approval_update');
//Creative Handle
Route::post('/task/creative/store/{id}', 'Project\TaskController@store_creatives')->name('store_creative');
Route::put('/task/creatives/update/{id}', 'Project\TaskController@creative_update')->name('creatives_update');
Route::delete('/task/creative_image/delete/{id}', 'Project\TaskController@creative_delete')->name('delete_creative_iamge');

Route::get('/tasks/carbon/{department}', 'Project\TaskController@carbon_index')->name('carbon_index');
Route::get('/tasks/list/{department}', 'Project\TaskController@index')->name('task_list_index');

Route::get('/tasks/form/get_campaign', 'Project\TaskController@form_get_campaign')->name('task_get_campaign');
Route::get('/tasks/form/get_ad_campaign', 'Project\TaskController@form_get_ad_campaign')->name('task_get_ad_campaign');
Route::get('/tasks/form/get_milestone', 'Project\TaskController@form_get_milestone')->name('task_get_milestone');


Route::get('/tasks/add_new_sub_task', 'Project\TaskController@add_new_sub_task')->name('add_new_sub_task');
Route::get('/tasks/load_all_sub_task', 'Project\TaskController@load_all_sub_task')->name('load_all_sub_task');
Route::get('/tasks/update_sub_task', 'Project\TaskController@update_sub_task')->name('update_sub_task');
Route::get('/tasks/delete_sub_task', 'Project\TaskController@delete_sub_task')->name('delete_sub_task');
Route::get('/tasks/clone_sub_task', 'Project\TaskController@clone_sub_task')->name('clone_sub_task');
Route::get('/tasks/add_new_task', 'Project\TaskController@add_new_task')->name('add_new_task');
Route::get('/tasks/new_timer/{id}', 'Project\TaskController@new_timer')->name('new_timer');
Route::get('/tasks/stop_timer/{id}', 'Project\TaskController@stop_timer')->name('stop_timer');
// Route::get('/test_mail', 'Project\TaskController@test_mail')->name('test_mail');

//Sub Task Handle
Route::get('/tasks/sub_task_modal_view/{id}', 'Project\TaskController@sub_task_modal_view')->name('sub_task_modal_view');
Route::get('/tasks/sub_task_quick_update', 'Project\TaskController@sub_task_quick_update')->name('sub_task_quick_update');

// foreach(App\Setting::where('name', 'task_department')->get() as $result){
// 	$department = json_decode($result->value);
	
// 	Route::get('/tasks/carbon/'.$department->url, 'Project\TaskController@carbon_index')->name('carbon_'.$department->url);
// }


Route::get('/task/creative/quick', 'CreativeTaskController@quick')->name('task_creative_quick');


Route::get('/task/creative/create', 'CreativeTaskController@create')->name('task_creative_create');
Route::get('/task/creative/', 'CreativeTaskController@dataindex')->name('task_creative_index');

Route::get('/task/creatives/datatables', 'CreativeTaskController@datatables')->name('task_creative_datatable');
Route::get('/task/creatives/', 'CreativeTaskController@dataindex')->name('task_creative_dataindex');
// Route::get('/task/creative/json', 'CreativeTaskController@index_json')->name('task_creative_index_json');
Route::post('/task/creative/store', 'CreativeTaskController@store')->name('store_creative_task');
Route::get('/task/creative/edit/{id}', 'CreativeTaskController@edit')->name('edit_creative_task');
Route::put('/task/creative/update/{id}', 'CreativeTaskController@update')->name('update_creative_task');
Route::put('/task/creative/update_basic/{id}', 'CreativeTaskController@update_basic')->name('update_basic_creative_task');

Route::delete('/task/creative/delete/{id}', 'CreativeTaskController@destroy')->name('delete_creative');

Route::get('/task/creative/approval/{id}', 'CreativeTaskController@approval')->name('creative_approval');
Route::put('/task/creative/approval_update/{id}', 'CreativeTaskController@approval_update')->name('approval_update_creative_task');

Route::post('/task/creative_image/store/{id}', 'CreativeTaskController@store_creatives')->name('store_creative_image');
Route::put('/task/creative_image/update/{id}', 'CreativeTaskController@creative_update')->name('update_creative_image_task');

Route::delete('/task/creative_image/delete/{id}', 'CreativeTaskController@creative_delete')->name('delete_creative_iamge');

//Campaign
Route::get('/campaigns/datatables', 'CampaignController@datatables')->name('campaigns_datatable');
Route::get('/campaigns/', 'CampaignController@index')->name('campaign_index');
Route::get('/campaigns/json', 'CampaignController@index_json')->name('campaign_json');
Route::get('/campaigns/create', 'CampaignController@create')->name('campaign_create');
Route::post('/campaigns/store', 'CampaignController@store')->name('campaign_store');
Route::put('/campaigns/update/{id}', 'CampaignController@update')->name('campaign_update');
Route::get('/campaigns/details/{id}', 'CampaignController@details')->name('campaign_details');
Route::get('/campaigns/clone_campaign/{id}', 'CampaignController@clone_campaign')->name('clone_campaign');
Route::get('/delete_project_camp/{id}', 'CampaignController@delete_project_camp')->name('delete_project_camp');
Route::get('/delete_ad_camp/{id}', 'CampaignController@delete_ad_camp')->name('delete_ad_camp');
Route::delete('/delete_milestone/{id}', 'CampaignController@delete_milestone')->name('delete_milestone');
//Ad Campaign
Route::get('/adcamp-datatables/{id}', 'CampaignController@ad_camp_datatables')->name('ad_camp_datatables');
Route::get('/all_ad_camp_datatables', 'CampaignController@all_ad_camp_datatables')->name('all_ad_camp_datatables');
Route::get('/all_ad_camp_index', 'CampaignController@all_ad_camp_index')->name('all_ad_camp_index');
Route::post('/ad_campaigns/store_ad_campaign', 'CampaignController@store_ad_campaign')->name('store_ad_campaign');
Route::get('/ad_camp_details/{id}', 'CampaignController@ad_camp_details')->name('ad_camp_details');
Route::get('/spa/test_index', 'CampaignController@test_index')->name('test_index');
Route::get('/media_plan/media_plan_get_data', 'CampaignController@media_plan_get_data')->name('media_plan_get_data');
Route::get('/media_plan/media_plan_edit_data/{id}', 'CampaignController@media_plan_edit_data')->name('media_plan_edit_data');
Route::post('/media_plan/download_media_plan/{id}', 'CampaignController@download_media_plan')->name('download_media_plan');
Route::post('/media_plan/update_actuals/{id}', 'CampaignController@update_actuals')->name('update_actuals');
Route::get('/media_plan/delete_actuals/{id}', 'CampaignController@delete_actuals')->name('delete_actuals');
Route::get('/store_weekly_media_plan/{id}', 'CampaignController@store_weekly_media_plan')->name('store_weekly_media_plan');


Route::get('/spa/campaign/data_index', function() {
    return view('campaign.spa.data_index');
})->name('spa_data_index');
Route::get('/spa/campaign/create', function() {
    return view('campaign.spa.create');
})->name('spa_camp_create');

Route::get('/spa/data_index', function() {
    return redirect('/spa/test_index');
});
Route::get('/spa/create', function() {
    return redirect('/spa/test_index');
});



Route::get('/media_plan', 'CampaignController@media_plan_list')->name('media_plan_list');
Route::get('/media_plan/get/create', 'CampaignController@media_plan_create')->name('media_plan_create');
Route::get('/media_plan/get/edit', 'CampaignController@media_plan_edit')->name('media_plan_edit');
Route::get('/media_plan/get/details', 'CampaignController@media_plan_details')->name('media_plan_details');
Route::get('/media_plan/get/index', function(){
    return view('campaign.new.media_plan_index');
})->name('media_plan_index');




//MileStone
Route::post('/milestone_store', 'CampaignController@milestone_store')->name('milestone_store');

Route::get('ad_campaigns/create', function(){ return view('campaign.modal.new'); })->name('ad_camp_new');
Route::get('campaigns/camp_edit_popup', function(){ return view('campaign.modal.edit'); })->name('camp_edit_popup');


Route::post('/campaigns/store_creatives/{id}', 'CampaignController@store_creatives')->name('camp_store_creatives');
Route::post('/campaigns/store_paids/{id}', 'CampaignController@store_paids')->name('camp_store_paids');
Route::post('/campaigns/store_seo/{id}', 'CampaignController@store_seo')->name('camp_store_seo');
Route::post('/campaigns/store_web/{id}', 'CampaignController@store_web')->name('camp_store_web');
Route::post('/campaigns/store_lms/{id}', 'CampaignController@store_lms')->name('camp_store_lms');
Route::post('/campaigns/store_utm/{id}', 'CampaignController@store_utm')->name('camp_store_utm');
Route::post('/campaigns/store_content/{id}', 'CampaignController@store_content')->name('camp_store_content');

//Projects
Route::get('/projects/', 'ProjectController@index')->name('project_index');
Route::get('/projects/create', 'ProjectController@create')->name('project_create');
Route::post('/projects/store', 'ProjectController@store')->name('store_project');
Route::put('/projects/update/{id}', 'ProjectController@update')->name('update_project');
Route::get('/projects/details/{id}', 'ProjectController@details')->name('projects_details');
Route::get('/projects/delete/{id}', 'ProjectController@delete')->name('projects_delete');

//LMS Task
// Route::get('/task/lms/', 'TaskLMSController@index')->name('lms_index');
// Route::get('/task/lms/create', 'TaskLMSController@create')->name('lms_create');
// Route::post('/task/lms/store', 'TaskLMSController@store')->name('store_lms');
// Route::get('/task/lms/edit/{id}', 'TaskLMSController@edit')->name('edit_lms');
// Route::put('/task/lms/update/{id}', 'TaskLMSController@update')->name('update_lms');


//Web Task
Route::get('/task/web/datatables', 'TaskWebController@datatables')->name('web_datatable');
Route::get('/task/web/lp_datatables', 'TaskWebController@lp_datatables')->name('web_lp_datatable');
Route::get('/task/web/', 'TaskWebController@index')->name('web_index');
Route::get('/lp', 'TaskWebController@lp_index')->name('web_lp_index');
Route::get('/task/web/create', 'TaskWebController@create')->name('web_create');
Route::post('/task/web/store', 'TaskWebController@store')->name('store_web');
Route::get('/task/web/edit/{id}', 'TaskWebController@edit')->name('edit_web');
Route::put('/task/web/update/{id}', 'TaskWebController@update')->name('update_web');
Route::put('/task/web/update_status/{id}', 'TaskWebController@update_status')->name('update_web_task');
Route::put('/task/web/update_sub_status/{id}', 'TaskWebController@update_sub_status')->name('update_web_sub_task');
Route::delete('/task/web/delete/{id}', 'TaskWebController@destroy')->name('delete_web');

//Web Task
Route::get('/task/paid/quick', 'TaskPaidController@quick')->name('paid_quick');

Route::get('/task/lms/datatables', 'TaskLMSController@datatables')->name('lms_datatable');
Route::get('/task/lms/', 'TaskLMSController@index')->name('lms_index');
Route::get('/task/lms/create', 'TaskLMSController@create')->name('lms_create');
Route::post('/task/lms/store', 'TaskLMSController@store')->name('store_lms');
Route::get('/task/lms/edit/{id}', 'TaskLMSController@edit')->name('edit_lms');
Route::put('/task/lms/update/{id}', 'TaskLMSController@update')->name('update_lms');
Route::put('/task/lms/update_status/{id}', 'TaskLMSController@update_status')->name('update_lms_task');
Route::put('/task/lms/update_sub_status/{id}', 'TaskLMSController@update_sub_status')->name('update_lms_sub_task');
Route::get('/task/lms/destroy/{id}', 'TaskLMSController@destroy')->name('destroy_lms');


//UTM Task
Route::get('/task/utm/datatables', 'UTMController@datatables')->name('utm_datatable');
Route::get('/task/utm/', 'UTMController@index')->name('utm_index');
Route::get('/task/utm/create', 'UTMController@create')->name('utm_create');
Route::post('/task/utm/store', 'UTMController@store')->name('store_utm');
Route::get('/task/utm/edit/{id}', 'UTMController@edit')->name('edit_utm');
Route::put('/task/utm/update/{id}', 'UTMController@update')->name('update_utm');
Route::put('/task/utm/update_status/{id}', 'UTMController@update_status')->name('update_utm_task');
Route::delete('/utm/delete/{id}', 'UTMController@destroy')->name('delete_utm');


//Expense
Route::get('/exp/datatables', 'ExpenseController@datatables')->name('exp_datatable');
Route::get('/exp/', 'ExpenseController@index')->name('exp_index');
Route::get('/exp/create', 'ExpenseController@create')->name('exp_create');
Route::post('/exp/store', 'ExpenseController@store')->name('store_exp');
Route::get('/exp/edit/{id}', 'ExpenseController@edit')->name('edit_exp');
Route::put('/exp/update/{id}', 'ExpenseController@update')->name('update_exp');
Route::delete('/exp/delete/{id}', 'ExpenseController@destroy')->name('delete_exp');


//Forecast
// Route::get('/forecast/datatables', 'ForecastController@datatables')->name('forecast_datatable');
// Route::get('/forecast/', 'ForecastController@index')->name('forecast_index');
// Route::get('/forecast/create', 'ForecastController@create')->name('forecast_create');
// Route::post('/forecast/store', 'ForecastController@store')->name('store_forecast');
// Route::get('/forecast/edit/{id}', 'ForecastController@edit')->name('edit_forecast');
// Route::put('/forecast/update/{id}', 'ForecastController@update')->name('update_forecast');
// Route::delete('/forecast/delete/{id}', 'ForecastController@destroy')->name('delete_forecast');

//Web Task
Route::get('/task/paid/datatables', 'TaskPaidController@datatables')->name('paid_datatable');
Route::get('/task/paid/', 'TaskPaidController@index')->name('paid_index');
Route::get('/task/paid/create', 'TaskPaidController@create')->name('paid_create');
Route::post('/task/paid/store', 'TaskPaidController@store')->name('store_paid');
Route::get('/task/paid/edit/{id}', 'TaskPaidController@edit')->name('edit_paid');
Route::put('/task/paid/update/{id}', 'TaskPaidController@update')->name('update_paid');
Route::put('/task/paid/update_status/{id}', 'TaskPaidController@update_status')->name('update_paid_task');
Route::put('/task/paid/update_sub_status/{id}', 'TaskPaidController@update_sub_status')->name('update_paid_sub_task');


Route::get('/task/nct/nct_create', 'TaskPaidController@nct_create')->name('nct_create');
Route::get('/task/nct/nct_datatables', 'TaskPaidController@nct_datatables')->name('nct_datatables');
Route::get('/task/nct_index', 'TaskPaidController@nct_index')->name('nct_index');
Route::post('/task/nct/nct_store', 'TaskPaidController@nct_store')->name('nct_store');
Route::get('/task/nct/edit/{id}', 'TaskPaidController@nct_edit')->name('edit_nct');
Route::put('/task/nct/update/{id}', 'TaskPaidController@nct_update')->name('update_nct');
Route::put('/task/nct/update_status/{id}', 'TaskPaidController@nct_update_status')->name('update_nct_task');
Route::put('/task/nct/update_sub_status/{id}', 'TaskPaidController@nct_update_sub_status')->name('update_nct_sub_task');
Route::get('/task/nct/destroy/{id}', 'TaskPaidController@nct_destroy')->name('destroy_task');

//Aggregators
Route::get('/task/aggregators/aggregators_create', 'TaskPaidController@aggregators_create')->name('aggregators_create');
Route::get('/task/aggregators/aggregators_datatables', 'TaskPaidController@aggregators_datatables')->name('aggregators_datatables');
Route::get('/task/aggregators_index', 'TaskPaidController@aggregators_index')->name('aggregators_index');
Route::post('/task/aggregators/aggregators_store', 'TaskPaidController@aggregators_store')->name('aggregators_store');
Route::get('/task/aggregators/edit/{id}', 'TaskPaidController@aggregators_edit')->name('edit_aggregators');
Route::put('/task/aggregators/update/{id}', 'TaskPaidController@aggregators_update')->name('update_aggregators');
Route::put('/task/aggregators/update_status/{id}', 'TaskPaidController@aggregators_update_status')->name('update_aggregators_task');
Route::put('/task/aggregators/update_sub_status/{id}', 'TaskPaidController@aggregators_update_sub_status')->name('update_aggregators_sub_task');
Route::get('/task/aggregators/destroy/{id}', 'TaskPaidController@nct_destroy')->name('destroy_aggregators');

//Web Task
Route::get('/task/seo/datatables', 'TaskSEOController@datatables')->name('seo_datatable');
Route::get('/task/seo/', 'TaskSEOController@index')->name('seo_index');
Route::get('/task/seo/create', 'TaskSEOController@create')->name('seo_create');
Route::post('/task/seo/store', 'TaskSEOController@store')->name('store_seo');
Route::get('/task/seo/edit/{id}', 'TaskSEOController@edit')->name('edit_seo');
Route::put('/task/seo/update/{id}', 'TaskSEOController@update')->name('update_seo');
Route::put('/task/seo/update_status/{id}', 'TaskSEOController@update_status')->name('update_seo_task');
Route::put('/task/seo/update_sub_status/{id}', 'TaskSEOController@update_sub_status')->name('update_seo_sub_task');

//Content Task
Route::get('/task/content/datatables', 'TaskContentController@datatables')->name('content_datatable');
Route::get('/task/content/', 'TaskContentController@index')->name('content_index');
Route::get('/task/content/create', 'TaskContentController@create')->name('content_create');
Route::post('/task/content/store', 'TaskContentController@store')->name('store_content');
Route::get('/task/content/edit/{id}', 'TaskContentController@edit')->name('edit_content');
Route::put('/task/content/update/{id}', 'TaskContentController@update')->name('update_content');
Route::put('/task/content/update_status/{id}', 'TaskContentController@update_status')->name('update_content_task');
Route::put('/task/content/update_sub_status/{id}', 'TaskContentController@update_sub_status')->name('update_content_sub_task');

//Lead Audits
Route::get('/task/lead_audits/datatables', 'LeadAuditController@datatables')->name('lead_audits_datatable');
Route::get('/task/lead_audits', 'LeadAuditController@index')->name('lead_audits_index');
Route::post('/task/lead_audits/import', 'LeadAuditController@import')->name('import_lead_audits');


//Expenses
Route::get('/expenses', 'ExpenseController@index')->name('expenses_index');
Route::get('/expenses/create', 'ExpenseController@create')->name('expenses_create');
Route::post('/expenses/store', 'ExpenseController@store')->name('expenses_store');

//Setting
Route::get('/setting/', 'SettingController@index')->name('setting_index');
Route::get('/profile_overview/', 'SettingController@profile_overview')->name('profile_overview');
Route::post('/setting/store', 'SettingController@store')->name('setting_store');
Route::post('/setting/store/source', 'SettingController@store_source')->name('setting_store_source');
Route::delete('/setting/delete/{id}', 'SettingController@destroy')->name('delete_setting');
Route::get('/setting/task_department', 'SettingController@index_task_department')->name('index_task_department');
Route::post('/setting/store_task_department', 'SettingController@store_task_department')->name('store_task_department');
Route::post('/setting/store_lp', 'SettingController@store_lp')->name('store_lp');
Route::get('/setting/delete/{id}', 'SettingController@destroy')->name('del_setting');

//Settings All
Route::get('/activity_types/datatables', 'ActivityTypesController@datatables')->name('activity_types_datatable');
Route::get('/activity_types/', 'ActivityTypesController@index')->name('activity_types_index');
Route::get('/activity_types/create', 'ActivityTypesController@create')->name('activity_types_create');
Route::post('/activity_types/store', 'ActivityTypesController@store')->name('store_activity_types');
Route::get('/activity_types/edit/{id}', 'ActivityTypesController@edit')->name('edit_activity_types');
Route::put('/activity_types/update/{id}', 'ActivityTypesController@update')->name('update_activity_types');
Route::delete('/activity_types/delete/{id}', 'ActivityTypesController@destroy')->name('delete_activity_types');

//Reporting

Route::get('/report/creative_report', 'ReportController@creative_report')->name('creative_report');
Route::get('/report/creative_report_update', 'ReportController@creative_report_update')->name('creative_report_update');
Route::get('/report/creative_report_generate', 'ReportController@creative_report_generate')->name('creative_report_generate');
Route::get('/report/get_creative_report', 'ReportController@get_creative_report')->name('get_creative_report');
Route::post('/report/get_water_meter_data', 'ReportController@get_water_meter_data')->name('get_water_meter_data');
Route::get('/report/attendance_reports', 'ReportController@attendance_reports')->name('attendance_reports');



Route::get('/report/creative_report_show/{project}/{lead_id}', 'ReportController@creative_report_show')->name('creative_report_show');
Route::post('/report/store_creative_report', 'ReportController@store_creative_report')->name('store_creative_report');
Route::get('/report/show_creative_report', 'ReportController@show_creative_report')->name('show_creative_report');
Route::get('/report/get_data_range_list', 'ReportController@get_data_range_list')->name('get_data_range_list');

Route::get('/crud/create', 'CrudController@new')->name('crud_create');
Route::post('/crud/action', 'CrudController@action')->name('crud_action');


// testing
Route::get('/lead_import_2', 'LeadsController@import')->name('lead_import_2');

});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
 \UniSharp\LaravelFilemanager\Lfm::routes();
});