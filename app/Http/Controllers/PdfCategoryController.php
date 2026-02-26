<?php

namespace App\Http\Controllers;

use App\Models\PdfCategory;
use Illuminate\Http\Request;

class PdfCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = PdfCategory::paginate(10);
        return view('pdf-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pdf-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        PdfCategory::create($validated);

        return redirect()->route('pdf-categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $category = PdfCategory::findOrFail($id);
    //     return view('pdf-categories.show', compact('category'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = PdfCategory::findOrFail($id);
        return view('pdf-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category = PdfCategory::findOrFail($id);
        $category->update($validated);

        return redirect()->route('pdf-categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = PdfCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('pdf-categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
