<?php

namespace App\Http\Controllers;

use App\Models\Star;
use Exception;
use Illuminate\Http\Request;
use Log;

class StarController extends Controller
{
    public function store(Request $request)
    {
        try {
            $star = Star::create([
                'name' => $request->name,
                'user_star' => $request->user_star
            ]);
        } catch (Exception $exception) {
            Log::info($exception->getMessage());
            abort(500, $exception->getMessage());
        }
        return response()->json([
            'message' => 'user star created successfully',
            'star' => $star->load('star_count')
        ]);
    }
}
