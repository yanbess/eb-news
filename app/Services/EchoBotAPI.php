<?php

namespace App\Services;

class EchoBotAPI
{
    public function post($path = '', $postData = [])
    {
        $ch = curl_init(config('app.echobot_api.url') . $path);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . env('ECHOBOT_API_ACCESS_TOKEN'),
            'Accept: application/vnd.echobot+json; version=3',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }
}
