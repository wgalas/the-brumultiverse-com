<?php

namespace App\Http\Controllers\Scholar;

use App\Models\Genre;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SongController extends Controller
{

    public function customValidate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'account' => 'required',
            'genre' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'lyrics' => 'required',
            'copyright' => '',
            'not_yet_copyrighted' => '',
            'cost' => ['numeric', 'gte:0'],
            'credit' => 'required',
            'cover' => ['image','max:2000'],
        ]);
    }


    public function getData()
    {
        return [
            Account::getApprovedAccountsFor(auth()->id()),
            Genre::forSong(),
        ];
    }


    public function index()
    {
        $songs = auth()->user()->songs;
        return view('scholar.song.index', compact('songs'));
    }

    public function create(Request $request)
    {
        [$accounts, $genres] = $this->getData();
        return view('scholar.song.create', compact('accounts', 'genres'));
    }
}
