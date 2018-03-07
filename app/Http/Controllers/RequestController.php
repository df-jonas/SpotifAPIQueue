<?php

namespace App\Http\Controllers;

use App\Helpers\GuzzleHelper;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function getMe(){
        return GuzzleHelper::request("GET", "me", [], ["Authorization" => "Bearer " . Auth::user()->access_token])->getBody();
    }
}
