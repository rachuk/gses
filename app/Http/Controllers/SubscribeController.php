<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use stdClass;

class SubscribeController extends Controller
{
    public function subscribe(Request $request)
    {
        $data = new stdClass();
        $data->email = $request->email;


        $str = Storage::disk('local')->get('mail2.txt');
        if (strripos($str, $data->email) === false) {
            Storage::disk('local')->append('mail2.txt', $data->email);
            echo 'E-mail додано';
        } else echo 'E-mail вже є у списку';

        return view('subscribe');
    }
}

