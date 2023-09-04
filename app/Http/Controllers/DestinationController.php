<?php

namespace App\Http\Controllers;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;


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
        return response()->json($destinations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

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
         return response()->json(['success' => true,'new-destination' => $destinations]);//devolver el result
        } else {
         return response()->json(['success' => false]);
         }   

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
                // 'user_id' => $destination->user_id,
                'title' => $destination->title,
                'description' => $destination->description,
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
    // public function edit(Destination $destination)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destination  $destination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'description' => 'required|string|max:500',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif'
          ]);
        
        
        $destination = Destination::findOrFail($id);
        //$destination->description=$request->description;
        // $destination->title=$request->title;
        // $destination->location=$request->location;
       
    // Procesar la imagen si se envía

    if ($request->hasFile('image')) {
        $filename=$request->file('image')->store('images', 'public');
        
            if ($destination->image) {
            Storage::delete($destination->image);
            }

        }else{
        $filename= $destination->image;
         }
    
        

        $destination->update([
            "description" => $request->description,
            "title" => $request->title,
            "location" => $request->location,
            "image" => $filename
        ]);

        

        return response()->json([
            'res' => true,
            'msg' => 'Destino actualizado correctamente',
            'data' => $destination
        ], 200);//304 revisar
        

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
            $destination = Destination::findOrFail($id);

           /* if ($destination ->user_id !== Auth::user()->id) {
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
        /*$destination = Destination::search($request->search);   
        return response()->json($destination);*/
        
        $query = $request->input('query');
        $results = Destination::search($query); // Utiliza el método de búsqueda en tu modelo
        return response()->json($results);


//Metodo adaptado del proyecto Yana
        /*$query = $request->input('query');

        $destinations = Destination::where('title', 'LIKE', "%$query%")
            ->orWhere('location', 'LIKE', "%$query%")
            ->get();

    
        return response()->json($destinations);*/

    }

}

