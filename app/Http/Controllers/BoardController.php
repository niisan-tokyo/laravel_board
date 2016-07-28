<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Board;

class BoardController extends Controller
{

    public function getIndex()
    {
        $boards = Board::all();

        return view('board.index', ['boards' => $boards]);
    }

    public function getNew()
    {
        return view('board.new');
    }

    public function postCreate(Request $req)
    {
        $this->validate($req, [
            'title' => 'required|max:10',
            'content' => 'required'
        ]);

        $board = new Board();
        $board->title = $req->input('title');
        $board->content = $req->input('content');
        $board->save();

        return redirect('/boards');
    }
}
