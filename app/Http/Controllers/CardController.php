<?php

namespace App\Http\Controllers;

//import Http Request
use Illuminate\Http\Request;

//import model card
use App\Models\Card;

//import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

//import Facades Storage (For Image/File)
use Illuminate\Support\Facades\Storage;

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

    /**
     * create
     *
     * @return View
    */
    public function create(): View
    {
        return view('cards.create');
    }

    // public function store(Request $request)
    // {
    //     dd($request->all());
    // }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'title'         => 'required',
            'message'       => 'required'
        ]);

        //upload image
        // $image = $request->file('image');
        // $image->storeAs('cards', $image->hashName());

        //create card
        Card::create([
            'title'         => $request->title,
            'message'       => strip_tags($request->message), // remove all HTML
            'user_id'       => 1 // test
        ]);

        //redirect to index
        return redirect()->route('cards.index')->with(['success' => 'Succesfully Stored!']);
    }

    public function show(string $id): View
    {
        $card = Card::findOrFail($id);

        return view('cards.show',compact('card'));
    }

    public function edit(string $id) : View
    {
        $card = Card::findOrFail($id);

        return view('cards.edit',compact('card'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title'         => 'required',
            'message'       => 'required'
        ]);

        $card = Card::findOrFail($id);

        if ($request->hasFile('image')) {

            //delete old image
            // Storage::delete('products/'.$card->image);

            // //upload new image
            // $image = $request->file('image');
            // $image->storeAs('cards', $image->hashName());

            // //update product with new image
            // $card->update([
            //     'image'         => $image->hashName(),
            //     'title'         => $request->title,
            //     'description'   => $request->description,
            //     'price'         => $request->price,
            //     'stock'         => $request->stock
            // ]);

        } else {

            // update product without image
            $card->update([
                'title'         => $request->title,
                'description'   => $request->message
            ]);
        }

        return redirect()->route('cards.index')->with(['success' => 'Success']);

    }

    public function destroy($id): RedirectResponse
    {
        $card = Card::findOrFail($id);

        // delete image
        // Storage::delete('cards/'.$card->image);

        $card->delete();

        return redirect()->route('cards.index')->with(['success' => 'Deleted!']);
    }

}
