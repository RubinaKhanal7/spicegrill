@extends('layouts.master')


@section('content')
    {{-- @include('includes.page_header') --}}



    <section class="single_service_page">
        <div class="container">

            <h1 class="title_service">{{ $post->title }} </h1>

            <div class="row">

                <div class="col-md-4">



                    <img class="about_page_img" src="{{ asset('uploads/post/' . $post->image) }}" alt="single service">



                </div>
                <div class="col-md-4 service-description">
                    {{ $post->description }}
                </div>

                <div class="col-md-4 service-description">
                    {{-- @foreach ($servicenav as $services)
                <a class="" href="{{ route('Service') }}"> {{ $service->title }}</a>  --}}

                    <div class="cards">
                        <h3> Other Services </h3>
                        @foreach ($servicenav as $service)
                            {{-- <a class="dropdown-item" href="{{ route('Service') }}">{{ $service->title }} </a> --}}

                            <a class="a_service" href="/singleservice/{{ $service->id }} ">
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



{{-- <p>{{ $service->title }}</p> --}}
{{-- <img class="gallery_page_img" src="{{ asset('uploads/service/' . $service->image) }}" alt="Photo gallery">  


                        {{ $service->title }}
                         --}}
