<?php

namespace App\Http\Controllers;

use App\Models\Hba1c;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Hba1cController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = Carbon::parse($request->query('tanggal'))->format('Y-m-d');

        $currentUserId =  Auth::user()->id;
        $hba1c = Hba1c::where('user_id', '=',  $currentUserId)->whereDate('created_at', "LIKE", $tanggal)->orderBy('created_at', 'DESC')->get();
        return response()->json([
            "data" => $hba1c
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
            'kadar_hba1c' => ['string', 'min:1', 'required'],
        ]);

        $kadar_hba1c = (float)$request['kadar_hba1c'];
        $status = "";

        if ($kadar_hba1c < 5.7) $status = "Normal";
        if ($kadar_hba1c >= 5.7 and $kadar_hba1c <= 6.4) $status = "Pre-diabetes";
        if ($kadar_hba1c > 6.5) $status = "Diabetes";

        $hba1c_data = Hba1c::create([
            'kadar_hba1c' => $kadar_hba1c,
            'status' => $status,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(["data" => $hba1c_data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hba1c $hba1c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hba1c $hba1c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hba1c $hba1c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hba1c $hba1c)
    {
        //
    }
}
