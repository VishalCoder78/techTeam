<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class itemController extends Controller
{
    public function store(Request $request)
    {
        $addCard = new Item;
        $addCard->title = $request->input('title');
        $addCard->save();
        return redirect('/board');
    }
    public function getList()
    {
        $card = Item::all();
        return response()->json($card);
    }
}