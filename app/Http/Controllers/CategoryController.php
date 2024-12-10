<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->paginate(50);
        return view('admin.category.index',['categories' => $categories, 'page_title' =>'Category']);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create', [ 'page_title' =>'Create Category']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate= $request->validate([
            'title' => 'required|string',
          
        ]);
        $category = new Category;
        $category->title = $request->title;
        $category->slug = SlugService::createSlug(Category::class, 'slug', $request->title);
        $category->save();
        return redirect('admin/category/index')->with(['successMessage' => 'Success !! Category created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.update', ['category' => $category, 'page_title' =>'Update Categories']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validate=$request->validate([
            'title' => 'required|string',
        ]);

        $category = Category::find($request->id);

        $category->title = $request->title;
        $category->slug = SlugService::createSlug(Category::class, 'slug', $request->title);


        $category->save();

        return redirect('admin/category/index')->with(['successMessage' => 'Success!! Category Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();
        return redirect('admin/category/index')->with(['successMessage' => 'Success!! Category Updated']);


    }
}
