<?php

namespace App\Http\Controllers;

//import Http Request
use Illuminate\Http\Request;

//import model product
use App\Models\Card;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

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

    public function create(): View
    {
        return view('cards.create');
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'title'         => 'required',
            'message'       => 'required',
            'created_at'    => 'required',
            'updated_at'    => 'required'
        ]);

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('products', $image->hashName());

        //create product
        Card::create([
            'title'         => $request->title,
            'message'       => $request->message,
            'created_at'    => $request->created_at,
            'updated_at'    => $request->updated_at
        ]);

        //redirect to index
        return redirect()->route('cards.index')->with(['success' => 'Succesfully Stored!']);
    }

}
