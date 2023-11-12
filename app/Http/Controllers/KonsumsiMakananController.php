<?php

namespace App\Http\Controllers;

use App\Models\KonsumsiMakanan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsumsiMakananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = Carbon::parse($request->query('tanggal'))->format('Y-m-d');

        $currentUserId = Auth::user()->id;
        $queryParameter = $request->query('waktu_makan');
        $dataAll = KonsumsiMakanan::query()->where('jenis_waktu_makan', 'LIKE', $queryParameter)->where('user_id', '=', $currentUserId)->whereDate('created_at', "LIKE", $tanggal)->orderBy('kalori', 'DESC')->get();
        $totalKaloriSarapan = KonsumsiMakanan::query()->where('jenis_waktu_makan', 'LIKE', "SARAPAN")->where('user_id', '=', $currentUserId)->whereDate('created_at', "LIKE", $tanggal)->sum('kalori');
        $totalKaloriMakanSiang = KonsumsiMakanan::query()->where('jenis_waktu_makan', 'LIKE', "MAKAN_SIANG")->where('user_id', '=', $currentUserId)->whereDate('created_at', "LIKE", $tanggal)->sum('kalori');
        $totalKaloriMakanMalam = KonsumsiMakanan::query()->where('jenis_waktu_makan', 'LIKE', "MAKAN_MALAM")->where('user_id', '=', $currentUserId)->whereDate('created_at', "LIKE", $tanggal)->sum('kalori');
        $totalKaloriLainnya = KonsumsiMakanan::query()->where('jenis_waktu_makan', 'LIKE', "LAINNYA")->where('user_id', '=', $currentUserId)->whereDate('created_at', "LIKE", $tanggal)->sum('kalori');
        $totalKalori = KonsumsiMakanan::query()->whereDate('created_at', "LIKE", $tanggal)->sum('kalori');

        return response()->json([
            "data" => $dataAll,
            "total_kalori_sarapan" => $totalKaloriSarapan,
            "total_kalori_makan_siang" => $totalKaloriMakanSiang,
            "total_kalori_makan_malam" => $totalKaloriMakanMalam,
            "total_kalori_lainnya" => $totalKaloriLainnya,
            "total_kalori" => $totalKalori,
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
            'makanan' => ['string', 'required'],
            'porsi' => ['string', 'required'],
            'kalori' => ['string', 'required'],
            'jenis_waktu_makan' => ['string', 'required'],
            'kadar_glukosa' => ['string'],
            'kadar_karbohidrat' => ['string'],
            'kadar_protein' => ['string'],
            'kandungan_gizi_lainnya' => ['string'],
        ]);
        $request['user_id'] = Auth::user()->id;

        $konsumsi_makanan = KonsumsiMakanan::create($request->all());

        return response()->json(["data" => $konsumsi_makanan]);
    }

    /**
     * Display the specified resource.
     */
    public function show(KonsumsiMakanan $konsumsiMakanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KonsumsiMakanan $konsumsiMakanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KonsumsiMakanan $konsumsiMakanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KonsumsiMakanan $konsumsiMakanan)
    {
        //
    }
}
