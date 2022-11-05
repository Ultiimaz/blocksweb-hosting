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
    $workspace = DB::table('Workspace')->where('domain', request()->getHost())->get()->first();
    if (!$workspace) {
        abort(404);
    }
    $page = DB::table('Page')->where([['workspace_id', $workspace->id], ['safe_name', "index"]])->get()->first();
    if (!$page) {
        abort(404);
    }
    return view('hosted', ['workspace' => $workspace, 'page' => $page]);
});


Route::get('{safe_url}', function ($safe_url) {
    $workspace = DB::table('Workspace')->where('domain', request()->getHost())->get()->first();
    if (!$workspace) {
        abort(404);
    }
    $page = DB::table('Page')->where([['application_id', $workspace->id], ['safe_name', $safe_url]])->get()->first();
    if (!$page) {
        abort(404);
    }
    return view('hosted', ['workspace' => $workspace, 'page' => $page]);
});
