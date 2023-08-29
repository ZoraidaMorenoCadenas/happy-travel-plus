<?php

namespace App\Http\Controllers;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$cards = Card::latest()->paginate(10);
        $cards = Card::all();
        return response()->json($cards);
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
    
    
     public function store(Request $request) : RedirectResponse
    {
        $validated = $request->validate([
            'description' => 'required|string|max:500',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', 
        ]);
     if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('images', 'public');
        $validated['image'] = $imagePath;
    }
 
        $card->update($validated);
        return redirect()->route('cards.index')->with('success', '¡Registro agregado exitosamente!');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $guest_Card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        try {
            $card = Card::findOrFail($id);
            return response()->json($card);
            
        } catch (\Exception $e) {
            return response()->json(['error' => 'El destino no se encontró.'], 404);
        }






        return [
            "status" => 1,
            "data" =>$card
        ];//

        /* Proyecto TravelJoy 
        public function show(int $id)
            {
        $card = Card::findOrFail($id);
        return view('detail', compact('card'));

        Proyecto Moni
        public function show($id)
{
    $travel = Travel::findOrFail($id);
    return view('show', compact('travel'));
}
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
    public function update(Request $request, Card $card)
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
        /*return redirect(route('dashboard'));*/

        $card->update($request->all());
 
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
    public function destroy(int $id)
    {
            try {
                $card = Card::findOrFail($id);
    
                if ($card ->user_id !== Auth::user()->id) {
                    return response()->json(['success' => false, 'error' => 'No tienes permiso para eliminar este destino.']);
                }
   
                $imagePath = public_path($card->image);
   
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
   
                $card->delete();
                return response()->json(['success' => true, 'message' => 'Destino eliminado exitosamente']);
            } catch (ModelNotFoundException $e) {
                return response()->json(['success' => false, 'error' => 'El destino no se encontró.']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'error' => $e->getMessage()]);
            }

            /*Proyecto Travel Joy
        public function destroy(int $id)
            {
            $card = Card::findOrFail($id);
             $card->delete();
             return redirect()->route('cards')->with('success', 'Registro eliminado exitosamente.');
            }*/
        }
    

        
    


    //Controler de search Travel Joy

    public function search(Request $request):JsonResponse
    {
        $cards = Card::search($request->search);            
        return response()->json($cards);
    }

        /*Moni proyecto 
        public function search(Request $request): JsonResponse
         {
        $searchTerm = $request->input('search');
        $travels = Travel::search($searchTerm);
        
        return response()->json($travels);
         }*/

}   