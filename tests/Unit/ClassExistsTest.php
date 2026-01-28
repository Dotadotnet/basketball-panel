<?php

namespace Tests\Unit;

use App\Http\Controllers\AccountsAdminsController;
use App\Http\Controllers\Admin\GameSeasonController;
use App\Http\Controllers\Admin\Review\ConfirmationController;
use App\Http\Controllers\Admin\Review\PrintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\PaymentsUsabilitiesController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\UserAccounts\AccountsVerifyController;
use App\Http\Controllers\UserAccounts\ListOfTeamNamesController;
use App\Http\Controllers\UserAccounts\TokenController;
use PHPUnit\Framework\TestCase;

class ClassExistsTest extends TestCase
{
    /**
     * A basic unit test check exist class.
     *
     * @return void
     */
    public function test_check_exist_class()
    {
        $class_names = [
            // admin
            ConfirmationController::class,
            PrintController::class,
            GameSeasonController::class,
            AccountsAdminsController::class,

            // user client
            DashboardController::class,
            ListOfTeamNamesController::class,
            TokenController::class,
            AccountsVerifyController::class,
            PaymentsUsabilitiesController::class,
            // utilities
            FilesController::class,
            ToolsController::class,
            ImagesController::class,
        ];
        foreach ($class_names as $c) {
            if (class_exists($c)) {
                $this->assertTrue(true);
            } else {
                $this->assertTrue(false);
            }
        }
    }
}
