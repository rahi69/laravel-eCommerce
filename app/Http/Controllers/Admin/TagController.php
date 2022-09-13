<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::latest()->paginate(20);
        return view('admin.tags.index',compact('tags'));
    }


    public function create()
    {
        return view('admin.tags.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);

        Tag::create([

            'name' => $request->name,
        ]);
        alert()->success('باتشکر ', 'تگ موردنظر ثبت شد.');

        return redirect()->route('admin.tags.index');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit',compact('tag'));

    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name'=> 'required'
        ]);

        $tag->update([

            'name' => $request->name,
        ]);
        alert()->success('باتشکر ', 'تگ موردنظر ویرایش شد.');

        return redirect()->route('admin.tags.index');
    }


    public function destroy($id)
    {
        //
    }
}
