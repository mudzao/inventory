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
            'stock' => 'required|integer',
            'reorder_qty' => 'nullable|integer|min:0', // Optional, non-negative integer
        ]);
    
        // Create the item
        $item = new Item();
        $item->name = $validatedData['name'];
        $item->stock = $validatedData['stock'];
        $item->category_id = $validatedData['category_id'];
        $item->reorder_qty = $validatedData['reorder_qty'] ?? 0; // Default to 0 if not provided
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
    public function edit(Item $item)
    {
        // Pass the item to the edit view
        return view('items.edit', compact('item'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'reorder_qty' => 'nullable|integer|min:0', // Optional field for reorder quantity
        ]);

        // Update the item with the validated data
        $item->update($validatedData);

        // Redirect back to a relevant page, for example, the item list or show page
        return redirect()->route('items.show', $item->id)->with('success', 'Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        // Get the category ID before deleting the item
        $categoryId = $item->category_id;
    
        // Delete the item
        $item->delete();
    
        // Redirect to the categories.show page with the category ID
        return redirect()->route('categories.show', $categoryId)->with('success', 'Item deleted successfully.');
    }
}
