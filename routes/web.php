<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\FrontViewController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\WelcomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BackImageController;
use App\Http\Controllers\Admin\CoverImageController;
use App\Http\Controllers\Admin\SitesettingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FishgallerysController;
use App\Http\Controllers\Admin\MeatgallerysController;
use App\Http\Controllers\Admin\PhotoGalleryController;
use App\Http\Controllers\BookTableController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantTableController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/collections',[App\Http\Controllers\FrontViewController::class,'categories'])->name('collection');
Route::get('/',[App\Http\Controllers\FrontViewController::class,'index'])->name('index'); 

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

// Route::get('/search', [App\Http\Controllers\PostController::class, 'search'])->name('search');


// For Sitesetting
Route::get('admin/sitesetting', [App\Http\Controllers\SitesettingController::class, 'index'])->name('Sitesetting.index');
Route::get('admin/sitesetting/index', [App\Http\Controllers\SitesettingController::class, 'index'])->name('Sitesetting.index');

Route::get('admin/sitesetting/create', [App\Http\Controllers\SitesettingController::class, 'create'])->name('Sitesetting.create');
Route::post('admin/sitesetting/store', [App\Http\Controllers\SitesettingController::class, 'store'])->name('Sitesetting.store');

Route::get('admin/sitesetting/edit/{id}', [App\Http\Controllers\SitesettingController::class, 'edit'])->name('Sitesetting.edit');
Route::post('admin/sitesetting/update', [App\Http\Controllers\SitesettingController::class, 'update'])->name('Sitesetting.update');
Route::get('admin/sitesetting/delete/{id}', [App\Http\Controllers\SitesettingController::class, 'destroy'])->name('Sitesetting.destroy'); 


// For Cover Image

Route::get('admin/coverimage', [App\Http\Controllers\CoverImageController::class, 'index'])->name('Coverimage.index');
Route::get('admin/coverimage/index', [App\Http\Controllers\CoverImageController::class, 'index'])->name('Coverimage.index');

Route::get('admin/coverimage/create', [App\Http\Controllers\CoverImageController::class, 'create'])->name('Coverimage.create');
Route::post('admin/coverimage/store', [App\Http\Controllers\CoverImageController::class, 'store'])->name('Coverimage.store');

Route::get('admin/coverimage/edit/{id}', [App\Http\Controllers\CoverImageController::class, 'edit'])->name('Coverimage.edit');
Route::post('admin/coverimage/update', [App\Http\Controllers\CoverImageController::class, 'update'])->name('Coverimage.update');
Route::get('admin/coverimage/delete/{id}', [App\Http\Controllers\CoverImageController::class, 'destroy'])->name('Coverimage.destroy');


// For Back Image

Route::get('admin/backimage', [App\Http\Controllers\BackImageController::class, 'index'])->name('Backimage.index');
Route::get('admin/backimage/index', [App\Http\Controllers\BackImageController::class, 'index'])->name('Backimage.index');

Route::get('admin/backimage/create', [App\Http\Controllers\BackImageController::class, 'create'])->name('Backimage.create');
Route::post('admin/backimage/store', [App\Http\Controllers\BackImageController::class, 'store'])->name('Backimage.store');

Route::get('admin/backimage/edit/{id}', [App\Http\Controllers\BackImageController::class, 'edit'])->name('Backimage.edit');
Route::post('admin/backimage/update', [App\Http\Controllers\BackImageController::class, 'update'])->name('Backimage.update');
Route::get('admin/backimage/delete/{id}', [App\Http\Controllers\BackImageController::class, 'destroy'])->name('Backimage.destroy');



// FOr Categories

