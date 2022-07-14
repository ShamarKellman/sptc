<?php

namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GetUsers
{
    public function fetch()
    {
        return Cache::remember(
            'users',
            now()->addHour(),
            function ()  {
                $json = Http::get('https://cspf-dev-challenge.herokuapp.com/')->json();

                $data = collect(Arr::get($json, 'data.rows'))->map(fn ($item) => [
                    'id' => $item['id'],
                    'first_name' => $item['fname'],
                    'last_name' => $item['lname'],
                    'email' => $item['email'],
                    'date' => Carbon::createFromTimestamp($item['date'])->toDayDateTimeString(),
                ]);

                return [
                    'title' => $json['title'],
                    'headers' => Arr::get($json, 'data.headers'),
                    'rows' => $data,
                ];
            }
        );
    }
}