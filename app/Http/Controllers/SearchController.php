<?php

// namespace App\Http\Controllers;
// use App\Models\Card;
// use App\Models\FormAddNewCard;

// use Illuminate\Http\Request;

// class SearchController extends Controller
// {
//      public function search(Request $request)
//     {
//         $query = $request->input('query');

//         $cards = Card::where('title', 'LIKE', "%$query%")
//             ->orWhere('location', 'LIKE', "%$query%")
//             ->get();

//         $form_add_new_cards = FormAddNewCard::where('title', 'LIKE', "%$query%")
//             ->orWhere('location', 'LIKE', "%$query%")
//             ->get();

//         return view('search-results', compact('cards', 'form_add_new_cards'));
//     }
// }