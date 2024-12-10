<?php

namespace App\Http\Controllers;

use App\Models\PhotoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $photogallerys = PhotoGallery::paginate(10);
        
        return view('admin.photogallery.index', ['photogallerys' => $photogallerys, 'page_title'=>'Photo Gallery Image']);

    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photogallery.create',['page_title'=>'Add Gallery Photo Image']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        ]);


        // if($request->hasFile('image')){
        //     $newImageName = time() . '_' . $request->image->getClientOriginalExtension();
        //     $request->image->move('uploads/coverimage/', $newImageName);
        // }
        // else{
        //     $newImageName= "NoImage";
        // }

        $newImageName = time() . '-' . $request->image->extension();
        
        $request->image->move(public_path('uploads/gallery'), $newImageName );
     
        $photogallery = new PhotoGallery;

        $photogallery->title = $request->title;

        $photogallery->image = $newImageName;

        $photogallery->save();

        return redirect('admin/photogallery/index')->with(['successMessage' => 'Success !! Photo Gallery Image Created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CoverImage  $coverImage
     * @return \Illuminate\Http\Response
     */
    public function show(photogallery $photogallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CoverImage  $coverImage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photogallery = photogallery::find($id);

        return view('admin.photogallery.update', ['photogallery' => $photogallery, 'page_title' =>'Update Photo Gallery Image']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CoverImage  $coverImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, photogallery $photogallery)
    {
        $this->validate($request,[
            'title' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',

        ]);


        $photogallery = photogallery::find($request->id);

        if ($request->hasFile('image')) {
            $newImageName = time() . '-' . $request->image->extension();
            $request->image->move(public_path('uploads/gallery'), $newImageName );
                         Storage::delete('uploads/gallery' . $photogallery->image);
            $photogallery->image = $newImageName;
        }
        else{
            unset($request['image']);
        }


        $photogallery->title = $request->title ?? ''; 

        if ($photogallery->save()) {
            return redirect('admin/photogallery/index')->with(['successMessage' => 'Success !! Background Updated']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error Background Image not updated']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CoverImage  $coverImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photogallery = PhotoGallery::find($id);

        $photogallery->delete();

        return redirect('admin/photogallery/index')->with(['successMessage' => 'Success !!Photo Gallery Image Deleted']);
    }
}
