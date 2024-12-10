@extends('layouts.master')


@section('content')
{{-- @include('includes.page_header') --}}



<section class="single_service_page">
    <div class="container">

         <div class="row">
            <div class="col-md-9 row">
                <h1 class="title_service">{{ $menu->title }} </h1>
                <div class="col-md-7">
      
                    <img class="about_page_img" src="{{ asset('uploads/viewmenu/' . $menu->image) }}"  alt="single service">
    
                </div>

          
                    <div class="col-md-5 service-description" >
                        {{ $menu->description }}
                    </div>
          
            </div>
            <div class="col-md-3 mt-3">
                <div class="cards">
                    <h3> Food Menu </h3>
                    @foreach($viewmenus as $menunav)
                    
                    <a class="a_service" href="/singleservicemenu/{{ $menunav->id }} ">
                      <ul class="service_list" style="list-style: none">
                        <li>
                            {{ $menunav->title }}
    
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


