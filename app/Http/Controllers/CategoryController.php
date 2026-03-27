<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        // Get all categories
        $categories = Category::with('parent')->get(); // Eager load parent category if exists
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        $categories = Category::all(); // For parent dropdown
        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('name', 'parent_id');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = $imagePath;
        }

        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->get(); // Exclude itself from parent list
        return view('categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('name', 'parent_id');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $data['image'] = $imagePath;
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Optional: Delete category image
        if ($category->image) {
            \Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}