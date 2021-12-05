<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();

        return response()->json([$items], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\ItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        Item::create([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return response()->json(['message' => "Successfully added"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return response()->json([$item], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        $item->save();

        return response()->json(['message' => "Successfully updated"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return response()->json(['message' => "Successfully deleted"], 200);
    }
}
