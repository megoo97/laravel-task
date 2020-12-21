<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DailyNewsResource;
use Illuminate\Support\Facades\Auth;
use App\Agencie;
use App\News;
use App\Http\Traits\DailyNewsTrait;

class DailyNewsController extends Controller
{
    use DailyNewsTrait;

    function index()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://json-server:3000/all');
        $results = $response->getBody();
        $results = json_decode($results, true);
        $results = $this->flattenArray($results);
        $results = $this->sortArraybyDateDesc($results);
        return response()->json($results, 200, [], JSON_UNESCAPED_SLASHES);
    }

    function filter(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://json-server:3000/all');
        $results = $response->getBody();
        $results = json_decode($results, true);
        $results = $this->flattenArray($results);

        if ($request->has('date') && $request->input('date')) {
            if ($request->has('date_sort') && $request->input('date_sort') == "ASC") {
                $results=$this->sortArraybyDateAsc($results);
            } else if ($request->has('date_sort') && $request->input('date_sort') == "DESC") {
                $results=$this->sortArraybyDateDesc($results);
            }
        }
        if ($request->has('rating') && $request->input('rating')) {
            if ($request->has('rating_sort') && $request->input('rating_sort') == "ASC") {
                $results=$this->sortArraybyRatingAsc($results);
            } else if ($request->has('rating_sort') && $request->input('rating_sort') == "DESC") {
                $results=$this->sortArraybyRatingDesc($results);
            }
        }
        return response()->json($results, 200, [], JSON_UNESCAPED_SLASHES);
    }
}
