<?php

namespace App\Http\Controllers;

use App\Http\Resources\BMRResource;
use App\Models\BMR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BMRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUserId =  Auth::user()->id;
        $bmr = BMR::where('user_id', '=',  $currentUserId)->orderBy('created_at', 'DESC')->get();
        return response()->json([
            "data" => $bmr
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_kelamin' => ['string', 'max:1', 'required'],
            'tinggi_badan' => ['string', 'min:1', 'required'],
            'berat_badan' => ['string', 'min:1', 'required'],
            'usia' => ['string', 'min:1', 'max:100', 'required'],
        ]);
        $request['user_id'] = Auth::user()->id;

        $berat_badan = (float)$request['berat_badan'];
        $tinggi_badan = (float)$request['tinggi_badan'];
        $usia = (float)$request['usia'];
        $bmr = 0;

        if ($request['jenis_kelamin'] === "L") {
            $bmr = round(66.5 + (13.7 * $berat_badan) + (5 * $tinggi_badan) - (6.8 * $usia), 2);
        }

        if ($request['jenis_kelamin'] === "P") {
            $bmr = round(655 + (9.6 * $berat_badan) + (1.8 * $tinggi_badan) - (4.7 * $usia), 2);
        }

        $bmr_data = BMR::create([
            'jenis_kelamin' => $request['jenis_kelamin'],
            'tinggi_badan' =>  $tinggi_badan,
            'berat_badan' => $berat_badan,
            'usia' =>  $usia,
            'bmr' => $bmr,
            'status' => 'belum dibuat',
            'user_id' => Auth::user()->id,
        ]);

        return new BMRResource($bmr_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(BMR $bMR)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BMR $bMR)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BMR $bMR)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BMR $bMR)
    {
        //
    }
}
