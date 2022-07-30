<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use stdClass;
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller {
    public function index() {
        return view('feedback.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
        ]);
        $client = new CoinGeckoClient();
        $rate = $client->simple()->getPrice('0x,bitcoin', 'uah');
        $data = new stdClass();
        $data->email = $request->email;
        $data->rate = '1 BTC = ' . $rate['bitcoin']['uah'] . ' UAH';

        $str = Storage::disk('local')->get('mail.txt');
            if (strripos($str, $data->email) === false) {
                Storage::disk('local')->append('mail.txt', $data->email);
                echo 'E-mail додано';
            } else echo 'E-mail вже є у списку';

        $arr = explode("\n", $str);

        foreach ($arr as $row) {
            if ($row != null) {
                Mail::to($row)->send(new FeedbackMailer($data));
            }
        }
        return redirect()->route('feedback.index')
            ->with('success', 'Поточний курс успішно відправлено на всі підписані електронні пошти');
    }
}
