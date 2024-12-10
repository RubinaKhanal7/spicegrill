
@extends('layouts.master')


@section('content')
@include('includes.page_header')
<section class="product_page">
    <div class="container">

        @if($photogallerys->isNotEmpty())
    @foreach ($photogallerys as $photogallery)
        <div class="post-list">
            <p>{{ $photogallery->title }}</p>

            <figure class="one">
            <img class="about_page_img"   src="{{ asset('uploads/gallery/' . $photogallery->image) }}"  alt="single service">
            </figure>
            {{-- <img src="{{ $post->image }}"> --}}
        </div>
    @endforeach
@else 
    <div>
        <h2>No posts found</h2>
    </div>
@endif



    </div>



    
</section>




@endsection

		



