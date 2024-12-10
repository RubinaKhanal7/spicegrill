<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('getCategories')->latest()->paginate(50);
        return view('admin.post.index',['posts' => $posts, 'page_title' =>'Post']);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.post.create', [ 'page_title' =>'Create Post','categories' =>$categories]);

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
            'description' => 'required|string',
            'file' => 'nullable|file|max:10000',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'categories' => 'required',
            'content' => 'required',
        ]);
        // $imagePath = $request->file('image')->storeAs('images/post', Carbon::now()  . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
        if ($request->hasFile('file')){
        $postPath = time() . '-' . $request->title . '.' .$request->file->extension();
        $request->file->move(public_path('uploads/post'), $postPath );
        }
        else{
            $postPath = "NoFile";
        }



        $imagePath = time() . '-' . $request->image->extension();
        $request->image->move(public_path('uploads/post'), $imagePath );
     

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
    //    $post->type = $request->type;
        $post->file = $postPath ?? '';
        $post->slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        $post->image = $imagePath;
        $content = $request->content;
        $strippedContent = preg_replace('/<(?!p\b)[^>]*>/', '', $content);
        $post->content = $strippedContent;

        if ($post->save()) {
            $post->getCategories()->sync($request->categories);
            return redirect('admin/post/index')->with(['successMessage' => 'Success!! Post created']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error!! Post not created']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.post.update', ['post' => $post, 'page_title' =>'Update Posts','categories' =>$categories]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validate= $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'file' => 'nullable|file|max:10000',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'categories' => 'required',
            'content' => 'required',
        ]);


        $post = Post::find($request->id);
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->storeAs('images/post', Carbon::now() . substr(str_replace(['.', '?', '/'], '-', $request->title), 0, 50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
        //     Storage::delete('public/' . $post->image);
        //     $post->image = $imagePath;
        // }
        if ($request->hasFile('file')) {
            $postPath = time() . '-' . $request->title . '.' .$request->file->extension();
            $request->file->move(public_path('uploads/post'), $postPath );
            Storage::delete('public/uploads/post' . $post->file);
            $post->file = $postPath;  
        }
   

        if ($request->hasFile('image')) {
            $imagePath = time() . '-' . $request->title . '.' .$request->image->extension();
            $request->image->move(public_path('uploads/post'), $imagePath );
                         Storage::delete('uploads/post' . $post->image);
            $post->image = $imagePath;
        }else{
            unset($request['image']);
        }


        $post->title = $request->title;
        $post->description = $request->description;
        // $post->type = $request->type;
        $post->content = $request->content;
        $post->slug = SlugService::createSlug(Post::class, 'slug', $request->title);


        if ($post->save()) {
            $post->getCategories()->sync($request->categories);
            return redirect('admin/post/index')->with(['successMessage' => 'Success!! Post Updated']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error!! Post not Updated']);
        }
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if ($post->delete()) {
            $post->getCategories()->detach();
            Storage::delete('uploads/post/'.$post->image);
            return redirect('admin/post/index')->with(['successMessage' => 'Success !! Post Deleted']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error Post not Deleted']);
        }
    
    }


    // for search functionality
  
}
