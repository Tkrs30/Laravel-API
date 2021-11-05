<?php

namespace App\Http\Controllers;

use App\Http\Resources\GlobalResources;
use App\Models\DataUser;
use Auth;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function get()
    {
        $data = DataUser::whereUserId(Auth::user()->id)->get();

        return GlobalResources::collection($data);
    }

    public function post(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $newdata = new DataUser;
        $newdata->name = $request->name;
        $newdata->user_id = Auth::user()->id;
        $newdata->save();

        return response()->json([
            'message' => 'Informations enregistrées',
        ]);
    }

    public function put(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = DataUser::whereId($id)->whereUserId(Auth::user()->id)->first();
        if (!$data) {
            return response()->json(['error' => 'Not authorized.'], 403);
        }
        $data->name = $request->name;
        $data->user_id = Auth::user()->id;
        $data->save();

        return response()->json([
            'message' => 'Informations modifiées',
        ]);
    }

    public function delete($id)
    {
        $data = DataUser::whereId($id)->whereUserId(Auth::user()->id)->first();
        if (!$data) {
            return response()->json(['error' => 'Not authorized.'], 403);
        }
        $data->delete();

        return response()->json([
            'message' => 'Informations effacées',
        ]);
    }
}
