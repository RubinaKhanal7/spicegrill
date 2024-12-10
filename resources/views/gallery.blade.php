@extends('layouts.master')

@section('content')
@include('includes.page_header')
<section class="gallery_page">
    <div class="container">

       

        <div class="row gallery-images-container">
                @foreach($photogallerys as $photogallery)
                <div class="col-md-3">
                    <figure class="one">
                        
                        <a href="{{ asset('uploads/gallery/' . $photogallery->image) }}" data-lightbox="myimage">
                            <img class="gallery_page_img"   src="{{ asset('uploads/gallery/' . $photogallery->image) }}"  alt="Photo gallery">
                        </a> 
                    </figure>
                </div>
                  
                    
                @endforeach
            </div>


    </div>
</section>

@endsection