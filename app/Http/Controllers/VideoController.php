<?php

namespace App\Http\Controllers;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::latest()->get()->take(10);
        
        return view('admin.video.index', ['videos' => $videos, 'page_title'=>'Video']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create',['page_title'=>'Add Video Image']);
 
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
            'url' => 'required|url',
        ]);


        $video = new Video;
        $video->title = $request->title;
        $video->url = $request->url;

        $video->save();

        return redirect('admin/video/index')->with(['successMessage' => 'Success !! Video Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);
        return view('admin.video.update',[
            'video' => $video,
            'page_title' =>'Update Video URL'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        $this->validate($request,[
            'title' => 'required|string',
            'url' => 'required|url',
        ]);


        $video = Video::find($request->id);
        $video->title = $request->title;
        $video->url = $request->url;

        $video->save();

        return redirect('admin/video/index')->with(['successMessage' => 'Success !! Video Created']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id);

        $video->delete();

        return redirect('admin/video/index')->with(['successMessage' => 'Success !!Video Deleted']);

    }
}
