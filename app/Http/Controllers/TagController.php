<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::paginate(10);

        return view('dashboard.tags.index', compact('tags'));
    }


    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function edit(Tag $tag)
    {
        return view('dashboard.tags.edit', compact('tag'));
    }

    public function store(TagRequest $request)
    {
        $data = $request->all();
        Tag::create($data);
        return redirect()->route('tags.index')->with('mssg', 'Tag Created successfully');
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $data = $request->all();
        $tag->update($data);
        return redirect()->route('tags.index')->with('mssg', 'Tag Updated successfully');
    }

    public function show(Tag $tag)
    {
        return view('dashboard.tags.show', compact('tag'));
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
    }
}
