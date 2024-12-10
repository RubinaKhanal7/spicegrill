@extends('layouts.master')


@section('content')
<section class="header_page">
    <h1 class="header_page_title" style="color:olivedrab"> 
   {{ $category->title }}
    </h1>
</section>


<section class="services_page">
    <div class="container">
        <div class="box-wrapper row">
            @foreach ($posts as $post)
                
            <div class="col-md-4">
            <figure class="shape-box shape-box_half">
                <img src="{{ asset('uploads/post/' . $post->image) }}" alt="">
                <div class="brk-abs-overlay z-index-0 bg-black opacity-60"></div>
                <figcaption>
                    <div class="show-cont">
                        {{-- <h3 class="card-no">{{ $loop->iteration }}</h3> --}}
                        <h4 class="card-main-title">{{ $post->title }}</h4>
                    </div>
                    <p class="card-content">
                        {{ Str::substr($post->description,0,150) }}
                    </p>
                    <a href="{{ route('Post', $post->id) }}" class="read-more-btn">Read More</a>
                </figcaption>
                <span class="after"></span>
            </figure>
        </div>
            @endforeach
      
        </div>
    </div>
</section>



@endsection


		



