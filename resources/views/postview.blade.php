@extends('layouts.master')


@section('content')
{{-- @include('includes.page_header') --}}

<style>
        .cards {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
</style>

<section class="single_service_page">
    <div class="container">

         <div class="row">
            <div class="col-md-9 row">
                <h1 class="title_service">{{ $post->title }} </h1>
                <div class="col-md-6">
      
                    <img class="about_page_img" src="{{ asset('uploads/post/' . $post->image) }}"  alt="single service">
    
                </div>

          
                    <div class="col-md-6 service-description" >
                        {{ $post->description }}
                    </div>
          
            </div>
            <div class="col-md-3 mt-3">
                <div class="cards">
                    <h3> Other Services </h3>
                    @foreach($postslist as $service)
                    
                    <a class="a_service" href="/postview/{{ $service->id }} ">
                      <ul class="service_list" style="list-style: none">
                        <li>
                            {{ $service->title }}
    
                        </li>
                        
                    </ul> 
                        </a> 
                     @endforeach
                    </div>
            </div>

        </div>

        
    


</div>
   
</section>

@endsection


