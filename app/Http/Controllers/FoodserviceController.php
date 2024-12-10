<?php

namespace App\Http\Controllers;

use App\Models\Foodservice;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;





class FoodserviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $foods = Foodservice::paginate(10);
        
        return view('admin.food.index', ['foods' => $foods, 'page_title'=>'Food']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.foodservice.create',['page_title'=>'Add food Photo Image']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        
        $request->image->move(public_path('uploads/foodservicegallery'), $newImageName );
     
        $foods = new Foodservice();

        $foods->title = $request->title;

        $foods->image = $newImageName;

        $foods->save();

        return redirect('admin/foodservice/index')->with(['successMessage' => 'Success !! Fish Gallery Image Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Foodservice  $foodservice
     * @return \Illuminate\Http\Response
     */
    public function show(Foodservice $foodservice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Foodservice  $foodservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Foodservice $foodservice, $id)
    {
        //
        $foodservice = Foodservice::find($id);

        return view('admin.fishgallery.update', ['fishgallerys' => $foodservice, 'page_title' =>'Update foods Gallery Image']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foodservice  $foodservice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foodservice $foodservice)
    {
        //
        $this->validate($request,[
            'title' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',

        ]);


        $foods = Foodservice::find($request->id);

        if ($request->hasFile('image')) {
            $newImageName = time() . '-' . $request->image->extension();
            $request->image->move(public_path('uploads/foodservicegallery'), $newImageName );
                         Storage::delete('uploads/foodservicegallery' . $foods->image);
            $foods->image = $newImageName;
        }
        else{
            unset($request['image']);
        }


        $foods->title = $request->title ?? ''; 

        if ($foods->save()) {
            return redirect('admin/foodservice/index')->with(['successMessage' => 'Success !! Background Updated']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error Background Image not updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foodservice  $foodservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foodservice $foodservice, $id)
    {
        //

        $foods = Foodservice::find($id);

        $foods->delete();

        return redirect('admin/foodservice/index')->with(['successMessage' => 'Success !!food Gallery Image Deleted']);
    }
}
