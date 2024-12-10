@extends('admin.layouts.master')

@section('content')


    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $page_title }}</h1>
            {{-- <a href="{{ url('admin/sitesetting/create') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add Sitesetting</button></a> --}}
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div><!-- /.col -->
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="quickForm" method="POST" action="{{ route('Sitesetting.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div>
                <input name="id" value="{{ $sitesetting->id }}" hidden>
                <div class="form-group">
                    <label for="govn_name">Government Name</label>
                    <input type="text" name="govn_name" class="form-control" placeholder="Government Name" id="govn_name"
                        value="{{ $sitesetting->govn_name ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="ministry_name">Ministry Name</label>
                    <input type="text" name="ministry_name" class="form-control" placeholder="Ministry Name"
                        id="ministry_name" value="{{ $sitesetting->ministry_name ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="department_name">Department Name</label>
                    <input type="text" name="department_name" class="form-control" placeholder="Department Name"
                        id="department_name" value="{{ $sitesetting->department_name ?? ''}}">
                </div>

                <div class="form-group">
                    <label for="office_name">Office Name</label>
                    <input type="text" name="office_name" class="form-control" placeholder="Office Name" id="office_name"
                        value="{{ $sitesetting->office_name ?? ''}}">
                </div>

                <div class="form-group">
                    <label for="office_address">Office Address</label>
                    <input type="text" name="office_address" class="form-control" placeholder="Address"
                        id="office_address" value="{{ $sitesetting->office_address ?? ''}}">
                </div>

                <div class="form-group">
                    <label for="office_contact">Office Contact</label>
                    <input type="text" name="office_contact" class="form-control" placeholder="Office Contact"
                        id="office_contact" value="{{ $sitesetting->office_contact ?? ''}}">
                </div>

                <div class="form-group">
                    <label for="office_mail">Office Email</label>
                    <input type="email" name="office_mail" class="form-control" placeholder="Email" id="office_mail"
                        value="{{ $sitesetting->office_mail ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="main_logo">Main Logo</label>
                    <input type="file" name="main_logo" class="form-control" placeholder="Main Logo" id="main_logo"
                    onchange="previewImage1(event)" >

                    <img id="preview1"  src="{{ url('uploads/sitesetting/' . $sitesetting->main_logo) ?? ''}}"
                        style="max-width: 300px; max-height:300px" />
                </div>

                <div class="form-group">
                    <label for="side_logo">Side Logo</label>
                    <input type="file" name="side_logo" class="form-control" placeholder="Side Logo" id="side_logo">

                </div>
                <div class="form-group">
                    <label for="face_link">Facebook URL</label>
                    <input name="face_link" class="form-control" placeholder="Facebook URL (https://)" id="face_link"
                        value="{{ $sitesetting->face_link ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="insta_link">Insta URL</label>
                    <input name="insta_link" class="form-control" placeholder="Insta URL (https://)" id="insta_link"
                        value="{{ $sitesetting->insta_link ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="insta_link">Linkedin URL</label>
                    <input name="linked_link" class="form-control" placeholder="LinkedIn URL (https://)" id="linked_link"
                        value="{{ $sitesetting->linked_link ?? ''}}">
                </div>
                <div class="form-group">
                    <label for="social_link">Social URL</label>
                    <input name="social_link" class="form-control" placeholder="Social URL (https://)" id="social_link"
                        value="{{ $sitesetting->social_link?? '' }}">
                </div>
                <div class="form-group">
                    <label for="social_link">Google Map</label>
                    <input name="google_maps" class="form-control" placeholder="Google Maps URL (https://)"
                        id="google_maps" value="{{ $sitesetting->google_maps ?? ''}}">
                </div>

            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Apply</button>
        </div>
    </form>





    </form>
    <script>
        const previewImage1 = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview1');
                preview.src = reader.result;
            };
        };
    </script>



@stop
