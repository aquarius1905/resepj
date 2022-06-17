<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $inputs = $request->only(['shop_id']);
        $inputs['user_id'] = Auth::id();
        Like::create($inputs);

        return back();
    }

    public function destroy($id)
    {
        Like::find($id)->delete();

        return back();
    }
}
