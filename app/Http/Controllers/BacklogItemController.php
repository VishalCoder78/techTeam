<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BacklogItem;

class BacklogItemController extends Controller
{
    public function getData()
    {
        return (
            BacklogItem::all()
        );
    }
}