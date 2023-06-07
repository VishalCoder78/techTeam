<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class cardController extends Controller
{
    public function store(Request $request)
    {
        $addCard = new Card;
        $addCard->title = $request->input('title');
        $addCard->list = $request->input('list');
        $addCard->save();
        return redirect('/board');
    }
    public function getCard()
    {
        $card = Card::all();
        return response()->json($card);
    }
}