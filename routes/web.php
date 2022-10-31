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

Route::get('{safe_url}', function ($safe_url) {
    dd($safe_url);
    $application = DB::table('Application')->where('domain', request()->getHost())->get()->firstOrFail();
    $page = DB::table('Page')->where([['application_id', $application->id], ['safe_name', $safe_url]])->get()->firstOrFail();
    if (!$page) {
        abort(404);
    }
    return view('hosted', ['application' => $application, 'page' => $page]);
});
