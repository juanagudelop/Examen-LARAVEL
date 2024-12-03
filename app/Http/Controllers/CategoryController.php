<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Muestra una lista de categorías
    public function index()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    // Crea una nueva categoría
    public function createCategory(Request $request)
    {
        $category = $request->validate([
            'name' => 'required|max:191|unique:categories',
            'description' => 'nullable|max:191',
        ]);

        Category::create($category);

        return redirect()->route('categories')->with('success', 'Categoría creada correctamente');
    }

    // Muestra una categoría específica
    public function showCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('edit_category', compact('category'));
    }

    // Actualiza una categoría
    public function setCategory(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|max:191|unique:categories,name,' . $id,
            'description' => 'nullable|max:191',
        ]);

        Category::where('id', $id)->update($validate);

        return redirect()->route('categories')->with('success', 'Categoría actualizada correctamente');
    }

    // Elimina una categoría
    public function deleteCategory($id)
    {
        Category::destroy($id);

        return redirect()->route('categories')->with('success', 'Categoría eliminada correctamente');
    }
}
