@extends('layouts.master');


@section('content')
@include('includes.page_header');
<section class="about_page">
    <div class="container">

        <h4>heyyyy</h4>
        {!! $about->content !!}
    </div>
</section>




@endsection