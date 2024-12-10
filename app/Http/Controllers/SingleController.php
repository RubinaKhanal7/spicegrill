<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\About;
use App\Models\Video;
use App\Models\Service;
use App\Models\Welcome;
use App\Models\Category;
use App\Models\ViewMenu;
use App\Models\BackImage;
use App\Models\BookTable;
use App\Models\Sitesetting;
use App\Models\PhotoGallery;
use Illuminate\Http\Request;


class SingleController extends Controller
{
    //
    public function render_about(Request $request){
        $backimages= BackImage::latest()->get()->take(1);
        $page_title = 'About us';
        $services = Service::latest()->get()->take(1);
        $welcomes = Welcome::latest()->get()->take(1); 
        $abouts = About::latest()->get()->take(1);
        $about = About::first();
        $sitesetting = Sitesetting::first();
        $categoriesnav = Category::latest()->get()->take(10);
        $servicenav = Service::all();
        return view('aboutus', compact('backimages','page_title','services','welcomes','about','abouts','sitesetting',
    'categoriesnav','servicenav'));
    }


    public function render_gallery(Request $request){
        $backimages = BackImage::latest()->get()->take(1);
        $page_title = 'Gallery';
        $sitesetting = Sitesetting::first();
        $photogallerys = PhotoGallery::all();
        $services = Service::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $abouts = About::latest()->get()->take(1);
        $servicenav = Service::all();

        return view('gallery',compact('backimages','page_title','photogallerys','sitesetting','services','categoriesnav','abouts','servicenav'));

    }

    public function render_video(Request $request){
        $backimages = BackImage::latest()->get()->take(1);
        $page_title = 'Video Gallery';
        $sitesetting = Sitesetting::first();
        $videos = Video::all();
        $services = Service::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $abouts = About::latest()->get()->take(1);
        $servicenav = Service::all();

        return view('videogallery',compact('backimages','page_title','videos','sitesetting','services','categoriesnav','abouts','servicenav'));

    }
    // this one is original
    public function render_contact_us(Request $request){
        $backimages = BackImage::latest()->get()->take(1);
        $page_title = 'Contact Us';
        $sitesetting = Sitesetting::first();
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        // $servicenav = Service::all();
        
        return view('contactus',compact('backimages','page_title','sitesetting','abouts','categoriesnav'));
    }

    public function render_booktable()
    {
        $page_title = 'Book Table';
        $booktables = BookTable::all();
        $sitesetting = Sitesetting::first();
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        return view('booktable', compact('booktables','page_title','sitesetting','abouts','categoriesnav'));
    }

    
    public function render_cart()
    {
        $page_title = 'Your Order';
        $sitesetting = Sitesetting::first();
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        return view('cart', compact('page_title','sitesetting','abouts','categoriesnav'));
    }

    
    // small hyperlink wala product tyo arrow wala
    public function render_product(Request $request){
        $backimages = BackImage::latest()->get()->take(1);
        $page_title = 'Meat Products';
        $sitesetting = Sitesetting::first();
        $viewmenus = ViewMenu::whereType('meat')->latest()->get();
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $servicenav = Service::all();

        
        return view('products',compact('backimages','page_title','sitesetting','viewmenus','abouts','categoriesnav','servicenav'));
    }
    
    public function render_softdrink(Request $request){
        $backimages = BackImage::latest()->get()->take(1);
        $page_title = 'Soft Drinks';
        $sitesetting = Sitesetting::first();
        $viewmenus = ViewMenu::whereType('softdrink')->latest()->get();
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $servicenav = Service::all();
        
        return view('products',compact('backimages','page_title','sitesetting','viewmenus','abouts','categoriesnav','servicenav'));



    }
    public function render_alcohol(Request $request){
        $backimages = BackImage::latest()->get()->take(1);
        $page_title = 'Drinks';
        $sitesetting = Sitesetting::first();
        $viewmenus = ViewMenu::whereType('alcohol')->latest()->get();
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $servicenav = Service::all();
        
        return view('products',compact('backimages','page_title','sitesetting','viewmenus','abouts','categoriesnav','servicenav'));



    }
    public function render_fish(Request $request){
        $backimages = BackImage::latest()->get()->take(1);
        $page_title = 'Fish Products';
        $sitesetting = Sitesetting::first();
        $viewmenus = ViewMenu::whereType('fish')->latest()->get();
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $servicenav = Service::all();
        
        return view('products',compact('backimages','page_title','sitesetting','viewmenus','abouts','categoriesnav','servicenav'));



    }

    public function render_vegetable(Request $request){
        $backimages = BackImage::latest()->get()->take(1);
        $page_title = 'Vegetable Products';
        $sitesetting = Sitesetting::first();
        $viewmenus = ViewMenu::whereType('vegetable')->latest()->get();
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $servicenav = Service::all();
        
        return view('products',compact('backimages','page_title','sitesetting','viewmenus','abouts','categoriesnav','servicenav'));
    }

