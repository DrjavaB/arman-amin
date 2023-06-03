<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function search(Request $request)
    {
        $response = Http::get('https://moviesapi.ir/api/v1/movies', [
            "q" => $request->get('name') ?: '',
            "page" => $request->get('page') ?: 1
        ])->json();
        return $response;
    }
}
