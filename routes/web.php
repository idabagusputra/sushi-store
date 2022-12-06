<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SushiMasterController;
use App\Http\Controllers\SushiController;
use App\Http\Controllers\SushiTypeController;

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

Route::get("/", function () {
    return Inertia::render("Welcome", [
        "canLogin" => Route::has("login"),
        "canRegister" => Route::has("register"),
        "laravelVersion" => Application::VERSION,
        "phpVersion" => PHP_VERSION,
    ]);
});

Route::middleware([
    "auth:sanctum",
    config("jetstream.auth_session"),
    "verified",
])->group(function () {
    // Sushis Endpoint
    Route::group(
        [
            "prefix" => "sushis",
            "as" => "sushis.",
        ],
        function () {
            Route::get("/", [SushiController::class, "index"])->name("index");
            Route::get("trashed", [SushiController::class, "trashed"])->name(
                "trashed"
            );
            Route::get("create", [SushiController::class, "create"])->name(
                "create"
            );
            Route::post("store", [SushiController::class, "store"])->name(
                "store"
            );
            Route::get("{id}/edit", [SushiController::class, "edit"])->name(
                "edit"
            );
            Route::put("{id}/update", [SushiController::class, "update"])->name(
                "update"
            );
            Route::get("{id}/destroy", [
                SushiController::class,
                "destroy",
            ])->name("destroy");
            Route::get("{id}/destroy-permanent", [
                SushiController::class,
                "destroy_permanent",
            ])->name("destroy_permanent");
            Route::get("{id}/restore", [
                SushiController::class,
                "restore",
            ])->name("restore");

            // Sushi Types Endpoint
            Route::group(
                [
                    "prefix" => "types",
                    "as" => "types.",
                ],
                function () {
                    Route::get("/", [
                        SushiTypeController::class,
                        "index",
                    ])->name("index");
                    Route::get("trashed", [
                        SushiTypeController::class,
                        "trashed",
                    ])->name("trashed");
                    Route::get("create", [
                        SushiTypeController::class,
                        "create",
                    ])->name("create");
                    Route::post("store", [
                        SushiTypeController::class,
                        "store",
                    ])->name("store");
                    Route::get("{id}/edit", [
                        SushiTypeController::class,
                        "edit",
                    ])->name("edit");
                    Route::put("{id}/update", [
                        SushiTypeController::class,
                        "update",
                    ])->name("update");
                    Route::get("{id}/destroy", [
                        SushiTypeController::class,
                        "destroy",
                    ])->name("destroy");
                    Route::get("{id}/destroy-permanent", [
                        SushiTypeController::class,
                        "destroy_permanent",
                    ])->name("destroy_permanent");
                    Route::get("{id}/restore", [
                        SushiTypeController::class,
                        "restore",
                    ])->name("restore");
                }
            );

            // Sushi Masters Endpoint
            Route::group(
                [
                    "prefix" => "masters",
                    "as" => "masters.",
                ],
                function () {
                    Route::get("/", [
                        SushiMasterController::class,
                        "index",
                    ])->name("index");
                    Route::get("trashed", [
                        SushiMasterController::class,
                        "trashed",
                    ])->name("trashed");
                    Route::get("create", [
                        SushiMasterController::class,
                        "create",
                    ])->name("create");
                    Route::post("store", [
                        SushiMasterController::class,
                        "store",
                    ])->name("store");
                    Route::get("{id}/edit", [
                        SushiMasterController::class,
                        "edit",
                    ])->name("edit");
                    Route::put("{id}/update", [
                        SushiMasterController::class,
                        "update",
                    ])->name("update");
                    Route::get("{id}/destroy", [
                        SushiMasterController::class,
                        "destroy",
                    ])->name("destroy");
                    Route::get("{id}/destroy-permanent", [
                        SushiMasterController::class,
                        "destroy_permanent",
                    ])->name("destroy_permanent");
                    Route::get("{id}/restore", [
                        SushiMasterController::class,
                        "restore",
                    ])->name("restore");
                }
            );
        }
    );
});
