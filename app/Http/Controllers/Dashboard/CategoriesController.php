<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255|min:3',
            'parent_id' => [
                'nullable' , 'integer' , 'exists:categories,id'
            ],
            'image' => 'image|max:1028576|dimensions:min_width=100,min_height=100',
            'status' => 'in:active,archived',
        ]);
        // $category = new Category;

        // $category->name = $request->post('name');
        // $category->parent_id = $request->post('parent_id');
        // $category->save();
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);

        $data = $request->except('image');

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $path = $file->store('uploads', [
        //         'disk' => 'public',
        //     ]);
            $data['image'] = $this->uploadImage($request);
            // $request->merge([
            //     $data['image'] => $path,
            // ]);
        // }


        $category = Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {

                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })->get();
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('info', 'Record Not Fond');
        }
        // if(!$category){
        //     abort(404);
        // }
        return view('dashboard.categories.edit', compact(['parents', 'category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->except('image');

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $path = $file->store('uploads', [
        //         'disk' => 'public',
        //     ]);
            $data['image'] = $this->uploadImage($request);
            // $request->merge([
            //     $data['image'] => $path,
            // ]);
        // }
        $category->update($data);
        if ($old_image && $data['image']) {
            Storage::disk('public')->delete($old_image);
        }
        return Redirect::route('dashboard.categories.index')->with('success', 'Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        // Category::where('id' , $id)->delete();
        // Category::destroy($id);
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        };

        return Redirect::route('dashboard.categories.index')->with('success', 'Category Deleted!');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        } else {
            $file = $request->file('image');
            $path = $file->store('uploads', [
                'disk' => 'public',
            ]);
            return $path;
        }
    }
}
