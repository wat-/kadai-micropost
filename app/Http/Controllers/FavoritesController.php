<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）のお気に入りとして投稿を登録
        \Auth::user()->favorite($id);

        // 前のURLへリダイレクトさせる
        return back();
    }

    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）のお気に入りから投稿を削除
        \Auth::user()->unfavorite($id);

        // 前のURLへリダイレクトさせる
        return back();
    }
}
