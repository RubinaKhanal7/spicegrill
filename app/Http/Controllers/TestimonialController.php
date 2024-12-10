<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::paginate(50);
        return view('admin.testimonials.index',['testimonials' => $testimonials, 'page_title' =>'Testimonials']);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.testimonials.create', [ 'page_title' =>'Add Testimonial']);

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
         
        
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
   
            'content' => 'required',
        ]);
       



        $imagePath = time() . '-' . $request->image->extension();
        $request->image->move(public_path('uploads/testimonial'), $imagePath );
     

        $testimonial = new Testimonial;
        $testimonial->title = $request->title;
 
    
        $testimonial->image = $imagePath;
        $testimonial->content = $request->content;

        if ($testimonial->save()) {
           
            return redirect('admin/testimonials/index')->with(['successMessage' => 'Success!! testimonials created']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error!! testimonials not created']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Testimonial::find($id);

        return view('admin.testimonials.update', ['testimonial' => $testimonial, 'page_title' =>'Update Testimonials']);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $validate= $request->validate([
            'title' => 'required|string', 
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'content' => 'required',
        ]);


        $testimonial = Testimonial::find($request->id);
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->storeAs('images/project', Carbon::now() . substr(str_replace(['.', '?', '/'], '-', $request->title), 0, 50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
        //     Storage::delete('public/' . $project->image);
        //     $project->image = $imagePath;
        // }
     

        if ($request->hasFile('image')) {
            $imagePath = time() . '-' . $request->title . '.' .$request->image->extension();
            $request->image->move(public_path('uploads/testimonial'), $imagePath );
                         Storage::delete('uploads/testimonial' . $testimonial->image);
            $testimonial->image = $imagePath;
        }else{
            unset($request['image']);
        }


        $testimonial->title = $request->title;
       
        // $testimonial->type = $request->type;
        $testimonial->content = $request->content;

        if ($testimonial->save()) {
           
            return redirect('admin/testimonials/index')->with(['successMessage' => 'Success!! testimonial Updated']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error!! testimonial not Updated']);
        }
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);

        if ($testimonial->delete()) {
    
            Storage::delete('uploads/testimonial/'.$testimonial->image);
            return redirect('admin.testimonials.index')->with(['successMessage' => 'Success !! testimonial Deleted']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error testimonial not Deleted']);
        }
    
    }
}
