<?php

namespace App\Http\Middleware;

use App\Models\Activity;
use App\Models\Diary;
use App\Models\Food;
use App\Models\UserRecordData;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureDataOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // CEK ID USER YANG SEDANG LOGIN
        $currentUserId =  Auth::user()->id;

        // CEK DATA YANG DIAKSES BERDASARKAN ID
        $userRecordDataBydId = UserRecordData::findOrFail($request->id);
        // $activity = Activity::findOrFail($request->id);
        // $diary = Diary::findOrFail($request->id);
        // $food = Food::findOrFail($request->id);

        if ($userRecordDataBydId->user_id !=  $currentUserId) {
            return response()->json(['message' => 'data not found'], 404);
        };

        return $next($request);
    }
}
