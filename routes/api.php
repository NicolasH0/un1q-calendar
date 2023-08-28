<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    Route::apiResource('events', 'App\Domains\EventsApi\Http\Controllers\EventsApiController');
});

