<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{



    public function createOrder(Request $request)
    {

        Log::info($request);

        $existingCartItem = OrderItem::where('user_id', auth()->id())
            ->where('imdbID', $request->forFavourites['imdbID'])
            ->first();
        if ($existingCartItem) {
            return response()->json(null, 409);
        } else {
            $orderItem = OrderItem::create([
                'user_id' => auth()->id(),
                'imdbID' => $request->forFavourites['imdbID'],
                'Poster' => $request->forFavourites['Poster'],
                'Title' => $request->forFavourites['Title'],
                'Type' => $request->forFavourites['Type'],
                'Year' => $request->forFavourites['Year'],
                'Price' => $request->price,
                'Status' => "Не оплачено",
            ]);
            return response()->json($orderItem, 201);
        }
    }

    public function getOrders(Request $request)
    {
        $orderItems = OrderItem::where('user_id', auth()->id())->get();

        if (!$orderItems) {
            $orderItems = [];
        } else {
            $orderItems = $orderItems->map(function ($orderItem) {
                return [
                    "Title" => $orderItem->Title,
                    "Poster" => $orderItem->Poster,
                    "imdbID" => $orderItem->imdbID,
                    "Type" => $orderItem->Type,
                    "Year" => $orderItem->Year,
                    "created_at" => $orderItem->created_at,
                    "updated_at" => $orderItem->updated_at,
                    "user_id" => $orderItem->user_id,
                    "id" => $orderItem->updateidd_at,
                    "Price" => $orderItem->Price,
                    "Status" => $orderItem->Status,
                ];
            });
        }
        return response()->json($orderItems, 200);
    }

    // removeMovieFromOrders
    public function removeMovieFromOrders(Request $request)
    {
        $imdbID = $request->imdbID;
        $existingOrderItem = OrderItem::where('user_id', auth()->id())
            ->where('imdbID', $imdbID)
            ->first();
        if ($existingOrderItem) {
            $existingOrderItem->delete();
            return response()->json(
                ['imdbID' => $imdbID],
                204
            );
        } else {
            return response()->json(null, 404);
        }
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
