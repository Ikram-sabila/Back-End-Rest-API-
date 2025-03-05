<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(){
        $items = Item::all();
        return response()->json($items); 
    }

    public function show($id) {
        $items = Item::find($id);
        return response()->json($items);
    }

    public function update(Request $request, $id) {
        $items = Item::find($id);
        
        if (!$items) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $items->update([
            'nama'=>$request->nama,
            'jumlah'=>$request->jumlah,
            'harga'=>$request->harga
        ]);
        return response()->json($items, 200); 
    }

    public function store(Request $request) {
        $items = Item::create($request->all());
        return response()->json($items, 201);
    }

    public function destroy($id){
        Item::destroy($id);
        return response()->json(null, 204);
    }   
}
