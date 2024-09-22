<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all categories
        $categories = Category::all();

        // Return the categories to the 'home' view
        return view('home', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new category in the database
        Category::create([
            'name' => $request->input('name'),
        ]);

        // Redirect or return a response after creation
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        $items = $category->items()->orderBy('name', 'asc')->get();

        // Return a view with the category data
        return view('categories.show', compact('category', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // Add other fields you may want to update
        ]);

        // Update the category with the validated data
        $category->update($validatedData);

        // Redirect back to a relevant page (for example, the category list)
        return redirect()->route('categories.show', $category->id)->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Check if the category has items and redirect to the category edit page if it cannot be deleted
        if ($category->items()->count()) {
            return redirect()->route('categories.edit', $category->id)->with('error', 'Category cannot be deleted because it has associated items.');
        }

        // Delete the category
        $category->delete();

        // Redirect to the home page after successful deletion
        return redirect()->route('home')->with('success', 'Category deleted successfully.');
    }
}
