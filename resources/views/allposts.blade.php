@extends('layouts.master')


@section('content')
<section class="header_page">
    <h1 class="header_page_title" style="color:olivedrab"> 
  Our Services
    </h1>
</section>


<section class="services_page">
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4">
               <a href="/postview/{{ $post->id }}">
                <figure class="service_image">
                    <img src="{{ asset('uploads/post/' . $post->image) }}" alt="Post Image">
                    <figcaption>{{ $post->title }}</figcaption>
                </figure>
            </a> 
            </div>
            @endforeach
        </div>
    </div>
</section>



@endsection


		



