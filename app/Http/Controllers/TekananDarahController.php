<?php

namespace App\Http\Controllers;

use App\Models\TekananDarah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TekananDarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = Carbon::parse($request->query('tanggal'))->format('Y-m-d');

        $currentUserId =  Auth::user()->id;
        $tekanan_darah = TekananDarah::where('user_id', '=',  $currentUserId)->whereDate('created_at', "LIKE", $tanggal)->orderBy('created_at', 'DESC')->get();;
        return response()->json([
            "data" => $tekanan_darah
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
            'sistolik' => ['string', 'min:1', 'required'],
            'diastolik' => ['string', 'min:1', 'required'],
        ]);
        $request['user_id'] = Auth::user()->id;

        $sistolik = (float)$request['sistolik'];
        $diastolik = (float)$request['diastolik'];
        $status = "";

        if ($sistolik < 120 and $diastolik < 80) $status = "Normal";
        if (($sistolik >= 120 and $sistolik <= 139) or ($diastolik >= 80 and $diastolik <= 89)) $status = "Pre-Hipertensi";
        if ($sistolik > 139 and $diastolik > 89) $status = "Hipertensi ";

        $data_tekanan_darah = TekananDarah::create([
            'sistolik' => $sistolik,
            'diastolik' => $diastolik,
            'status' => $status,
            'user_id' => Auth::user()->id
        ]);

        return response()->json(["data" => $data_tekanan_darah]);
    }

    /**
     * Display the specified resource.
     */
    public function show(TekananDarah $tekananDarah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TekananDarah $tekananDarah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TekananDarah $tekananDarah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TekananDarah $tekananDarah)
    {
        //
    }
}
