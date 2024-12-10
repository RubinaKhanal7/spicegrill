@extends('layouts.master')


@section('content')
@include('includes.page_header')
<section class="single_service_page">
    <div class="container">

      

        <div class="row">

            <div class="col-md-5">

                <img class="about_page_img" src="{{ asset('uploads/about/' . $about->image) }}" alt="About us">
            </div>
            <div class ="col-md-7">
                {!! $about->content !!}
            </div>

        </div>
    </div>
</section>
@endsection