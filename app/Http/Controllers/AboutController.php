<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::paginate(10);
        return view('admin.about.index',['abouts' => $abouts, 'page_title' =>'About Us']);
       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.create', [ 'page_title' =>'Create About Us']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $this->validate($request, [
        'title' => 'required|string',
        'subtitle' => 'nullable|string',
        'description' => 'required|string',
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
        'content' => 'required|string',
    ]);

    if (!file_exists(public_path('uploads/about'))) {
        mkdir(public_path('uploads/about'), 0755, true);
    }

    $newImageName = time() . '-' . preg_replace('/[^A-Za-z0-9\-\_\.]/', '_', $request->title) . '.' . $request->image->extension();
    $request->image->move(public_path('uploads/about'), $newImageName);

    $about = new About;
    $about->title = $request->title;
    $about->subtitle = $request->subtitle ?? '';
    $about->description = $request->description;
    $about->image = $newImageName;

    $content = $request->content;
    $strippedContent = preg_replace('/<(?!p\b)[^>]*>/', '', $content);
    $about->content = $strippedContent;

    $about->save();

    return redirect('admin/about/index')->with(['successMessage' => 'Success !! About Us created']);
}
/**
 * Display the specified resource.
 *
 * @param  \App\Models\about  $about
 * @return \Illuminate\Http\Response
 */
public function show(about $about)
{
    //
}

/**
 * Show the form for editing the specified resource.
 *
 * @param  \App\Models\about  $about
 * @return \Illuminate\Http\Response
 */
public function edit($id)
{
    $about = About::find($id);
    return view('admin.about.update', ['about' => $about, 'page_title' =>'Update About Us']);

}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $this->validate($request, [
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'description' => 'required|string',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'content' => 'required|string',
        ]);
    
        $about = About::find($request->id);
    
        if (!file_exists(public_path('uploads/about'))) {
            mkdir(public_path('uploads/about'), 0755, true);
        }
    
        if ($request->hasFile('image')) {
            $newImageName = time() . '-' . preg_replace('/[^A-Za-z0-9\-\_\.]/', '_', $request->title) . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/about'), $newImageName);
            Storage::delete('uploads/about/' . $about->image);
            $about->image = $newImageName;
        }
    
        $about->title = $request->title;
        $about->subtitle = $request->subtitle ?? '';
        $about->description = $request->description;
        $content = $request->content;
        $strippedContent = preg_replace('/<(?!p\b)[^>]*>/', '', $content);
        $about->content = $strippedContent;
    
        if ($about->save()) {
            return redirect('admin/about/index')->with(['successMessage' => 'Success !! About Us Updated']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error About not updated']);
        }
    }
/**
 * Remove the specified resource from storage.
 *
 * @param  \App\Models\about  $about
 * @return \Illuminate\Http\Response
 */
public function destroy($id)
{
    $about = About::find($id);

    $about->delete();

    return redirect('admin/about/index')->with(['successMessage' => 'Success !!about Member Deleted']);
}
}
