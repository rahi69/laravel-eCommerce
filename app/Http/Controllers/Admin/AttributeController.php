<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{

    public function index()
    {
        $attributes = Attribute::latest()->paginate(20);
        return view('admin.attributes.index',compact('attributes'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required'
        ]);

        Attribute::create([

            'name' => $request->name,
        ]);
        alert()->success('باتشکر ', 'ویژگی موردنظر ثبت شد.');

        return redirect()->route('admin.attributes.index');
    }


    public function show(Attribute $attribute)
    {
        return view('admin.attributes.show',compact('attribute'));

    }

    public function edit(Attribute $attribute)
    {
        return view('admin.attributes.edit',compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name'=> 'required'
        ]);

       $attribute->update([

            'name' => $request->name,
        ]);
        alert()->success('باتشکر ', 'ویژگی موردنظر ویرایش شد.');

        return redirect()->route('admin.attributes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
