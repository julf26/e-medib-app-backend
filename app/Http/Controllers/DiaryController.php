<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\DiaryResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;

class DiaryController extends Controller
{
    // Get All Data 
    public function index(Request $request)
    {
        $tanggal = Carbon::parse($request->query('tanggal'))->format('Y-m-d');
        $currentUserId =  Auth::user()->id;
        $diary = Diary::where('user_id', '=',  $currentUserId)->whereDate('created_at', "LIKE", $tanggal)->orderBy('created_at', 'DESC')->get();
        return response()->json([
            "data" => $diary
        ]);
    }

    // Store data
    public function store(Request $request)
    {
        $request->validate([
            'gambar_luka_file' => ['nullable', 'image', 'mimes:jpg,jpeg,bmp,png'],
            'jenis_luka' => ['string',],
            'catatan_luka' => ['string',],
            'catatan' => ['string',]
        ]);
        $request['user_id'] = Auth::user()->id;

        $today = Carbon::today()->format('Y-m-d');
        if ($request->gambar_luka_file) {
            $gambar_luka_file = $request->file('gambar_luka_file');
            $path = $gambar_luka_file->storeAs('gambar-luka', 'gambar_luka' . '_' . $today . '_' . uniqid() . '.' . $gambar_luka_file->extension(), ['disk' => 'public']);
            $linkImage = Storage::url($path);
            $request['gambar_luka'] = $linkImage;
        } else {
            $request['gambar_luka'] = "";
        }

        $diary = Diary::create($request->all());
        return response()->json([
            "data" => $diary
        ]);
    }

    // Show detail data
    public function show($id)
    {
        $diary = Diary::findOrFail($id);
        // PANGGIL POLICY
        $this->authorize('view', $diary);
        return response()->json(["data" => $diary]);
    }

    // Update Data
    public function update(Request $request, $id)
    {
        $user = User::findOrFail(auth()->id());
        $diary = Diary::findOrFail($id);
        $this->authorize('update', $diary);

        $request->validate([
            'gambar_luka_file' => ['nullable', 'image', 'mimes:jpg,jpeg,bmp,png'],
            'catatan_luka' => ['string', 'nullable'],
            'catatan' => ['string', 'nullable'],
        ]);

        if ($request->hasFile('gambar_luka_file')) {
            $today = Carbon::today()->format('Y-m-d');
            $gambar_luka_file = $request->file('gambar_luka_file');
            $path = $gambar_luka_file->storeAs('gambar-luka', 'gambar_luka' . '_' . $today . '_' . uniqid() . '.' . $gambar_luka_file->extension(), ['disk' => 'public']);
            $linkImage = Storage::url($path);
            $request['gambar_luka'] = $linkImage;
        }

        $diary->update($request->all());
        return ((new DiaryResource($diary->loadMissing('user:id,username')))->additional([
            'meta' => [
                'code' => 200,
                'status' => 'Success',
                'message' => "Success"
            ],
        ]));
    }

    // Delete Data By Id
    public function destroy($id)
    {
        $diary = Diary::findOrFail($id);
        $this->authorize('delete', $diary);
        $diary->delete();
        $data = [
            'status' => true,
            'message' => 'Data deleted successfully',
        ];
        return response()->json($data);
    }
}
