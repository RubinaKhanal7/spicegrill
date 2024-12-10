<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;


class ProjectController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(50);
        return view('admin.projects.index',['projects' => $projects, 'page_title' =>'Projects']);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admin.projects.create', [ 'page_title' =>'Add Project']);

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
         
            'file' => 'nullable|file|max:10000',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
   
            'content' => 'required',
        ]);
        // $imagePath = $request->file('image')->storeAs('images/project', Carbon::now()  . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
        if ($request->hasFile('file')){
        $projectPath = time() . '-' . $request->title . '.' .$request->file->extension();
        $request->file->move(public_path('uploads/poject'), $projectPath );
        }
        else{
            $projectPath = "NoFile";
        }



        $imagePath = time() . '-' . $request->image->extension();
        $request->image->move(public_path('uploads/project'), $imagePath );
     

        $project = new Project;
        $project->title = $request->title;
 
        $project->file = $projectPath ?? '';
        $project->image = $imagePath;
        $project->content = $request->content;

        if ($project->save()) {
           
            return redirect('admin/projects/index')->with(['successMessage' => 'Success!! Projects created']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error!! Projects not created']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
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
        $project = Project::find($id);

        return view('admin.projects.update', ['project' => $project, 'page_title' =>'Update projects']);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validate= $request->validate([
            'title' => 'required|string',
       
            'file' => 'nullable|file|max:10000',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
       
            'content' => 'required',
        ]);


        $project = Project::find($request->id);
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->storeAs('images/project', Carbon::now() . substr(str_replace(['.', '?', '/'], '-', $request->title), 0, 50) . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
        //     Storage::delete('public/' . $project->image);
        //     $project->image = $imagePath;
        // }
        if ($request->hasFile('file')) {
            $projectPath = time() . '-' . $request->title . '.' .$request->file->extension();
            $request->file->move(public_path('uploads/project'), $projectPath );
            Storage::delete('public/uploads/project' . $project->file);
            $project->file = $projectPath;  
        }
   

        if ($request->hasFile('image')) {
            $imagePath = time() . '-' . $request->title . '.' .$request->image->extension();
            $request->image->move(public_path('uploads/project'), $imagePath );
                         Storage::delete('uploads/project' . $project->image);
            $project->image = $imagePath;
        }else{
            unset($request['image']);
        }


        $project->title = $request->title;
       
        // $project->type = $request->type;
        $project->content = $request->content;

        if ($project->save()) {
           
            return redirect('admin/projects/index')->with(['successMessage' => 'Success!! project Updated']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error!! Project not Updated']);
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
        $project = Project::find($id);

        if ($project->delete()) {
    
            Storage::delete('uploads/project/'.$project->image);
            return redirect('admin.projects.index')->with(['successMessage' => 'Success !! project Deleted']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error project not Deleted']);
        }
    
    }
}
