<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $destinations = Destination::all();
        return response()->json([$destinations]);
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
    public function store(Request $request)
    {

        $destinations = new Destination();
        $validated = $request->validate([
        'description' => 'required|string|max:500',
        'title' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
      ]);

        $filename = "";

        if ($request->hasFile('image')) {
        $filename=$request->file('image')->store('images', 'public');
        /*$validated['image'] = $imagePath;*/
        //$imagePath = $request->file('image')->store('images', 'public');
        }else{
        $filename=Null;

    }
    
    $destinations->description=$request->description;
    $destinations->title=$request->title;
    $destinations->location=$request->location;
    $destinations->image=$filename;
    $result=$destinations->save();
    
        if($result){
         return response()->json(['success' => true]);
        } else {
         return response()->json(['success' => false]);
         }   


    return response()->json($destination, 201);//plural o singular
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function show(int $id): JsonResponse
    {

        try {
            $destination = Destination::findOrFail($id);
            return response()->json(
                ['id' => $destination->id,
                'user_id' => $destination->user_id,
                'title' => $destination->title,
                'location' => $destination->location,
                'image' => asset('storage/' . $destination->image_path) ]   );
        } catch (\Exception $e) {
            return response()->json(['error' => 'El destino no se encontró.'], 404);
        }

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destination $destination)
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
            $destination->update([
                'title' => $request->input('title'),
                'location' => $request->input('location'),
                'description' => $request->input('description')
             ]);

        
         return response()->json($destination, 200);
     }
        //

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id) 
    {
        try {
            $card = Card::findOrFail($id);

           /* if ($card ->user_id !== Auth::user()->id) {
                return response()->json(['success' => false, 'error' => 'No tienes permiso para eliminar este destino.']);
            }*/

            $imagePath = public_path($destination->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $destination->delete();
            return response()->json(['success' => true, 'message' => 'Destino eliminado exitosamente']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['success' => false, 'error' => 'El destino no se encontró.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }

       
    }

    public function search(Request $request):JsonResponse
    {   
        /*$cards = Card::search($request->search);   
        return response()->json($cards);*/
        
        $query = $request->input('query');
        $results = Destination::search($query); // Utiliza el método de búsqueda en tu modelo
        return response()->json($results);

    }

}

