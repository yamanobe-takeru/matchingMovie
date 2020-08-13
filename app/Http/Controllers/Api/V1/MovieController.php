<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MovieResource;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * 映画一覧
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {

        $movies = Movie::filter()->with(['genre'])->paginate(5);

        return MovieResource::collection($movies);
       // return view('movieInfo', ['movies' => $movies]);
    }

    /**
     * 映画　追加
     * @param Request $request
     * @return MovieResource
     */
    public function store(Request $request)
    {

        $movie = new Movie();

        $movie->content = $request->input('content');
        $movie->title = $request->input('title');
        $movie->director = $request->input('director');
        $movie->cast = $request->input('cast');
        $movie->time = $request->input('time');
        $movie->genre_id = $request->input('genre_id');
        $movie->user_id = $request->user()->id;

        $movie->save();
        //dd($request->user());

        return new MovieResource($movie);
    }

    /**
     * 映画　編集
     * @param Request $request
     * @param Movie $movie
     * @return MovieResource
     */
    public function update(Request $request, Movie $movie)
    {

        if ($request->has('content')) {
            $movie->content = $request->input('content');
            $movie->title = $request->input('title');
            $movie->cast = $request->input('cast');
            $movie->director = $request->input('director');
            $movie->time = $request->input('time');
            $movie->genre_id = $request->input('genre_id');
            //$movie->favorite = $request->input('favorite');


        }

        // $movie->favorite += 1;


        $movie->update();

        return new MovieResource($movie);
    }

    /**
     * 映画　削除
     * @param Movie $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function delete(Movie $movie)
    {
        $movie->delete();
        return response(null, 204);
    }


    /**悲しい　カウントアップ
     * @param Movie $movie
     * @return MovieResource
     */
    public function sadCountUp(Movie $movie)
    {

        // $movie->favorite = $request->input('favorite');//Vueで入力されたものが入るやつ
        //dd($request->input('favorite')); nullでした

        $movie->sad += 1;

        $movie->update();

        return new MovieResource($movie);
    }

    /**
     * 面白い　カウントアップ
     * @param Movie $movie
     * @return MovieResource
     */
    public function funnyCountUp(Movie $movie)
    {
        $movie->funny += 1;
        $movie->update();
        return new MovieResource($movie);
    }

    /**
     * 怖い　カウントアップ
     * @param Movie $movie
     * @return MovieResource
     */
    public function scareCountUp(Movie $movie)
    {

        $movie->scare += 1;

        $movie->update();

        return new MovieResource($movie);
    }

    /**
     * 感動　カウントアップ
     * @param Movie $movie
     * @return MovieResource
     */
    public function movedCountUp(Movie $movie)
    {
        $movie->moved += 1;
        $movie->update();
        return new MovieResource($movie);
    }

}