Route::get('admin/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('Category.index');
Route::get('admin/category/index', [App\Http\Controllers\CategoryController::class, 'index'])->name('Category.index');

Route::get('admin/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('Category.create');
Route::post('admin/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('Category.store');

Route::get('admin/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('Category.edit');
Route::post('admin/category/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('Category.update');
Route::get('admin/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('Category.destroy');


// FOr Post

Route::get('admin/post', [App\Http\Controllers\PostController::class, 'index'])->name('Post.index');
Route::get('admin/post/index', [App\Http\Controllers\PostController::class, 'index'])->name('Post.index');

Route::get('admin/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('Post.create');
Route::post('admin/post/store', [App\Http\Controllers\PostController::class, 'store'])->name('Post.store');

Route::get('admin/post/edit/{id}', [App\Http\Controllers\PostController::class, 'edit'])->name('Post.edit');
Route::post('admin/post/update', [App\Http\Controllers\PostController::class, 'update'])->name('Post.update');
Route::get('admin/post/delete/{id}', [App\Http\Controllers\PostController::class, 'destroy'])->name('Post.destroy');

// FOr About

Route::get('admin/about', [App\Http\Controllers\AboutController::class, 'index'])->name('About.index');
Route::get('admin/about/index', [App\Http\Controllers\AboutController::class, 'index'])->name('About.index');

Route::get('admin/about/create', [App\Http\Controllers\AboutController::class, 'create'])->name('About.create');
Route::post('admin/about/store', [App\Http\Controllers\AboutController::class, 'store'])->name('About.store');
Route::post('admin/about/store', [App\Http\Controllers\AboutController::class, 'store'])->name('About.store');

Route::get('admin/about/edit/{id}', [App\Http\Controllers\AboutController::class, 'edit'])->name('About.edit');
Route::post('admin/about/update', [App\Http\Controllers\AboutController::class, 'update'])->name('About.update');
Route::get('admin/about/delete/{id}', [App\Http\Controllers\AboutController::class, 'destroy'])->name('About.destroy');

// FOr About

Route::get('admin/welcome', [App\Http\Controllers\WelcomeController::class, 'index'])->name('Welcome.index');
Route::get('admin/welcome/index', [App\Http\Controllers\WelcomeController::class, 'index'])->name('Welcome.index');

Route::get('admin/welcome/create', [App\Http\Controllers\WelcomeController::class, 'create'])->name('Welcome.create');
Route::post('admin/welcome/store', [App\Http\Controllers\WelcomeController::class, 'store'])->name('Welcome.store');
Route::post('admin/welcome/store', [App\Http\Controllers\WelcomeController::class, 'store'])->name('Welcome.store');

Route::get('admin/welcome/edit/{id}', [App\Http\Controllers\WelcomeController::class, 'edit'])->name('Welcome.edit');
Route::post('admin/welcome/update', [App\Http\Controllers\WelcomeController::class, 'update'])->name('Welcome.update');
Route::get('admin/welcome/delete/{id}', [App\Http\Controllers\WelcomeController::class, 'destroy'])->name('Welcome.destroy');


// For Team Members

Route::get('admin/team', [App\Http\Controllers\TeamController::class, 'index'])->name('Team.index');
Route::get('admin/team/index', [App\Http\Controllers\TeamController::class, 'index'])->name('Team.index');

Route::get('admin/team/create', [App\Http\Controllers\TeamController::class, 'create'])->name('Team.create');
Route::post('admin/team/store', [App\Http\Controllers\TeamController::class, 'store'])->name('Team.store');

Route::get('admin/team/edit/{id}', [App\Http\Controllers\TeamController::class, 'edit'])->name('Team.edit');
Route::post('admin/team/update', [App\Http\Controllers\TeamController::class, 'update'])->name('Team.update');
Route::get('admin/team/delete/{id}', [App\Http\Controllers\TeamController::class, 'destroy'])->name('Team.destroy');


// For Videos

Route::get('admin/video', [App\Http\Controllers\VideoController::class, 'index'])->name('Video.index');
Route::get('admin/video/index', [App\Http\Controllers\VideoController::class, 'index'])->name('Video.index');

Route::get('admin/video/create', [App\Http\Controllers\VideoController::class, 'create'])->name('Video.create');
Route::post('admin/video/store', [App\Http\Controllers\VideoController::class, 'store'])->name('Video.store');

Route::get('admin/video/edit/{id}', [App\Http\Controllers\VideoController::class, 'edit'])->name('Video.edit');
Route::post('admin/video/update', [App\Http\Controllers\VideoController::class, 'update'])->name('Video.update');
Route::get('admin/video/delete/{id}', [App\Http\Controllers\VideoController::class, 'destroy'])->name('Video.destroy');


// For Gallery Image

Route::get('admin/photogallery', [App\Http\Controllers\PhotoGalleryController::class, 'index'])->name('Photogallery.index');
Route::get('admin/photogallery/index', [App\Http\Controllers\PhotoGalleryController::class, 'index'])->name('Photogallery.index');

Route::get('admin/photogallery/create', [App\Http\Controllers\PhotoGalleryController::class, 'create'])->name('Photogallery.create');
Route::post('admin/photogallery/store', [App\Http\Controllers\PhotoGalleryController::class, 'store'])->name('Photogallery.store');

Route::get('admin/photogallery/edit/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'edit'])->name('Photogallery.edit');
Route::post('admin/photogallery/update', [App\Http\Controllers\PhotoGalleryController::class, 'update'])->name('Photogallery.update');
Route::get('admin/photogallery/delete/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'destroy'])->name('Photogallery.destroy');

// for meat Gallery
Route::get('admin/meatgallery', [App\Http\Controllers\PhotoGalleryController::class, 'index'])->name('Meatgallery.index');
Route::get('admin/meatgallery/index', [App\Http\Controllers\PhotoGalleryController::class, 'index'])->name('Meatgallery.index');

Route::get('admin/meatgallery/create', [App\Http\Controllers\PhotoGalleryController::class, 'create'])->name('Meatgallery.create');
Route::post('admin/meatgallery/store', [App\Http\Controllers\PhotoGalleryController::class, 'store'])->name('Meatgallery.store');

Route::get('admin/meatgallery/edit/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'edit'])->name('Meatgallery.edit');
Route::post('admin/meatgallery/update', [App\Http\Controllers\PhotoGalleryController::class, 'update'])->name('Meatgallery.update');
Route::get('admin/meatgallery/delete/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'destroy'])->name('Meatgallery.destroy');

// for fish gallery
Route::get('admin/fishgallery', [App\Http\Controllers\PhotoGalleryController::class, 'index'])->name('Fishgallery.index');
Route::get('admin/fishgallery/index', [App\Http\Controllers\PhotoGalleryController::class, 'index'])->name('Fishgallery.index');

Route::get('admin/fishgallery/create', [App\Http\Controllers\PhotoGalleryController::class, 'create'])->name('Fishgallery.create');
Route::post('admin/fishgallery/store', [App\Http\Controllers\PhotoGalleryController::class, 'store'])->name('Fishgallery.store');

Route::get('admin/fishgallery/edit/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'edit'])->name('Fishgallery.edit');
Route::post('admin/fishgallery/update', [App\Http\Controllers\PhotoGalleryController::class, 'update'])->name('Fishgallery.update');
Route::get('admin/fishgallery/delete/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'destroy'])->name('Fishgallery.destroy');

// for vegetables

Route::get('admin/vegetablegallery', [App\Http\Controllers\PhotoGalleryController::class, 'index'])->name('Vegetablegallery.index');
Route::get('admin/vegetablegallery/index', [App\Http\Controllers\PhotoGalleryController::class, 'index'])->name('Vegetablegallery.index');

Route::get('admin/vegetablegallery/create', [App\Http\Controllers\PhotoGalleryController::class, 'create'])->name('Vegetablegallery.create');
Route::post('admin/vegetablegallery/store', [App\Http\Controllers\PhotoGalleryController::class, 'store'])->name('Vegetablegallery.store');

Route::get('admin/vegetablegallery/edit/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'edit'])->name('Vegetablegallery.edit');
Route::post('admin/vegetablegallery/update', [App\Http\Controllers\PhotoGalleryController::class, 'update'])->name('Vegetablegallery.update');
Route::get('admin/vegetablegallery/delete/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'destroy'])->name('Vegetablegallery.destroy');

// viewmenu
Route::get('admin/viewmenu', [App\Http\Controllers\ViewMenuController::class, 'index'])->name('Viewmenu.index');
Route::get('admin/viewmenu/index', [App\Http\Controllers\ViewMenuController::class, 'index'])->name('Viewmenu.index');

Route::get('admin/viewmenu/create', [App\Http\Controllers\ViewMenuController::class, 'create'])->name('Viewmenu.create');
Route::post('admin/viewmenu/store', [App\Http\Controllers\ViewMenuController::class, 'store'])->name('Viewmenu.store');

Route::get('admin/viewmenu/edit/{id}', [App\Http\Controllers\ViewMenuController::class, 'edit'])->name('Viewmenu.edit');
Route::post('admin/viewmenu/update', [App\Http\Controllers\ViewMenuController::class, 'update'])->name('Viewmenu.update');
Route::get('admin/viewmenu/delete/{id}', [App\Http\Controllers\ViewMenuController::class, 'destroy'])->name('Viewmenu.destroy');


// for food
Route::get('admin/viewmenu', [App\Http\Controllers\ViewMenuController::class, 'index'])->name('Viewmenu.index');
Route::get('admin/viewmenu/index', [App\Http\Controllers\ViewMenuController::class, 'index'])->name('Viewmenu.index');

Route::get('admin/viewmenu/create', [App\Http\Controllers\ViewMenuController::class, 'create'])->name('Viewmenu.create');
Route::post('admin/viewmenu/store', [App\Http\Controllers\ViewMenuController::class, 'store'])->name('Viewmenu.store');

Route::get('admin/viewmenu/edit/{id}', [App\Http\Controllers\ViewMenuController::class, 'edit'])->name('Viewmenu.edit');
Route::post('admin/viewmenu/update', [App\Http\Controllers\ViewMenuController::class, 'update'])->name('Viewmenu.update');
Route::get('admin/viewmenu/delete/{id}', [App\Http\Controllers\ViewMenuController::class, 'destroy'])->name('Viewmenu.destroy');




// For Projects

Route::get('admin/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('Projects.index');
Route::get('admin/projects/index', [App\Http\Controllers\ProjectController::class, 'index'])->name('Projects.index');

Route::get('admin/projects/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('Projects.create');
Route::post('admin/projects/store', [App\Http\Controllers\ProjectController::class, 'store'])->name('Projects.store');

Route::get('admin/projects/edit/{id}', [App\Http\Controllers\ProjectController::class, 'edit'])->name('Projects.edit');
Route::post('admin/projects/update', [App\Http\Controllers\ProjectController::class, 'update'])->name('Projects.update');
Route::get('admin/projects/delete/{id}', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('Projects.destroy');


// For Services

Route::get('admin/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('Services.index');
Route::get('admin/services/index', [App\Http\Controllers\ServiceController::class, 'index'])->name('Services.index');

Route::get('admin/services/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('Services.create');
Route::post('admin/services/store', [App\Http\Controllers\ServiceController::class, 'store'])->name('Services.store');

Route::get('admin/services/edit/{id}', [App\Http\Controllers\ServiceController::class, 'edit'])->name('Services.edit');
Route::post('admin/services/update', [App\Http\Controllers\ServiceController::class, 'update'])->name('Services.update');
Route::get('admin/services/delete/{id}', [App\Http\Controllers\ServiceController::class, 'destroy'])->name('Services.destroy');

// For Testimonials

Route::get('admin/testimonials', [App\Http\Controllers\TestimonialController::class, 'index'])->name('Testimonials.index');
Route::get('admin/testimonials/index', [App\Http\Controllers\TestimonialController::class, 'index'])->name('Testimonials.index');

Route::get('admin/testimonials/create', [App\Http\Controllers\TestimonialController::class, 'create'])->name('Testimonials.create');
Route::post('admin/testimonials/store', [App\Http\Controllers\TestimonialController::class, 'store'])->name('Testimonials.store');

Route::get('admin/testimonials/edit/{id}', [App\Http\Controllers\TestimonialController::class, 'edit'])->name('Testimonials.edit');
Route::post('admin/testimonials/update', [App\Http\Controllers\TestimonialController::class, 'update'])->name('Testimonials.update');
Route::get('admin/testimonials/delete/{id}', [App\Http\Controllers\TestimonialController::class, 'destroy'])->name('Testimonials.destroy');


// for Contact
Route::get('admin/contacts', [App\Http\Controllers\ContactController::class, 'index'])->name('Contacts.index');
Route::get('admin/contacts/index', [App\Http\Controllers\ContactController::class, 'index'])->name('Contacts.index');
Route::post('admin/contacts/store', [App\Http\Controllers\ContactController::class, 'store'])->name('Contacts.store');
Route::get('admin/contacts/delete/{id}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('Contacts.destroy');


//for book table
Route::get('admin/booktables', [App\Http\Controllers\BookTableController::class, 'index'])->name('BookTables.index');
Route::get('admin/booktables/index', [App\Http\Controllers\BookTableController::class, 'index'])->name('BookTables.index');
Route::post('admin/booktables/store', [App\Http\Controllers\BookTableController::class, 'store'])->name('BookTables.store');
Route::delete('admin/booktables/{id}', [App\Http\Controllers\BookTableController::class, 'destroy'])->name('BookTables.destroy');
Route::get('/get-available-tables', [BookTableController::class, 'getAvailableTables'])->name('get-available-tables');

//for resturant table
Route::get('admin/restaurant-tables', [App\Http\Controllers\RestaurantTableController::class, 'index'])->name('RestaurantTables.index');
Route::get('admin/restaurant-tables/index', [App\Http\Controllers\RestaurantTableController::class, 'index'])->name('RestaurantTables.index');

Route::get('admin/restaurant-tables/create', [App\Http\Controllers\RestaurantTableController::class, 'create'])->name('RestaurantTables.create');
Route::post('admin/restaurant-tables/store', [App\Http\Controllers\RestaurantTableController::class, 'store'])->name('RestaurantTables.store');

Route::get('admin/restaurant-tables/edit/{id}', [App\Http\Controllers\RestaurantTableController::class, 'edit'])->name('RestaurantTables.edit');
Route::put('restaurant-tables/{restaurantTable}', [RestaurantTableController::class, 'update'])->name('RestaurantTables.update');
Route::delete('admin/restaurant-tables/delete/{id}', [App\Http\Controllers\RestaurantTableController::class, 'destroy'])->name('RestaurantTables.destroy');
Route::post('/admin/restaurant-tables/{id}/toggle-status', [RestaurantTableController::class, 'toggleTableStatus'])->name('RestaurantTables.toggleStatus');
Route::post('/admin/update-table-status/{tableId}', [RestaurantTableController::class, 'updateSingleTableStatus']);
Route::post('/admin/update-table-status', [RestaurantTableController::class, 'updateAllTablesStatus'])->name('RestaurantTables.updateAllStatus');

//for payment
Route::get('/admin/payments', [PaymentController::class, 'showPayments'])->name('admin.payments');
Route::delete('/admin/payments/{id}', [PaymentController::class, 'destroyPayment'])->name('admin.payments.destroy');

//for order
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');
Route::patch('/admin/orders/{order}/complete', [OrderController::class, 'complete'])->name('admin.orders.complete');


// single controllers

Route::get('aboutus', [App\Http\Controllers\SingleController::class, 'render_about'])->name('About');
Route::get('gallery', [App\Http\Controllers\SingleController::class, 'render_gallery'])->name('Gallery');
Route::get('video', [App\Http\Controllers\SingleController::class, 'render_video'])->name('Video');

Route::get('contactus', [App\Http\Controllers\SingleController::class, 'render_contact_us'])->name('Contact');
Route::get('booktable', [App\Http\Controllers\SingleController::class, 'render_booktable'])->name('BookTable');

Route::get('products', [App\Http\Controllers\SingleController::class, 'render_product'])->name('Product');
Route::get('fish', [App\Http\Controllers\SingleController::class, 'render_fish'])->name('Fish');
Route::get('vegetable', [App\Http\Controllers\SingleController::class, 'render_vegetable'])->name('Vegetable');
Route::get('softdrinks', [App\Http\Controllers\SingleController::class, 'render_softdrink'])->name('Softdrink');
Route::get('drinks', [App\Http\Controllers\SingleController::class, 'render_alcohol'])->name('Alcohol');
Route::get('viewmenu', [App\Http\Controllers\SingleController::class, 'render_menu'])->name('Viewmenu');
Route::get('services', [App\Http\Controllers\SingleController::class, 'render_service'])->name('Service');
Route::get('cart', [App\Http\Controllers\SingleController::class, 'render_cart'])->name('cart');


Route::get('singleservice/{id}', [App\Http\Controllers\SingleController::class, 'render_service_single'])->name('Single_service');


Route::get('singleservicemenu/{id}', [App\Http\Controllers\SingleController::class, 'render_service_menu'])->name('Single_service_menu');


Route::get('search', [App\Http\Controllers\SingleController::class, 'render_search'])->name('Search');

Route::get('search_service', [App\Http\Controllers\SingleController::class, 'render_search_service'])->name('Search');


Route::get('search_gallery', [App\Http\Controllers\SingleController::class, 'render_search_gallery'])->name('Search');


Route::get('category/{id}', [App\Http\Controllers\SingleController::class, 'render_cat'])->name('Category');
Route::get('postview/{id}', [App\Http\Controllers\SingleController::class, 'render_post'])->name('Post');
Route::get('allposts', [App\Http\Controllers\SingleController::class, 'render_allposts'])->name('Allpost');

Route::get('/payment', [FrontViewController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/payment/send-otp', [FrontViewController::class, 'sendOtp'])->name('payment.send-otp');
Route::post('/payment', [FrontViewController::class, 'processPayment'])->name('payment.process');