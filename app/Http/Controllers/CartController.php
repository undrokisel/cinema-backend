<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{



    public function addMovieToCart(Request $request)
    {
        $existingCartItem = CartItem::where('user_id', auth()->id())
            ->where('imdbID', $request->forFavourites['imdbID'])
            ->first();
        if ($existingCartItem) {
            return response()->json(null, 409);
        } else {
            $cartItem = CartItem::create([
                'user_id' => auth()->id(),
                'imdbID' => $request->forFavourites['imdbID'],
                'Poster' => $request->forFavourites['Poster'],
                'Title' => $request->forFavourites['Title'],
                'Type' => $request->forFavourites['Type'],
                'Year' => $request->forFavourites['Year'],
            ]);
            return response()->json($cartItem, 201);
        }
    }
    public function removeMovieFromCart(Request $request)
    {
        $imdbID = $request->imdbID;
        $existingCartItem = CartItem::where('user_id', auth()->id())
            ->where('imdbID', $imdbID)
            ->first();
        if ($existingCartItem) {
            $existingCartItem->delete();
            return response()->json(
                ['imdbID' => $imdbID],
                204
            );
        } else {
            return response()->json(null, 404);
        }
    }


    public function getCart(Request $request)
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();

        if (!$cartItems) {
            $cartItems = [];
        } else {
            $cartItems = $cartItems->map(function ($cartItem) {
                return [
                    "Title" => $cartItem->Title,
                    "Poster" => $cartItem->Poster,
                    "imdbID" => $cartItem->imdbID,
                    "Type" => $cartItem->Type,
                    "Year" => $cartItem->Year,
                    "created_at" => $cartItem->created_at,
                    "updated_at" => $cartItem->updated_at,
                    "user_id" => $cartItem->user_id,
                    "id" => $cartItem->updateidd_at,
                    
                ];
            });
        }
        return response()->json($cartItems, 200);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
