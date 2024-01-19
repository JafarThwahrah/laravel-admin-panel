<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);

        return view('dashboard.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        Category::create($data);
        return redirect()->route('categories.index')->with('mssg', 'Category Created successfully');
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->all();
        $category->update($data);
        return redirect()->route('categories.index')->with('mssg', 'Category Updated successfully');
    }

    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
    }
}
