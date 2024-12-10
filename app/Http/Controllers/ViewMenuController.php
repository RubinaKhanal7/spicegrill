<?php

namespace App\Http\Controllers;

use App\Models\ViewMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViewMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $viewmenus = ViewMenu::paginate(10);
        
        return view('admin.viewmenu.index', ['viewmenus' => $viewmenus, 'page_title'=>'View Menu Items']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.viewmenu.create',['page_title'=>'Add menu items']);
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'type'=>'required',
            'price'=>'nullable|string',
            'description'=>'nullable|string',
        ]);


        $viewmenus = new ViewMenu();


        if ($request->hasFile('image')) {
            $newImageName = time() . '-' . $request->image->extension();
            $request->image->move(public_path('uploads/viewmenu'), $newImageName );
                        
        }
        else{
            unset($request['image']);
        }
    
        // $newImageName = time() . '-' . $request->image->extension();
        
        // $request->image->move(public_path('uploads/viewmenu'), $newImageName );
     
        

        $viewmenus->title = $request->title;
        $viewmenus->type = $request->type;

        $viewmenus->image = $newImageName ?? '';

        $viewmenus->price = $request->price ?? '';
        $viewmenus->description = $request->description ?? '';

        $viewmenus->save();

        return redirect('admin/viewmenu/index')->with(['successMessage' => 'Success menu item created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ViewMenu  $viewMenu
     * @return \Illuminate\Http\Response
     */
    public function show(ViewMenu $viewMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ViewMenu  $viewMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(ViewMenu $viewMenu,$id)
    {
        //
        $viewmenus = viewMenu::find($id);

        return view('admin.viewmenu.update', ['viewmenus' => $viewmenus, 'page_title' =>'Update menu item']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ViewMenu  $viewMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ViewMenu $viewMenu)
    {
        //
        $this->validate($request,[
            'title' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'description' => 'nullable|string',
            'price'=>'nullable|string',

        ]);


        $viewmenus = ViewMenu::find($request->id);

        if ($request->hasFile('image')) {
            $newImageName = time() . '-' . $request->image->extension();
            $request->image->move(public_path('uploads/viewmenu'), $newImageName );
                         Storage::delete('uploads/viewmenu' . $viewmenus->image);
            $viewmenus->image = $newImageName;
        }
        else{
            unset($request['image']);
        }


        $viewmenus->title = $request->title ?? ''; 
        $viewmenus->price = $request->price ?? '';
        $viewmenus->description = $request->description ?? '';
        $viewmenus->type = $request->type ?? '';


        if ($viewmenus->save()) {
            return redirect('admin/viewmenu/index')->with(['successMessage' => 'Success !! Background Updated']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error Background Image not updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ViewMenu  $viewMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(ViewMenu $viewMenu, $id)
    {
        //
        $viewmenus = ViewMenu::find($id);

        $viewmenus->delete();

        return redirect('admin/viewmenu/index')->with(['successMessage' => 'Success !! menu item deleted']);
    }
}
