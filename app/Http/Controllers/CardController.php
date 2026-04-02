<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import model product
use App\Models\Card;

//import return type View
use Illuminate\View\View;

class CardController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        //get all cards
        $cards = Card::latest()->paginate(10);

        //render view with cards
        return view('cards.index', compact('cards'));
    }
}
