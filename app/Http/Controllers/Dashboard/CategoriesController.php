<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\dashboard\CategoryRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $categories = Category::leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            ->filter($request->query())
            ->orderBy('categories.name')
            ->paginate();
        return view('dashboard.categories.index', compact('categories'));
        // $query = Category::query();
        // dd($query);
        // if($name = $request->query('name')){
        //     $query->where('name','like','%'.$name.'%');
        // };
        // if($status = $request->query('status')){
        //     $query->where('status','=',$status);
        // };
        // dd($query);
        // $categories = Category::status('archived')->paginate();
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
    public function store(CategoryRequest $request)
    {
        // $request->validate(Category::rules() , [
        //     'required' => 'This field (:attribute) is required',
        //     'unique'=> 'This (:attribute) is already exists!',
        // ]);

        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);


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
    public function update(CategoryRequest $request, $id)
    {
        // $request->validate(Category::rules($id));
        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->except('image');

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $path = $file->store('uploads', [
        //         'disk' => 'public',
        //     ]);
        $new_image = $this->uploadImage($request);
        if ($new_image) {
            $data['image'] = $new_image;
        }
        // $request->merge([
        //     $data['image'] => $path,
        // ]);
        // }
        $category->update($data);
        // if ($old_image && $new_image) {
        //     Storage::disk('public')->delete($old_image);
        // }
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
        // if ($category->image) {
        //     Storage::disk('public')->delete($category->image);
        // };

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

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact(['categories']));
    }

    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Categories Restored!');
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        return redirect()->route('dashboard.categories.trash')
            ->with('success', 'Categories Deleted Forever!');
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        };
    }
}
