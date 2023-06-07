<?php

namespace App\Http\Controllers;

use App\Models\Board;

use Illuminate\Http\Request;

class boardsController extends Controller
{
    public function storeBoard(Request $request)
    {
        $formData = new Board;
        $formData->board = $request->input('board');
        // Assign values for other form fields as needed

        $formData->save();
        return redirect('/dashboard');
    }

    public function getBoard(Request $request)
    {
        $board = Board::all();
        return response()->json($board);
    }
}