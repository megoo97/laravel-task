<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DailyNewsResource;
use Illuminate\Support\Facades\Auth;

use App\Agencie;
use App\News;

class DailyNewsController extends Controller
{
    function index() {
        // not best authantication method for api but it's solve the case of return response in blade rather than view
        $user = Auth::user();
        if($user == null){
            return response()->json(401);
        }
        $agencies=Agencie::all();
        if($agencies == null){
            return response()->json(404);
        }
        foreach ($agencies as $agencie) {
            $agencie->latest_news=$agencie->latest_news();
        }
        return response()->json(DailyNewsResource::collection($agencies),200,[],JSON_UNESCAPED_SLASHES);
    }
}
