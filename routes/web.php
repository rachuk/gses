<?php

use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;

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

Route::get('/rate', function () {
    $client = new CoinGeckoClient();
    $rate = $client->simple()->getPrice('0x,bitcoin', 'uah');
    return 'Поточний курс: ' . '1 BTC = ' . $rate['bitcoin']['uah'] . ' UAH';
});

Route::get('/subscribe', 'App\Http\Controllers\SubscribeController@subscribe')->name('subscribe');
Route::post('/subscribe', 'App\Http\Controllers\SubscribeController@subscribe')->name('subscribe');

Route::get('/sendEmails', 'App\Http\Controllers\FeedbackController@index')->name('feedback.index');
Route::post('/sendEmails', 'App\Http\Controllers\FeedbackController@send')->name('feedback.send');

