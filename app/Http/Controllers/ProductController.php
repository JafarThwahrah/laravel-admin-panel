<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::OrderBy('order', 'asc')->paginate(10);
        return view('dashboard.products.index', compact('products'));
    }


    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('dashboard.products.create', compact('tags', 'categories'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $selectedTags = $product->tags->pluck('id')->toArray();

        return view('dashboard.products.edit', compact('product', 'categories', 'tags', 'selectedTags'));
    }

    public function store(ProductRequest $request)
    {
        $imagePath = null;
        if ($request->image) {
            $imagePath = $request->image->store('public/products');
            $imagePath = str_replace('public/', 'storage/', $imagePath);
        }
        $maxOrder = Product::max('order');
        $data = $request->all();
        $data['order'] = $maxOrder + 1;
        $data['image_path'] = $imagePath;
        $product = Product::create($data);
        $product->tags()->attach($request->tags);
        return redirect()->route('products.index')->with('mssg', 'Product Created successfully');
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->all();
        if ($request->image) {
            $imagePath = $request->image->store('public/products');
            $imagePath = str_replace('public/', 'storage/', $imagePath);
            $data['image_path'] = $imagePath;
        }
        $product->update($data);
        $product->tags()->sync($request->tags);
        return redirect()->route('products.index')->with('mssg', 'Product Updated successfully');
    }

    public function show(Product $product)
    {
        return view('dashboard.products.show', compact('product'));
    }

    public function changeOrder(Request $request)
    {
        foreach ($request['data'] as $item) {
            $product = Product::find($item['id']);
            $product->update([
                'order' => $item['order']
            ]);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
    }
}
