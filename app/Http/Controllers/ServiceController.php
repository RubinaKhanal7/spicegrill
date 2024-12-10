<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $services = Service::paginate(10);
        return view('admin.services.index',['services' => $services, 'page_title' =>'Services']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create', [ 'page_title' =>'Add Services']);

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
            'description'=>'required|string',
        
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
   
            'content' => 'required|string',
        ]);
      


        $imagePath = time() . '-' . $request->image->extension();
        $request->image->move(public_path('uploads/service'), $imagePath );
     

        $service = new Service;
        $service->title = $request->title;
        $service->description = $request->description;
        $service->image = $imagePath;
        $service->content = $request->content;

        if ($service->save()) {
           
            return redirect('admin/services/index')->with(['successMessage' => 'Success!! Services created']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error!! Services not created']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);

        return view('admin.services.update', ['service' => $service, 'page_title' =>'Update Services']);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $validate= $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
       
            'content' => 'required',
        ]);


        $service = Service::find($request->id);
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->storeAs('images/project', Carbon::now() . substr(str_replace(['.', '?', '/'], '-', $request->title), 0, 50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
        //     Storage::delete('public/' . $project->image);
        //     $project->image = $imagePath;
        // }
       
   

        if ($request->hasFile('image')) {
            $imagePath = time() . '-' . $request->title . '.' .$request->image->extension();
            $request->image->move(public_path('uploads/service'), $imagePath );
                         Storage::delete('uploads/service' . $service->image);
            $service->image = $imagePath;
        }else{
            unset($request['image']);
        }


        $service->title = $request->title;
        $service->description = $request->description;
       
        // $project->type = $request->type;
        $service->content = $request->content;

        if ($service->save()) {
           
            return redirect('admin/services/index')->with(['successMessage' => 'Success!! Service Updated']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error!! Service not Updated']);
        }
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        $service->delete();
        // {
         
        //     Storage::delete('uploads/service/'.$service->image);
            return redirect('admin/services/index')->with(['successMessage' => 'Success !! Service Deleted']);
        // } else {
        //     return redirect()->back()->with(['errorMessage' => 'Error Service not Deleted']);
        }

          // for search functionality
    // public function search(Request $request)
    // {
    //     // Get the search value from the request
    //     $search = $request->input('search');
    
    //     // Search in the title and body columns from the posts table
    //     $service = Service::query()
    //         ->where('title', 'LIKE', "%{$search}%")
    //         ->orWhere('content', 'LIKE', "%{$search}%")
    //         ->get();
    
    //     // Return the search view with the resluts compacted
    //     return view('search', compact('services'));
    // }
      
       
    }

