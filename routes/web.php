<?php

use Illuminate\Support\Facades\Auth;
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


Route::get('/test-login', function () {
    $admin = \App\Models\Accounts::first();
    Auth::guard('user')->login($admin, true);
    return [
        'guard_check' => Auth::guard('user')->check(),
        'user' => Auth::guard('user')->user(),
        'default_check' => Auth::check(),
        'session' => session()->all()
    ];
});

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');
Route::get('register', ['uses' => 'UserAccounts\AccountsController@register', 'as' => 'register']);
Route::post('register', ['uses' => 'UserAccounts\AccountsController@registerProcess', 'as' => 'register.process']);
Route::post('register/check-your-email', ['uses' => 'UserAccounts\AccountsController@checkYourEmail', 'as' => 'register.checkYourEmail']);
Route::get('register/verify-email/{string}', ['uses' => 'UserAccounts\AccountsVerifyController@check', 'as' => 'register.verify']);
Route::get('login', ['uses' => 'UserAccounts\AccountsController@login', 'as' => 'login']);
Route::get('mail', ['uses' => 'TestController@mail', 'as' => 'mail']);
Route::get('forgot-password', ['uses' => 'UserAccounts\ForgotPasswordController@view', 'as' => 'forgot.password']);
Route::get('reset-password/{uuid}', ['uses' => 'UserAccounts\ForgotPasswordController@reset', 'as' => 'forgot.password.reset']);

# dashboard users
Route::middleware(['auth.user'])->prefix('dashboard')->as('dashboard.')->group(function () {
    Route::get('/', ['uses' => 'UserAccounts\DashboardController@home', 'as' => 'home']); //1
    Route::get('seasons', ['uses' => 'UserAccounts\DashboardController@gameSeasons', 'as' => 'game.seasons'])->middleware('payment.usability'); //2
    Route::get('season-{id}/', ['uses' => 'UserAccounts\DashboardController@team', 'as' => 'team']); //3
    Route::get('season-{id}/team-result/', ['uses' => 'UserAccounts\DashboardController@teamSearch', 'as' => 'team.search']); //4
    Route::get('season-{id}/team-{name_id}', ['uses' => 'UserAccounts\DashboardController@list', 'as' => 'team.list']); //5
    Route::get('team/create{id}', ['uses' => 'UserAccounts\DashboardController@createTeam', 'as' => 'team.create']); //6
    Route::post('team/create{id}', ['uses' => 'UserAccounts\DashboardController@createTeamProcess', 'as' => 'team.create.process']); //7
    Route::get('season-{id}/team-{name_id}/list-{list_id}/edit', ['uses' => 'UserAccounts\DashboardController@listEdit', 'as' => 'team.list.edit']); //8
    Route::post('season-{seasons_game_id}/team-{team_id}/list-{list_id}/edit', ['uses' => 'UserAccounts\ListOfTeamNamesController@edit', 'as' => 'list.edit']); //8
    Route::delete('season-{seasons_game_id}/team-{team_id}/list-{list_id}/delete', ['uses' => 'UserAccounts\ListOfTeamNamesController@delete', 'as' => 'list.delete']); //8
    Route::post('season-{seasons_game_id}/team-{team_id}/confirm', ['uses' => 'UserAccounts\ListOfTeamNamesController@confirm', 'as' => 'list.confirm']); //8
    Route::get('season-{id}/team-{name_id}/person', ['uses' => 'UserAccounts\DashboardController@dataEntry', 'as' => 'team.list.entry.person']); //9
    Route::post('insert-list{season_game_id}-{team_name_id}', ['uses' => 'UserAccounts\ListOfTeamNamesController@create', 'as' => 'list.create']); //10
    # payment
    Route::get('payment', ['uses' => 'UserAccounts\DashboardController@payment', 'as' => 'payment']);
    Route::post('payment', ['uses' => 'UserAccounts\DashboardController@paymentReceiptProcess', 'as' => 'payment.receipt.process']);

    Route::get('image-{id}', ['uses' => 'ImagesController@view', 'as' => 'image.view']);
    Route::get('logout', ['uses' => 'UserAccounts\DashboardController@logout', 'as' => 'logout']);
    # page print list
    Route::get('game-seasons-{game_season}/team-{team}/print-list/download', ['uses' => 'UserAccounts\PrintListController@download', 'as' => 'print.download']);
    Route::resource('my-club', 'UserAccounts\ClubActivityAddressController')->names('my_club');
});

