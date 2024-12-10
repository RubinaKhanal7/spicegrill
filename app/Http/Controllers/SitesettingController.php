<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\Models\Sitesetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SitesettingController extends Controller
{





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sitesetting = Sitesetting::latest()->get()->take(1);
        return view('admin.sitesetting.index',['sitesettings'=>$sitesetting, 'page_title' => 'Sitesettings']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sitesetting.create', ['page_title' => 'Create Sitesetting']);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'govn_name'=>'nullable|string',
            'ministry_name'=>'nullable|string',
            'department_name'=>'nullable|string',
            'office_name'=>'required|string', 
            'office_address'=>'required|string',
            'office_contact'=>'required|string',
            'office_mail'=>'required|string',
          'main_logo'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'side_logo'=>'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'face_link'=>'nullable|url',
            'insta_link'=>'nullable|url',
            'linked_link'=>'nullable|url',
            'social_link'=>'nullable|url',
            'google_maps' =>'nullable|url',
        ]);


        if($request->hasFile('main_logo')){
            $newMainLogo = time().'_'.$request->main_logo->getClientOriginalName();
            $request->main_logo->move('uploads/sitesetting/', $newMainLogo);        
            }
            else{
            $newMainLogo = "NoImage";
        }
    
        // $newMainLogo = time() . '_' . $request->main_logo->getClientOriginalName();
        // $request->main_logo->move(public_path('uploads/sitesetting/'), $newMainLogo);

        // $newSideLogo = time() . '-' . $request->side_logo->extension();
        // $request->side_logo->move(public_path('uploads'), $newSideLogo);
        if($request->hasFile('side_logo')){
            $newSideLogo = time().'_'.$request->side_logo->getClientOriginalName();
            $request->side_logo->move('uploads/sitesetting/', $newSideLogo);        
            }
            else{
            $newSideLogo = "NoImage";
        }

     
        $sitesetting = new Sitesetting;

        $sitesetting->govn_name=$request->govn_name ?? '';
        $sitesetting->ministry_name=$request->ministry_name ?? '';
        $sitesetting->department_name=$request->department_name ?? '';
        $sitesetting->office_name=$request->office_name;
        $sitesetting->office_address=$request->office_address;
        $sitesetting->office_contact=$request->office_contact;
        $sitesetting->office_mail=$request->office_mail;
        $sitesetting->main_logo=$newMainLogo;
        $sitesetting->side_logo=$newSideLogo ?? '';
        $sitesetting->face_link=$request->face_link ?? '';
        $sitesetting->insta_link=$request->insta_link ?? '';
        $sitesetting->linked_link=$request->linked_link ?? '';
        $sitesetting->social_link=$request->social_link ?? '';
        $sitesetting->google_maps=$request->google_maps ?? '';
        $sitesetting->save(); 

        return redirect('admin/sitesetting/index')->with(['successMessage' => 'Success !! SiteSetting Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sitesetting  $sitesetting
     * @return \Illuminate\Http\Response
     */
    public function show(Sitesetting $sitesetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sitesetting  $sitesetting
     * @return \Illuminate\Http\Response
     */
    public function edit(Sitesetting $sitesetting)
    {
        $sitesetting = SiteSetting::find(1);
        return view('admin.sitesetting.update', ['sitesetting' => $sitesetting, 'page_title' =>'Update Sitesettings']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sitesetting  $sitesetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sitesetting $sitesetting)
    {
        $validate = $request->validate([
            'govn_name'=>'nullable|string',
            'ministry_name'=>'nullable|string',
            'department_name'=>'nullable|string',
            'office_name'=>'required|string',
            'office_address'=>'required|string',
            'office_contact'=>'required|string',
            'office_mail'=>'required|string',
            'main_logo'=>'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'side_logo'=>'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1536',
            'face_link'=>'nullable|url',
            'insta_link'=>'nullable|url',
            'linked_link'=>'nullable|url',
            'social_link'=>'nullable|url',
            'google_maps' =>'nullable|url',

        ]);
    
        $sitesetting = Sitesetting::find(1);


        // if($request->hasFile('main_logo')){

        //     $destination ='uploads/'.$sitesetting->main_logo;
        //     if(File::exists()){
        //         Storage::delete($destination);
        //     }
        //     $newMainLogo = time().'_'.$request->main_logo->getClientOriginalName();
        //     $request->main_logo->move('uploads', $newMainLogo);        
        //     }
        //     else{
        //         $newMainLogo = $request->main_logo;
        //     }
           


        if ($request->hasFile('main_logo')) {
            $newMainLogo = time() . '-' . $request->main_logo->extension();
            $request->main_logo->move(public_path('uploads/sitesetting'), $newMainLogo );
                         Storage::delete('uploads/sitesetting' . $sitesetting->main_logo);
            $sitesetting->main_logo = $newMainLogo;
        }else{
            unset($request['main_logo']);
        }


        if ($request->hasFile('side_logo')) {
            $newSideLogo = time() . '-' . $request->side_logo->extension();
            $request->side_logo->move(public_path('uploads/sitesetting'), $newSideLogo );
                         Storage::delete('uploads/sitesetting' . $sitesetting->side_logo);
            $sitesetting->side_logo = $newSideLogo;
        }else{
            unset($request['side_logo']);
        }


            // if ($request()->hasFile('main_logo') && $request('main_logo') != ''){
            //     $newMainLogo = public_path('uploads/sitesetting/'.$sitesetting->main_logo);
            //     if(File::exists($newMainLogo)){
            //         unlink($newMainLogo);
            //     }

            //     $main_logo = request()->file('main_logo')->store('uploads/sitesetting/', 'public');
            //     $request['main_logo'] = $main_logo;
            //     $sitesetting->update($request);
            // }

        // if($request->hasFile('side_logo')){
        //     $newSideLogo = time().'_'.$request->side_logo->getClientOriginalName();
        //     $request->side_logo->move('uploads/sitesetting/', $newSideLogo);        
        //     }
        //     else{
        //     $newSideLogo = "Noimage";
        // }


        $sitesetting->govn_name=$request->govn_name ?? '';
        $sitesetting->ministry_name=$request->ministry_name ?? '';
        $sitesetting->department_name=$request->department_name ?? '';
        $sitesetting->office_name=$request->office_name;
        $sitesetting->office_address=$request->office_address;
        $sitesetting->office_contact=$request->office_contact;
        $sitesetting->office_mail=$request->office_mail;
        // $sitesetting->main_logo=$newMainLogo;
        // $sitesetting->side_logo=$newSideLogo ?? '';
        $sitesetting->face_link=$request->face_link ?? '';
        $sitesetting->insta_link=$request->insta_link ?? '';
        $sitesetting->linked_link=$request->linked_link ?? '';
        $sitesetting->social_link=$request->social_link ?? '';
        $sitesetting->google_maps=$request->google_maps ?? '';

        if ($sitesetting->save()) {
            return redirect('admin/sitesetting/index')->with(['successMessage' => 'Success !! Sitesetting Updated']);
        } else {
            return redirect()->back()->with(['errorMessage' => 'Error Sitesetting not updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sitesetting  $sitesetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sitesetting $sitesetting, $id)
    {
        $sitesetting=Sitesetting::find($id);
        $sitesetting->delete();

        return redirect('admin/sitesetting/index')->with(['successMessage' => 'Success !! Sitesettings Deleted']);
    }
}
