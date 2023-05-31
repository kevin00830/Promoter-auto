<?php

use App\Http\Controllers\GroupAdmin\FlowController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EntryController;

use App\Http\Controllers\GroupAdmin\DashboardController as GroupAdminDashboardController;
use App\Http\Controllers\GroupAdmin\HotMartController;
use App\Http\Controllers\GroupAdmin\EduzzController;
use App\Http\Controllers\GroupAdmin\RdStationController;
use App\Http\Controllers\GroupAdmin\MonetizeController;
use App\Http\Controllers\GroupAdmin\WoocommerceControler;
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
    if(Auth::check()) {
        return redirect('int_web_');

    }
    return view('auth/login');
});

Route::get('/lang/{lang}', function ($locale) {

    Session::put('locale',$locale);
    return redirect()->back();


});


// Auth routes
Auth::routes();

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('entry', EntryController::class)->name('entry');

//     // Group Admin Routes
//     Route::prefix('groupadmin')->middleware('groupadmin')->group(function () {
//         Route::get('dashboard', [GroupAdminDashboardController::class, 'index'])->name('groupadmin.dashboard');
//     });
// });
Route::group(['middleware' => 'auth'], function () {
    Route::get('entry', EntryController::class)->name('entry');
    Route::get('dashboard', [GroupAdminDashboardController::class, 'index'])->name('groupadmin.dashboard');
    Route::get('int_web', [GroupAdminDashboardController::class, 'int_web'])->name('groupadmin.int_web');
    Route::get('int_web_', [GroupAdminDashboardController::class, 'int_web_2'])->name('groupadmin.int_web_');
    Route::get('beta', [GroupAdminDashboardController::class, 'beta'])->name('groupadmin.beta');
    Route::post('ajax_save_main', [GroupAdminDashboardController::class, 'ajax_save_main'])->name('ajax.message.save_main');
    Route::post('ajax_save_option', [GroupAdminDashboardController::class, 'ajax_save_option'])->name('ajax.message.option_save');
    Route::post('ajax_del_option', [GroupAdminDashboardController::class, 'ajax_del_option'])->name('ajax.message.option_del');

    Route::post('del_main', [GroupAdminDashboardController::class, 'del_main'])->name('ajax.message.del_main');

    Route::post('delete-flow', [GroupAdminDashboardController::class, 'del_flow']);

    Route::get('flows/{id}', [GroupAdminDashboardController::class, 'get_flow']);

    Route::post('custom_json', [GroupAdminDashboardController::class, 'custom_json'])->name('custom_json');

    Route::post('web_integeration', [GroupAdminDashboardController::class, 'web_integeration'])->name('web_inte');

    Route::post('main_web_integeration', [GroupAdminDashboardController::class, 'main_web_integeration'])->name('main_web_inte');

    Route::post('clone_group', [GroupAdminDashboardController::class, 'cloneGroup'])->name('clone_group');

    Route::post('ajax_save_main_text', [GroupAdminDashboardController::class, 'ajax_save_main_text'])->name('ajax.message.save_main2');

    Route::post('ajax_save_main_keyword', [GroupAdminDashboardController::class, 'ajax_save_main_keyword'])->name('ajax.message.keyword');

    Route::post('ajax_save_new', [GroupAdminDashboardController::class, 'ajax_save_new'])->name('ajax.message.save_new');

    Route::post('ajax_save_setting', [GroupAdminDashboardController::class, 'ajax_save_setting'])->name('ajax.message.save_setting');

    //  All Instances
    Route::get('list-all-instances', [GroupAdminDashboardController::class, 'allInstances'])->name('all-instances');

    Route::post('custom_ajax', [GroupAdminDashboardController::class, 'custom_ajax'])->name('ajax.custom');
    //  new tabs
    Route::get('hotmart', [HotMartController::class, 'index'])->name('groupadmin.hotmart');
    Route::post('hotmart/update-key', [HotMartController::class, 'updateKey'])->name('groupadmin.hotmart.update.key');


    Route::get('eduzz', [EduzzController::class, 'index'])->name('groupadmin.eduzz');
    Route::get('rdstation', [RdStationController::class, 'index'])->name('groupadmin.rdstation');
    Route::get('monetizze', [MonetizeController::class, 'index'])->name('groupadmin.monetizze');

    Route::get('woocommerce', [WoocommerceControler::class, 'index'])->name('groupadmin.woocommerce');
    Route::post('woocommerce-oauth', [WoocommerceControler::class, 'generateOAuthUrl'])->name('groupadmin.woocommerce.oauth');
    Route::post('woocommerce/callback', [WoocommerceControler::class, 'handleCallback'])->name('groupadmin.woocommerce.callback');
    Route::post('woocommerce/update-messages', [WoocommerceControler::class, 'updateMessages'])->name('groupadmin.woocommerce.update.messages');
    Route::delete('woocommerce/delete/{id}', [WoocommerceControler::class, 'delete'])->name('api-woocommerce.delete');


    Route::post('submitdata', [GroupAdminDashboardController::class, 'submitdata'])->name('submitdata');

    Route::get('flowbuilder', [FlowController::class, 'flowbuilder'])->name('groupadmin.flowbuilder');
    Route::post('addFlow', [FlowController::class, 'addFlow'])->name('groupadmin.addFlow');
});


// Public Routes
Route::match(['get', 'post'], 'woocommerce/callback', [WoocommerceControler::class, 'handleCallback'])->name('groupadmin.woocommerce.callback');
Route::match(['get', 'post'], 'woocommerce/order/update', [WoocommerceControler::class, 'handleOrderUpdate'])->name('groupadmin.woocommerce.orderUpdate');
Route::match(['get', 'post'], 'hotmart/order/update', [HotMartController::class, 'handleOrderUpdate'])->name('groupadmin.hotmart.orderUpdate');
