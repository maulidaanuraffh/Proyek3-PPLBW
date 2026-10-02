<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('activities')->get();
        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name'],
            'slug' => ['required', 'string', 'max:100', 'unique:categories,slug'],
        ]);

        Category::create($request->only('name', 'slug'));

        return to_route('categories.index')
            ->with('success', 'Kategori berhasil dibuat.');
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:categories,name,' . $category->id],
            'slug' => ['required', 'string', 'max:100', 'unique:categories,slug,' . $category->id],
        ]);

        $category->update($request->only('name', 'slug'));

        return to_route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        try {
            $category->delete();
            return to_route('categories.index')
                ->with('success', 'Kategori berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return to_route('categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh kegiatan.');
        }
    }
}
