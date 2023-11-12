<?php

namespace App\Http\Controllers;

use App\Models\Rekap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Perlu ditambahkan filder 7 hari
        $currentUserId =  Auth::user()->id;
        $rekap = Rekap::where('user_id', '=',  $currentUserId)->get();
        return response()->json([
            "data" => $rekap
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gula_darah' => ['string', 'required'],
            'kolesterol' => ['string',  'required'],
            'gambar_luka' => ['string', 'required'],
            'catatan_luka' => ['string',  'required'],
            'total_konsumsi_kalori' => ['string',  'required'],
            'total_pembakaran_kalori' => ['string',  'required'],
            'catatan' => ['string',  'required'],
        ]);
        $request['user_id'] = Auth::user()->id;

        $createRekapData = Rekap::create($request->all());
        return response()->json(["data" => $createRekapData]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $currentUserId =  Auth::user()->id;

        $rekap = Rekap::findOrFail($id)->where('user_id', '=',  $currentUserId)->get();
        return response()->json(["data" => $rekap]);
    }
}