    public function render_menu(Request $request){
        $backimages = BackImage::latest()->get()->take(1);
        $page_title = 'View Menu';
        $sitesetting = Sitesetting::first();
        $fishTitle = 'Fish Menu';
        $fish = ViewMenu::whereType('fish')->latest()->get();
        $meatTitle = 'Meat Menu';
        $meat = ViewMenu::whereType('meat')->latest()->get();
        $vegTitle = 'Vegetable Menu';
        $veg = ViewMenu::whereType('vegetable')->latest()->get();
        $softdrinkTitle = 'Soft Drinks Menu';
        $softdrink = ViewMenu::whereType('softdrink')->latest()->get();
        $alcoholTitle = 'Drinks Menu';
        $alcohol = ViewMenu::whereType('alcohol')->latest()->get();
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $servicenav = Service::all();
        $posts = Post::all();
        return view('viewmenu',compact('backimages','page_title','sitesetting','abouts','categoriesnav','servicenav','fish','fishTitle','meat','meatTitle', 'vegTitle', 'veg', 'softdrinkTitle','softdrink', 'alcoholTitle', 'alcohol','posts'));



    }




    public function render_cat($id){
        $category = Category::find($id);
        $page_title = 'Our Services';
        $sitesetting = Sitesetting::first();
        $posts = Post::whereHas('getCategories', function ($q) use ($id) {
            $q->where('category_id', $id);
        })->latest()->paginate(10);
        $categoriesnav = Category::latest()->get()->take(10);
        $abouts = About::latest()->get()->take(1);


        return view('services', compact('category', 'posts','categoriesnav', 'sitesetting', 'abouts'));
    }


    public function render_post($id){
        $post = Post::find($id);
        $sitesetting = Sitesetting::first();
        $categoriesnav = Category::latest()->get()->take(10);
        $abouts = About::latest()->get()->take(1);
        $postslist = Post::latest()->whereNotIn('id',[$id])->get()->take(10);

        return view('postview', [
            'post'=>$post,
            'sitesetting'=>$sitesetting,
            'categoriesnav'=>$categoriesnav,
            'abouts'=>$abouts,
            'postslist'=>$postslist,
            
        ]);
    }

    public function render_allposts(Request $request){
        $posts = Post::all();
        $sitesetting = Sitesetting::first();
        $categoriesnav = Category::latest()->get()->take(10);
        $abouts = About::latest()->get()->take(1);
        $page_title = 'Our Services';
        return view('allposts', compact('posts','sitesetting', 'categoriesnav', 'abouts'));
    }

    public function render_service(Request $request){
        $backimages = BackImage::latest()->get()->take(1);
        $page_title = 'Services';
        $sitesetting = Sitesetting::first();
        $viewmenus = ViewMenu::latest()->get()->take(5);
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $servicenav = Service::all();
        $posts = Post::all();
        $services = Service::all();
        return view('services',compact('backimages','page_title','sitesetting','abouts','categoriesnav','servicenav','viewmenus','posts','services'));

    }

   


    // public function reder_singlepage($id){
    //     $service = Service::find($id);
    // }

    // {{ $service->title }}



    // for the single services 
    public function render_service_single($id){
        $backimages = BackImage::latest()->get()->take(1);
        // $page_title = 'Single Services';
        $sitesetting = Sitesetting::first();
        $viewmenus = ViewMenu::latest()->get()->take(5);
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $servicenav = Service::all();
        $posts = Post::all();
        $service = Service::find($id);
        // $services = Service::all();
        return view('singleservice',compact('backimages','sitesetting','abouts','categoriesnav','servicenav','viewmenus','posts','service'));

    }

    public function render_service_menu($id){
        $backimages = BackImage::latest()->get()->take(1);
       
        $sitesetting = Sitesetting::first();
        $viewmenus = ViewMenu::latest()->get()->take(10);
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        $servicenav = Service::all();
        $posts = Post::all();
        $menu = ViewMenu::find($id);

        // $services = Service::all();
        return view('singleservicemenu',compact('backimages','sitesetting','abouts','categoriesnav','servicenav','viewmenus','menu'));

    }
    public function render_search(Request $request){
        $page_title = 'Search';
        $sitesetting = Sitesetting::first();
        $categories = Category::latest()->get()->take(10);

        $abouts = About::latest()->get()->take(1);
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('search', compact('posts','page_title','sitesetting','abouts','categories'));
    }


    public function render_search_service(Request $request){
        $page_title = 'Search';
        $sitesetting = Sitesetting::first();
        $categories = Category::latest()->get()->take(10);

        $abouts = About::latest()->get()->take(1);
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $services = Service::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('search_service', compact('services','page_title','sitesetting','abouts','categories'));
    }
    
    public function render_search_gallery(Request $request){
        $page_title = 'Search';
        $sitesetting = Sitesetting::first();
        $categories = Category::latest()->get()->take(10);

        $abouts = About::latest()->get()->take(1);
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $photogallerys = PhotoGallery::query()
            ->where('title', 'LIKE', "%{$search}%")
            // ->orWhere('content', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('search_gallery', compact('photogallerys','page_title','sitesetting','abouts','categories'));
    }

  
   
}
