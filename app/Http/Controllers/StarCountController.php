<?php

namespace App\Http\Controllers;

use App\Models\StarCount;
use Log;

class StarCountController extends Controller
{
    public function store($star)
    {
        $stars = StarCount::latest()->first()?->star_count ?: 0; // get last star count value
        try {
            StarCount::create([
                'stars_id' => $star->id,
                'star_count' => $star->user_star + $stars
            ]);
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            abort(500, $exception->getMessage());
        }
    }
}
