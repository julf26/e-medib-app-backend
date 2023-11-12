<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $queryParameter = $request->query('tingkat_aktivitas');
        $aktivitas = Aktivitas::query()->where('tingkat_aktivitas', 'LIKE', $queryParameter)->orderBy('kalori', 'DESC')->get();

        return response()->json([
            "data" => $aktivitas,
        ]);
    }

    public function resetDataAktivitas()
    {
        $reset = Aktivitas::query()->update(['durasi' => '0', 'kalori' => "0"]);
        return response()->json([
            "data" => $reset
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $user = User::findOrFail(auth()->id());
        $aktivitas = Aktivitas::findOrFail($id);

        $request->validate([
            'durasi' => ['max:255', 'string', 'required'],
            'berat_badan' =>  ['max:255', 'string', 'required'],
        ]);

        $kalori = (float)$aktivitas['met'] * 0.0175 * (float)$request['berat_badan'] * (float)$request['durasi'];
        $data = [
            "nama_aktivitas" => $aktivitas['nama_aktivitas'],
            "met" => $aktivitas['met'],
            "durasi" => $request['durasi'],
            "kalori" => round($kalori),
            "tingkat_aktivitas" => $aktivitas['tingkat_aktivitas'],
            "user_id" => $user['id']
        ];

        $aktivitas->update($data);

        return response()->json([
            "data" => $aktivitas
        ]);
    }
}
