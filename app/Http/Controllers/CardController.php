<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {

        $cards = Card::latest()->paginate(10);
        return view('cards', compact('cards'));
        /*return [
            "status" => 1,
            "data" => $cards
        ];*/

    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
                $validated = $request->validate([
                    'description' => 'required|string|max:500',
                    'title' => 'required|string|max:255',
                    'location' => 'required|string|max:255',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);
        
        $imagePath = $request->file('image')->store('images', 'public');

        $validated['image'] = $imagePath;

        $request->user()->cards()->create($validated);
 
        /*return redirect(route('dashboard'));*/

        $card = Card::create($request->all());
        return [
            "status" => 1,
            "data" => $card
        ];

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $guest_Card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return [
            "status" => 1,
            "data" =>$card
        ];//

        /* Proyecto TravelJoy 
        public function show(int $id)
            {
        $card = Card::findOrFail($id);
        return view('detail', compact('card'));
    }*/



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $guest_Card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $guest_Card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card):RedirectResponse
    {
        $this->authorize('update', $card);

        $request->validate([
            'description' => 'required|string|max:500',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        $card->update($validated);
 
        return redirect(route('dashboard'));
 
        /*$card->update($request->all());
 
        return [
            "status" => 1,
            "data" => $card,
            "msg" => "Register updated successfully"
        ];
        //


        /* Travel Joy

    public function update(Request $request, int $id)
        {
        $card = Card::findOrFail($id);
        $data = $request->validate([
        'image' => 'required',
        'title' => 'required',
        'location' => 'required',
        'description' => 'required',
    ]);

            $card->update([
            'image' => $data['image'],
            'title' => $data['title'],
            'location' => $data['location'],
            'description' => $data['reason'],
    ]);

        return redirect()->route('cards')->with('success', 'Registro actualizado exitosamente.');

         */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $guest_Card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
        $blog->delete();
        return [
            "status" => 1,
            "data" => $card,
            "msg" => "Register deleted successfully"
        ];

        /*Proyecto Travel Joy
        public function destroy(int $id)
            {
            $card = Card::findOrFail($id);
             $card->delete();
             return redirect()->route('cards')->with('success', 'Registro eliminado exitosamente.');
            }*/
    }


    //Controler de search

public function search(Request $request)
{
   $cards = Card::search($request->search);
    

    return view('cards', ['cards' => $cards]);
}
}