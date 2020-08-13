<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{


    /**
     *テーブル 1対1
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function genre()
    {
        return $this->hasOne(Genre::class, 'id', 'genre_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * 検索フィルター
     * @param $query
     */
    public function scopeFilter($query)
    {
        $query->when(request('search_title'), function ($query, $value) {//whenはifみたいなもの,k
            $query->where('title', 'LIKE', '%' . $value . '%');//データベースに問合せ
        });


        $query->when(request('search_impression'), function ($query, $value) {
            switch ($value) {
                case 'sad':
                    $query->orderBy('sad', 'desc');
                    break;
                case 'funny':
                    $query->orderBy('funny', 'desc');
                    break;
                case 'scare':
                    $query->orderBy('scare', 'desc');
                    break;
                default:
                    $query->orderBy('moved', 'desc');
                    break;
            }

        });
        $query->when(request('search_genre'), function ($query, $value) {
                    $query->where('genre_id', '=', $value);
        });
    }
}



