<?php

namespace App\Http\Controllers;

use App\Models\Kolesterol;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KolesterolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = Carbon::parse($request->query('tanggal'))->format('Y-m-d');


        $currentUserId =  Auth::user()->id;
        $kolesterol = Kolesterol::where('user_id', '=',  $currentUserId)->whereDate('created_at', "LIKE", $tanggal)->orderBy('created_at', 'DESC')->get();
        return response()->json([
            "data" => $kolesterol
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
            'kolesterol' => ['string', 'min:1', 'required'],
        ]);

        $kolesterol = (float)$request['kolesterol'];
        $status = "";

        if ($kolesterol < 200) $status = "Baik";
        if ($kolesterol >= 200 and $kolesterol <= 239) $status = "Waspada";
        if ($kolesterol > 239) $status = "Bahaya";

        $kolesterol_data = Kolesterol::create([
            'kolesterol' => $kolesterol,
            'status' => $status,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(["data" => $kolesterol_data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kolesterol $kolesterol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kolesterol $kolesterol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kolesterol $kolesterol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kolesterol $kolesterol)
    {
        //
    }
}
