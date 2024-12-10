@extends('layouts.master')

@section('content')
@include('includes.page_header')
<section class="gallery_page">
    <div class="container">

       

        <div class="row gallery-images-container">
                @foreach($videos as $video)
                <div class="col-md-3">
                    <figure class="one">
                        
                        <iframe width="100%" height="315" src="{{ $video->url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    </figure>
                </div>
                  
                    
                @endforeach
            </div>


    </div>
</section>

@endsection