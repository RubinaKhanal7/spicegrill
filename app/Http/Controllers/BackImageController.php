<?php

namespace App\Http\Controllers;

use App\Models\BackImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BackImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $backimages = BackImage::paginate(10);
        
        return view('admin.backimage.index', ['backimages' => $backimages, 'page_title'=>'Background Image']);

    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.backimage.create',['page_title'=>'Add Background Image']);
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
        
        $request->image->move(public_path('uploads/backimage'), $newImageName );
     
        $backimage = new BackImage;

        $backimage->title = $request->title;

        $backimage->image = $newImageName;

        $backimage->save();

        return redirect('admin/backimage/index')->with(['successMessage' => 'Success !! Cover Image Created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CoverImage  $coverImage
     * @return \Illuminate\Http\Response
     */
    public function show(BackImage $backimage)
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
        $backimage = BackImage::find($id);

        return view('admin.backimage.update', ['backimage' => $backimage, 'page_title' =>'Update Background Image']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CoverImage  $coverImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BackImage $backimage)
    {
        $this->validate($request,[
            'title' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',

        ]);


        $backimage = BackImage::find($request->id);

        if ($request->hasFile('image')) {
            $newImageName = time() . '-' . $request->image->extension();
            $request->image->move(public_path('uploads/backimage'), $newImageName );
                         Storage::delete('uploads/backimage' . $backimage->image);
            $backimage->image = $newImageName;
        }
        else{
            unset($request['image']);
        }


        $backimage->title = $request->title ?? ''; 

        if ($backimage->save()) {
            return redirect('admin/backimage/index')->with(['successMessage' => 'Success !! Background Updated']);
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
        $backimage = BackImage::find($id);

        $backimage->delete();

        return redirect('admin/backimage/index')->with(['successMessage' => 'Success !!Background Image Deleted']);
    }
}
