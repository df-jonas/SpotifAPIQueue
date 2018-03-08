<?php

namespace App\Helpers;

use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class GuzzleHelper
{
    private const API_V1 = "https://api.spotify.com/v1/";
    private const API_ACCOUNTS = "https://accounts.spotify.com/";

    public static function request($verb, $path, $params, $headers)
    {
        $now = Carbon::now();
        $now->addMinutes(5);
        $expires = Carbon::createFromTimestamp(strtotime(Auth::user()->expires));

        if ($now->gte($expires)) {
            $a = json_decode(self::refresh(), true);
            $headers["Authorization"] = "Bearer " . $a['access_token'];
        }

        $client = new Client(['base_uri' => self::API_V1]);
        $response = $client->request($verb, $path, [
            'form_params' => $params,
            'headers' => $headers
        ]);

        return $response;
    }

    public static function refresh()
    {
        $client = new Client(['base_uri' => self::API_ACCOUNTS]);
        $response = $client->request("POST", "api/token", [
            'form_params' => [
                "grant_type" => "refresh_token",
                "refresh_token" => Auth::user()->refresh_token
            ],
            'headers' => [
                "Authorization" => "Basic " . base64_encode(env("SPOTIFY_KEY") . ":" . env("SPOTIFY_SECRET"))
            ]
        ]);
        $array = json_decode($response->getBody(), true);

        $expires = new DateTime();
        $expires->modify("+{$array['expires_in']} seconds");

        $user = Auth::user();
        $user->access_token = $array['access_token'];
        $user->expires = $expires;
        $user->save();

        return $response->getBody();
    }
}