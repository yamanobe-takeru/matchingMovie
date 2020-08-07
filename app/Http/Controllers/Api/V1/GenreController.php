<?php

namespace App\Http\Controllers\Api\V1;;

use App\Http\Resources\V1\GenreResource;
use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class GenreController extends Controller
{
    /**
     * ジャンル　一覧取得
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $genres = Genre::all();

        return GenreResource::collection($genres);
    }
}
