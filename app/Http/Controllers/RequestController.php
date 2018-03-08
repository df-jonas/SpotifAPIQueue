<?php

namespace App\Http\Controllers;

use App\Helpers\GuzzleHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSpotifyUser()
    {
        return GuzzleHelper::request("GET", "me", [], ["Authorization" => "Bearer " . Auth::user()->access_token])->getBody();
    }

    public function searchsong(Request $request)
    {
        return GuzzleHelper::request("GET", "search?q={$request->q}&type=artist,track", [], ["Authorization" => "Bearer " . Auth::user()->access_token])->getBody();
    }
}
