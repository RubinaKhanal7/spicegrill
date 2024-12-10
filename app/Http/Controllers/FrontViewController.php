<?php

namespace App\Http\Controllers;

use App\Models\BackImage;
use App\Models\Category;
use App\Models\CoverImage;
use App\Models\PhotoGallery;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\Sitesetting;
use App\Models\Team;
use App\Models\About;
use App\Models\Video;
use App\Models\Welcome;
use App\Models\Testimonial;
use App\Models\Payment;
use App\Models\Order;
use Stripe\Stripe;
use Stripe\Charge;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Log;
// use App\Http\Controllers\PostController;
// use App\Http\Controllers\CategoryController;





use Illuminate\Http\Request;

class FrontViewController extends Controller
{

public function index(Request $request){

    $backimages= BackImage::first();
    $categoriesnav = Category::latest()->get()->take(10);
    $coverimages = CoverImage::latest()->get()->take(5);
    $photogallerys = PhotoGallery::latest()->get()->take(6);
    

 

    $posts = Post::with('getCategories')->latest()->get()->take(1);




    $categoriesun = Category::with(['getPosts'=>function($query){
        $query->latest()->take(1);
    }])->whereIn('id',[1])->get();

    $categories = Category::with(['getPosts'=>function($query){
        $query->latest()->take(1);
    }])->whereIn('id',[2])->get();

    $categoriesone = Category::with(['getPosts'=>function($query){
        $query->latest()->take(1);
    }])->whereIn('id',[3])->get();

    $categoriestwo = Category::with(['getPosts'=>function($query){
        $query->latest()->take(1);
    }])->whereIn('id',[4])->get();

    $categoriesthree = Category::with(['getPosts'=>function($query){
        $query->latest()->take(1);
    }])->whereIn('id',[5])->get();

    // $categoriesfour = Category::with(['getPosts'=>function($query){
    //     $query->latest()->take(1);
    // }])->whereIn('id',[5])->get();
    
    $projects = Project::latest()->get()->take(3);
    $abouts = About::latest()->get()->take(1);
    $welcomes = Welcome::latest()->get()->take(1);
    $services = Service::latest()->get()->take(3);
    
    $servicenav = Service::all();
    $sitesetting = Sitesetting::latest();
    // $teams = Team::first()->get()->take(3);
    $testimonials= Testimonial::latest()->get()->take(9);
    $videos = Video::latest()->get()->take(9);




    $foodposts = Post::with(['getCategories' => function ($query){
        $query->latest();
    }])
    ->whereHas('getCategories', function ($query){
        $query->where('category_id', 1);
    })
    ->orderBy('created_at', 'desc')->latest()->take(4)->get();
     
    $firstpost = Post::with(['getCategories' => function ($query) {
        $query->latest();
    }])
        ->whereHas('getCategories', function ($query){
            $query->where('category_id', 2);
        })
        ->orderBy('created_at', 'desc')->latest()->take(1)->get();

    $secondpost = Post::with(['getCategories' => function ($query) {
        $query->latest();
    }])
        ->whereHas('getCategories', function ($query){
            $query->where('category_id', 2);
        })
        ->whereNotIn('id', $firstpost->pluck('id'))
        ->orderBy('created_at', 'desc')->latest()->take(1)->get();

    $thirdpost = Post::with(['getCategories' => function ($query){
        $query->latest();
    }])
    ->whereHas('getCategories', function ($query){
        $query->where('category_id', 3);
    })
    ->orderBy('created_at' , 'desc')->latest()->take(1)->get();


    $fourthpost = Post::with(['getCategories' => function ($query) {
        $query->latest();
    }])
        ->whereHas('getCategories', function ($query){
            $query->where('category_id', 3);
        })
        ->whereNotIn('id', $thirdpost->pluck('id'))
        ->orderBy('created_at', 'desc')->latest()->take(1)->get();
  
    $fifthpost = Post::with(['getCategories' => function ($query){
        $query->latest();
    }])
    ->whereHas('getCategories', function ($query){
        $query->where('category_id', 4);
    })
    ->orderBy('created_at' , 'desc')->latest()->take(1)->get();


    $sixthpost = Post::with(['getCategories' => function ($query) {
        $query->latest();
    }])
        ->whereHas('getCategories', function ($query){
            $query->where('category_id', 4);
        })
        ->whereNotIn('id', $fifthpost->pluck('id'))
        ->orderBy('created_at', 'desc')->latest()->take(1)->get();




    return view('index',[
        'backimages'=>$backimages,
        'categoriesnav'=>$categoriesnav,
        'coverimages'=>$coverimages,
        'photogallerys'=>$photogallerys,
        'posts'=>$posts,
        'categories'=>$categories,
        'categoriesone'=>$categoriesone,
        'categoriestwo'=>$categoriestwo,
        'categoriesthree'=> $categoriesthree,
        'categoriesun'=>$categoriesun,  
        'projects'=>$projects,
        'abouts'=>$abouts,
        'services'=>$services,
        'sitesetting'=>$sitesetting,
        'welcomes'=>$welcomes,
        'servicenav'=>$servicenav,
        // 'post'=>$post,
        'testimonials'=>$testimonials,
        'videos' => $videos,
        'foodposts' => $foodposts,
        'firstpost' => $firstpost,
        'secondpost' => $secondpost,
        'thirdpost' => $thirdpost,
        'fourthpost' => $fourthpost,
        'fifthpost' => $fifthpost,
        'sixthpost' => $sixthpost,
        
    ]);
}

public function postByCategory($id){
    $category = Category::where('id',$category_id)->first();
    if($category){
        $post = Post::where('category_id',$category->id)->get();
        return view('index');
    }
    else{
        return redirect('/');
    }
    $posts = $category->posts;
    return $posts;
}

public function categoryByPost($id){
    $post = Post::find($id);
    $categories = $post->categories;
    return $categories;
}
// thapya wala
public function categories(){
    return view('frontend.collections.category.index');

}

// public function singleservice(){





// }

public function showPaymentForm(Request $request)
    {
        $page_title = 'Payment';       
        $sitesetting = Sitesetting::first();
        $abouts = About::latest()->get()->take(1);
        $categoriesnav = Category::latest()->get()->take(10);
        
        $total = $request->query('total', 0);

        return view('payment', compact('page_title', 'sitesetting', 'abouts', 'categoriesnav', 'total'));
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        $otp = mt_rand(100000, 999999);
        $email = $request->email;
    
        session(['payment_otp' => $otp, 'payment_email' => $email]);
    
        try {
            Mail::to($email)->send(new OtpMail($otp));
            return response()->json(['message' => 'OTP sent successfully'], 200);
        } catch (\Exception $e) {
            Log::error('OTP send error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send OTP'], 500);
        }
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'state' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'amount' => 'required|numeric',
            'otp' => 'required',
            'cart_items' => 'required|json',
        ]);

        if ($request->otp != session('payment_otp') || $request->email != session('payment_email')) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = Charge::create([
                'amount' => $request->amount * 100,
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for order',
            ]);

            $payment = Payment::create([
                'name' => $request->name,
                'state' => $request->state,
                'city' => $request->city,
                'street_address' => $request->street_address,
                'postal_code' => $request->postal_code,
                'phone' => $request->phone,
                'email' => $request->email,
                'amount' => $request->amount,
                'stripe_charge_id' => $charge->id,
            ]);

           // Create order
            $cartItems = json_decode($request->cart_items, true);
            $orderDetails = [];
            foreach ($cartItems as $itemName => $details) {
                $orderDetails[] = [
                    'name' => $itemName,
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ];
            }

            Order::create([
                'payment_id' => $payment->id,
                'customer_name' => $request->name,
                'order_details' => $orderDetails,
                'total_amount' => $request->amount,
                'status' => 'Incomplete' 
            ]);
            session()->forget(['payment_otp', 'payment_email']);
            session()->flash('payment_success', 'Payment successful! Your order has been placed.');

            return redirect()->route('cart')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }


}