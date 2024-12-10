{{-- @extends('layouts.master')


@section('content')
@include('includes.page_header')

@if($posts->isNotEmpty())
    @foreach ($posts as $post)
        <div class="post-list">
            <p>{{ $post->title }}</p>
            <img src="{{ $post->image }}">
        </div>
    @endforeach
@else 
    <div>
        <h2>No posts found</h2>
    </div>
@endif




@endsection --}}
@extends('layouts.master')


@section('content')
@include('includes.page_header')
<section class="product_page">
    <div class="container">

        @if($posts->isNotEmpty())
    @foreach ($posts as $post)
        <div class="post-list">
            <p>{{ $post->title }}</p>

            <figure class="one">
            <img class="about_page_img"   src="{{ asset('uploads/post/' . $post->image) }}"  alt="single service">
            </figure>
            {{-- <img src="{{ $post->image }}"> --}}
        </div>
    @endforeach
@else 
    <div>
        <h2>Sorry!No posts found</h2>
    </div>
@endif



    </div>



    
</section>




@endsection

		



