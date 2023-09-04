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


    //return response()->json($destinations, 201);//plural o singular
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
            return response()->json($destination);
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
        $destination = Destination::findOrFail($id);

        $destination->description=$request->description;
        $destination->title=$request->title;
        $destination->location=$request->location;
       
    // Procesar la imagen si se envía
        if ($request->hasFile('image')) {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(storage_path('app/public'), $imageName);
        $destination->image = $imageName;

        if ($destination->image) {
            Storage::delete($destination->image);
        }

        $destination->image = $imagePath;
        }

        $result=$destination->save();

        // Actualizar campos si se proporcionan en la solicitud
        /*if ($request->filled('title')) {
        $destination->title = $request->input('title');
        }
        if ($request->filled('location')) {
        $destination->location = $request->input('location');
         }
        if ($request->filled('description')) {
        $destination->description = $request->input('description');
        }*/

    // Guardar los cambios en la base de datos
        //$destination->save();

        return response()->json([
            'res' => true,
            'msg' => 'Destino actualizado correctamente',
            'data' => $result
        ], 200);
        
        
        
        
        
        
        
        
        
        
        // $destinations = Destination::findOrFail($id);
        // $filestorage = public_path("storage\\".$destinations->image);
        // $filename="";

        // if($request->hasFile('new_file')){
            
        //     if(File::exists($filestorage)){
        //         File::delete($filestorage);
        //     }
        //     $filename=$request->file('new_image')->store('images', 'public');
        // } else{

        //     $filename=$request->image;
        //     $destinations->description=$request->description;
        //     $destinations->title=$request->title;
        //     $destinations->location=$request->location;
        //     $destinations->image=$filename;
            
        //     $result=$destinations->save();

        //     if($result){
        //         return response()->json(['success' => true]);
        //        } else {
        //         return response()->json(['success' => false]);
        //         }  

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
