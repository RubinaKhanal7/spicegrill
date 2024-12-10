<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::paginate(50);

        return view('admin.team.index', ['teams' => $teams, 'page_title' =>'Team']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create', [ 'page_title' =>'Create Team']);

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
            'role' => 'nullable|string',
            'name' => 'required|string',
            'position' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'contact_number' => 'required|string',
            'email' => 'required|string',
        ]);

        // $imagePath = $request->file('image')->storeAs('images/team', Carbon::now()  . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
        $newImageName = time() . '-' . $request->name . '.' .$request->image->extension();
        $request->image->move(public_path('uploads/team'), $newImageName );
     




        $team = new Team;

        $team->role = $request->role ?? '';
            $team->name = $request->name;
            $team->position = $request->position;
            $team->image = $newImageName;
            $team->contact_number = $request->contact_number;
            $team->email = $request->email;
        $team->save();

        return redirect('admin/team/index')->with(['successMessage' => 'Success !! Staff created']);
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        return view('admin.team.update', ['team' => $team, 'page_title' =>'Update Team']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        
        $this->validate($request, [
            'role' => 'nullable|string',
            'name' => 'required|string',
            'position' => 'required|string',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'contact_number' => 'required|string',
            'email' => 'required|string',
        ]);
      
            $team = Team::find($request->id);
            
            if ($request->hasFile('image')) {
                $newImageName = time() . '-' . $request->name . '.' .$request->image->extension();
                $request->image->move(public_path('uploads/team'), $newImageName );
                             Storage::delete('uploads/team' . $team->image);
                $team->image = $newImageName;
            }else{
                unset($request['image']);
            }

            $team->role = $request->role ?? '';
            $team->name = $request->name;
            $team->position = $request->position;
            $team->contact_number = $request->contact_number;
            $team->email = $request->email;

            if ($team->save()) {
                return redirect('admin/team/index')->with(['successMessage' => 'Success !! Staff Updated']);
            } else {
                return redirect()->back()->with(['errorMessage' => 'Error Staff not updated']);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $team = Team::find($id);

        $team->delete();

        return redirect('admin/team/index')->with(['successMessage' => 'Success !!Team Member Deleted']);
    }
}
