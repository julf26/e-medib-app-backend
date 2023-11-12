<?php

namespace App\Http\Controllers;

use App\Models\AktivitasDariUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AktivitasDariUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tanggal = Carbon::parse($request->query('tanggal'))->format('Y-m-d');
        $queryParameter = $request->query('tingkat_aktivitas');
        $currentUserId =  Auth::user()->id;
        $aktivitasDariUser = AktivitasDariUser::query()->where('user_id', '=', $currentUserId)->where('tingkat_aktivitas', 'LIKE', $queryParameter)->whereDate('created_at', "LIKE", $tanggal)->orderBy('kalori', 'DESC')->get();

        $totalMenit = AktivitasDariUser::where('user_id', '=', $currentUserId)->where('tingkat_aktivitas', 'LIKE', $queryParameter)->whereDate('created_at', "LIKE", $tanggal)->orderBy('kalori', 'DESC')->sum('durasi');
        $totalKalori = AktivitasDariUser::where('user_id', '=', $currentUserId)->where('tingkat_aktivitas', 'LIKE', $queryParameter)->whereDate('created_at', "LIKE", $tanggal)->orderBy('kalori', 'DESC')->sum('kalori');

        return response()->json([
            "data" => $aktivitasDariUser,
            "total_menit" => $totalMenit,
            "total_kalori" => $totalKalori,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentUserId =  Auth::user()->id;
        $dataAlreadyStored = AktivitasDariUser::where('user_id', '=',  $currentUserId)->where('id_nama_aktivitas', "LIKE", $request['id_nama_aktivitas'])->exists();
        $request->validate([
            'id_nama_aktivitas' => ['required'],
            'nama_aktivitas' => ['string', 'required'],
            'met' => ['string', 'required'],
            'durasi' => ['string', 'required'],
            'berat_badan' =>  ['max:255', 'string', 'required'],
            'tingkat_aktivitas' => ['string', 'required'],
        ]);

        $kalori = (float)$request['met'] * 0.0175 * (float)$request['berat_badan'] * (float)$request['durasi'];

        $data = [
            "id_nama_aktivitas" => $request['id_nama_aktivitas'],
            "nama_aktivitas" => $request['nama_aktivitas'],
            "met" => $request['met'],
            "durasi" => $request['durasi'],
            "kalori" => round($kalori),
            "tingkat_aktivitas" => $request['tingkat_aktivitas'],
            "user_id" =>  Auth::user()->id
        ];

        if ($dataAlreadyStored) {
            return  response()->json([
                "status" => false,
                "message" => "Data aktivitas sudah ditambahkan",
            ], 500);
        } else {
            $createData = AktivitasDariUser::create($data);
            return response()->json([
                "data" => $createData
            ]);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail(auth()->id());
        $aktivitasDariUser = AktivitasDariUser::findOrFail($id);

        $request->validate([
            'durasi' => ['max:255', 'string', 'required'],
            'berat_badan' =>  ['max:255', 'string', 'required'],
        ]);

        $kalori = (float)$aktivitasDariUser['met'] * 0.0175 * (float)$request['berat_badan'] * (float)$request['durasi'];
        $data = [
            "nama_aktivitas" => $aktivitasDariUser['nama_aktivitas'],
            "met" => $aktivitasDariUser['met'],
            "durasi" => $request['durasi'],
            "kalori" => round($kalori),
            "tingkat_aktivitas" => $aktivitasDariUser['tingkat_aktivitas'],
            "user_id" => $user['id']
        ];
        $aktivitasDariUser->update($data);
        return response()->json([
            "data" => $aktivitasDariUser
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aktivitasDariUser = AktivitasDariUser::findOrFail($id);
        $aktivitasDariUser->delete();
        $data = [
            'status' => true,
            'message' => 'Data deleted successfully',
        ];
        return response()->json($data);
    }
}
