<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);
    
        // Create the item
        $item = new Item();
        $item->name = $validatedData['name'];
        $item->stock = $validatedData['stock'];
        $item->category_id = $validatedData['category_id'];
        $item->save();
    
        // Redirect back to the category's show page after successful creation
        return redirect()->route('categories.show', $validatedData['category_id'])->with('success', 'Item added successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Fetch the item and paginate its histories
        $item = Item::with('histories')->findOrFail($id);
    
        // Paginate the histories
        $histories = $item->histories()->orderBy('created_at', 'desc')->paginate(10);
    
        return view('items.show', compact('item', 'histories'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
