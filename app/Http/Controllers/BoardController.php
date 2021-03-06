<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Board;
use Strorage;

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

        $this->imageUpload($req, $board);

        return redirect('/boards');
    }

    public function getEdit($id)
    {
        $board = Board::find($id);
        if (! $board) {
            abort(404);
        }

        return view('board.edit', ['board' => $board]);
    }


    public function postUpdate(Request $req)
    {
        $this->validate($req, [
            'id' => 'required',
            'title' => 'required|max:10',
            'content' => 'required'
        ]);

        $board = Board::find($req->input('id'));
        if (! $board) {
            return redirect('/boards');
        }

        $board->title = $req->input('title');
        $board->content = $req->input('content');
        $this->imageUpload($req, $board, false);
        $board->save();

        return redirect('/boards');
    }

    public function getDelete($id)
    {
        $board = Board::find($id);
        $board->delete();

        return redirect('/boards');
    }

    private function imageUpload($req, $board, $save = true)
    {
        if ($req->hasFile('image')) {
            $file = $req->file('image');
            $filename = $board->id.'.'.$file->getExtension();
            $file->move(env('IMAGE_UPLOAD'), $filename);
            $board->image = $filename;
            if ($save) {
                $board->save();
            }
        }
    }
}
