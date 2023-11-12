<?php

namespace App\Http\Controllers;

use App\Models\GulaDarah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GulaDarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = Carbon::parse($request->query('tanggal'))->format('Y-m-d');

        $currentUserId =  Auth::user()->id;
        $gula_darah = GulaDarah::where('user_id', '=',  $currentUserId)->whereDate('created_at', "LIKE", $tanggal)->orderBy('created_at', 'DESC')->get();
        return response()->json([
            "data" => $gula_darah
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
            'gula_darah' => ['string', 'min:1', 'required'],
            'keterangan' => ['string', 'min:1', 'required'],
        ]);
        $request['user_id'] = Auth::user()->id;

        $gula_darah = (float)$request['gula_darah'];
        $status = "";

        if ($request['keterangan'] === "Berpuasa") {
            if ($gula_darah < 100) $status = "Normal";
            if ($gula_darah >= 100 and $gula_darah <= 125) $status = "Pre-diabetes";
            if ($gula_darah > 126) $status = "Tinggi";
        }

        if ($request['keterangan'] === "Sebelum Makan") {
            if ($gula_darah >= 70 and $gula_darah <= 100) $status = "Normal";
            if ($gula_darah >= 101 and $gula_darah <= 130) $status = "Sedang";
            if ($gula_darah > 130) $status = "Tinggi";
        }

        if ($request['keterangan'] === "Sesudah Makan") {
            if ($gula_darah >= 100 and $gula_darah <= 125) $status = "Normal";
            if ($gula_darah >= 126 and $gula_darah <= 180) $status = "Sedang";
            if ($gula_darah > 180) $status = "(Tinggi)";
        }

        $data_gula_darah = [
            'gula_darah' => $gula_darah,
            'keterangan' => $request['keterangan'],
            'status' => $status,
            'user_id' => Auth::user()->id
        ];

        $create_data_gula_darah = GulaDarah::create($data_gula_darah);

        return response()->json(["data" => $create_data_gula_darah]);
    }

    /**
     * Display the specified resource.
     */
    public function show(GulaDarah $gulaDarah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GulaDarah $gulaDarah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GulaDarah $gulaDarah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GulaDarah $gulaDarah)
    {
        //
    }
}