# admin
Route::get('admin', ['uses' => 'Admin\AccountsAdminsController@login', 'as' => 'admin.login']);
Route::get('admin/logout', ['uses' => 'Admin\AccountsAdminsController@logout', 'as' => 'admin.logout']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth.admin', 'manage.application']], function () {


    Route::get('season-{id}/team-{name_id}/list-{list_id}/edit', ['uses' => 'UserAccounts\DashboardController@listEdit', 'as' => 'admin.team.list.edit']); //8
    Route::post('season-{seasons_game_id}/team-{team_id}/list-{list_id}/edit', ['uses' => 'UserAccounts\ListOfTeamNamesController@edit', 'as' => 'admin.list.edit']); //8


    Route::get('home', ['uses' => 'Admin\AdminController@home', 'as' => 'admin.home']);
    Route::get('guide', ['uses' => 'GuideController@list', 'as' => 'admin.guide']);
    Route::get('image-{id}', ['uses' => 'ImagesController@view', 'as' => 'admin.image.view']);
    Route::get('payment', ['uses' => 'Admin\AccountsAdminsController@payment', 'as' => 'admin.payment']);
    Route::post('payment/{id}', ['uses' => 'Admin\AccountsAdminsController@paymentConfirm', 'as' => 'admin.payment.confirm']);
    Route::delete('payment/{id}', ['uses' => 'Admin\AccountsAdminsController@paymentDelete', 'as' => 'admin.payment.delete']);
    Route::group(['prefix' => 'review'], function () {
        Route::group(['prefix' => 'confirmation'], function () {
            Route::get('/', ['uses' => 'Admin\Review\ConfirmationController@list', 'as' => 'admin.review.confirmation.list']);
            Route::get('show/{id}', ['uses' => 'Admin\Review\ConfirmationController@show', 'as' => 'admin.review.confirmation.show']);
            Route::get('confirm/{id}', ['uses' => 'Admin\Review\ConfirmationController@confirm', 'as' => 'admin.review.confirmation.approve']);
            Route::get('image-{id}', ['uses' => 'ImagesController@view', 'as' => 'admin.review.confirmation.image.view']);
            Route::post('report-{id}', ['uses' => 'Admin\Review\ReportDefectsController@store', 'as' => 'admin.review.confirmation.report.store']);
            Route::get('report-{id}/delete', ['uses' => 'Admin\Review\ReportDefectsController@destroy', 'as' => 'admin.review.confirmation.report.delete']);
        });
        Route::get('open-edit-{id}', ['uses' => 'Admin\Review\ControlOperateAccountsController@openEditTeamList', 'as' => 'admin.review.confirmation.open.edit']);
        Route::get('pre-check-{id}', ['uses' => 'Admin\Review\ConfirmationController@preCheck', 'as' => 'admin.review.confirmation.precheck']);
        Route::get('print-{id}', ['uses' => 'Admin\Review\PrintController@view', 'as' => 'admin.review.confirmation.print']);
    });
    Route::group(['prefix' => 'setting'], function () {
        Route::group(['prefix' => 'game-season'], function () {
            Route::get('list', ['uses' => 'Admin\GameSeasonController@list', 'as' => 'admin.setting.game_season.list']);
            Route::get('create', ['uses' => 'Admin\GameSeasonController@create', 'as' => 'admin.setting.game_season.create']);
            Route::post('store', ['uses' => 'Admin\GameSeasonController@store', 'as' => 'admin.setting.game_season.store']);
            Route::delete('destroy-{id}', ['uses' => 'Admin\GameSeasonController@destroy', 'as' => 'admin.setting.game_season.destroy']);
            Route::get('edit-{id}', ['uses' => 'Admin\GameSeasonController@edit', 'as' => 'admin.setting.game_season.edit']);
            Route::post('edit-{id}', ['uses' => 'Admin\GameSeasonController@update', 'as' => 'admin.setting.game_season.update']);
        });
    });
    Route::group(['prefix' => 'admin-users', 'as' => 'admin.admin_users.', 'middleware' => 'admin.manager'], function () {
        Route::get('/', ['uses' => 'Admin\AdminsUsersCRUDController@index', 'as' => 'index']);
        Route::get('create', ['uses' => 'Admin\AdminsUsersCRUDController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'Admin\AdminsUsersCRUDController@store', 'as' => 'store']);
        Route::delete('delete-{id}', ['uses' => 'Admin\AdminsUsersCRUDController@delete', 'as' => 'delete']);
        Route::get('status-{id}', ['uses' => 'Admin\AdminsUsersCRUDController@status', 'as' => 'status']);
        Route::resource('password-change', 'Admin\PasswordChangeAdminsController')->except(['delete', 'destroy', 'store', 'create', 'show', 'index', 'update']);
    });

    //    Route::group(['prefix' => 'fees', 'as' => 'fee.'], function(){
    //        Route::get('gateway', ['uses' => '', 'as' => 'gateway']);
    //        Route::get('verify', ['uses' => '', 'as' => 'verify']);
    //    });
});

Route::get('ok', ['uses' => 'ManageApplications\PaymentsController@bank_gateway', 'as' => 'checker']);



Route::post('/auth/userLogin', ['uses' => 'AuthController@userLogin']);
Route::post('/auth/forgot-password', ['uses' => 'AuthController@forgotPassword']);
Route::post('/auth/userRegister', ['uses' => 'AuthController@userRegister']);
Route::get('/chack/email/{action}/{email}', ['uses' => 'VerifyController@view', "as" => "verify.page"]);
Route::post('/chack/email/verify/{email}', ['uses' => 'VerifyController@verify']);
Route::post('/chack/email/verifyPass/{email}', ['uses' => 'VerifyController@verifyPass']);
Route::post('/auth/adminLogin', ['uses' => 'AuthController@adminLogin']);
