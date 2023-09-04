<?php

namespace App\Http\Controllers;
use App\Models\Card;
use App\Models\FormAddNewCard;

use Illuminate\Http\Request;

class SearchGuestController extends Controller
{
     public function searchGuest(Request $request)
    {
        $query = $request->input('query');

        $cards = Card::where('title', 'LIKE', "%$query%")
            ->orWhere('location', 'LIKE', "%$query%")
            ->get();

        $form_add_new_cards = FormAddNewCard::where('title', 'LIKE', "%$query%")
            ->orWhere('location', 'LIKE', "%$query%")
            ->get();

        return view('search-results-guest', compact('cards', 'form_add_new_cards'));
    }
}