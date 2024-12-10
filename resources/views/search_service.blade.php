
@extends('layouts.master')


@section('content')
@include('includes.page_header')
<section class="product_page">
    <div class="container">

        @if($services->isNotEmpty())
    @foreach ($services as $service)
        <div class="post-list">
            <p>{{ $service->title }}</p>

            <figure class="one">
            <img class="about_page_img"   src="{{ asset('uploads/service/' . $service->image) }}"  alt="single service">
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

		



