<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserRecordDataResource;
use App\Models\UserRecordData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRecordDataController extends Controller
{
    // Get All Data 
    public function index()
    {
        $currentUserId =  Auth::user()->id;
        $userRecordData = UserRecordData::where('user_id', '=',  $currentUserId)->get();
        return UserRecordDataResource::collection($userRecordData->loadMissing('user:id,username'))->additional([
            'meta' => [
                'code' => 200,
                'status' => 'Success',
                'message' => "Success"
            ],
        ]);
    }

    // Store data
    public function store(Request $request)
    {
        // MEALUKAN VALIDATION FORM HARUS TERSISI
        $request->validate([
            'bmi' => ['max:100'],
            'bmr' => ['max:100'],
        ]);
        $request['user_id'] = Auth::user()->id;

        $userRecordData = UserRecordData::create($request->all());
        return ((new UserRecordDataResource($userRecordData->loadMissing('user')))->additional([
            'meta' => [
                'code' => 200,
                'status' => 'Success',
                'message' => "Success"
            ],
        ]));
    }

    // Show detail data
    public function show($id)
    {

        $userRecordData = UserRecordData::findOrFail($id);
        // PANGGIL POLICY
        $this->authorize('view', $userRecordData);
        return ((new UserRecordDataResource($userRecordData->loadMissing('user')))->additional([
            'meta' => [
                'code' => 200,
                'status' => 'Success',
                'message' => "Success"
            ],
        ]));
    }

    // Update Data
    public function update(Request $request, $id)
    {
        $userRecordData = UserRecordData::findOrFail($id);
        $this->authorize('update', $userRecordData);

        $request->validate([
            'bmi' => ['max:100'],
            'bmr' => ['max:100'],
        ]);
        $userRecordData->update($request->all());
        return ((new UserRecordDataResource($userRecordData->loadMissing('user')))->additional([
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
        $userRecordData = UserRecordData::findOrFail($id);
        $this->authorize('delete', $userRecordData);

        $userRecordData->delete();
        $data = [
            'status' => true,
            'message' => 'Data deleted successfully',
        ];
        return response()->json($data);
    }
}
