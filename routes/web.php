<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::all();
        return response()->json($cards);
    }

    public function show($id)
    {
        $card = Card::findOrFail($id);

        return response()->json($card);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'location' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Resto del código para guardar la información del viaje...

        return response()->json(['message' => 'Destino agregado exitosamente']);
    }

    public function update(Request $request, $id)
    {
        // Resto del código para actualizar la información del viaje...

        return response()->json(['message' => 'Destino actualizado exitosamente']);
    }

    public function destroy($id): JsonResponse
    {
        // Resto del código para eliminar el viaje...

        return response()->json(['message' => 'Destino eliminado exitosamente']);
    }

    public function search(Request $request)
    {
        // Resto del código para buscar viajes...

        return response()->json($cards);
    }
}