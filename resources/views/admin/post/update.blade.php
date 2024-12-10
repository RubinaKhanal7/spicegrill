@extends('admin.layouts.master')


@section('content')
    <!-- Content Wrapper. Contains page content -->





    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">{{ $page_title }}</h1> --}}
                    {{-- <a href="{{ url('admin/posts/add') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add Team Member</button></a> --}}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form id="quickForm" method="POST" action="{{ route('Post.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $post->id }}">
                {{-- <input type="hidden" name="id" value="{{ $about->id }}"> --}}
                <div class="form-group">
                    <label for="title">Title</label><span style="color:red; font-size:large"> *</span>
                    <input style="width:auto;" type="text" name="title" class="form-control" id="title"
                        placeholder="Title" value="{{ $post->title }}">
                </div>
                <div>
                    <label for="description">Description</label><span style="color:red; font-size:large">
                        *</span>
                    <textarea style="max-width: 30%;" type="text" class="form-control" name="description" id="description"
                        placeholder="Add Description" value="">{{ $post->description }}
                      </textarea>
                </div>

                <div class="form-group">


                    <label for="pdf">PDF</label>
                    {{-- <span style="color:red; font-size:large"> *</span> --}}
                    <input type="file" name="file" class="form-control" id="pdf" onchange="previewImage(event)"
                        placeholder="PDF">

                </div>
                <div class="form-group">


                    <label for="image">Image</label><span style="color:red; font-size:large"> *</span>
                    <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)"
                        placeholder="Image">
                    <img id="preview1" src="{{ url('uploads/post/' . $post->image) }}"
                        style="max-width: 300px; max-height:300px" />
                </div>


                <div class="form-group" style="margin: auto;">
                    <label>Categories</label>
                    @foreach ($categories as $category)
                    <div class="form-check checkbox2">
                        <input class="form-check-input" name="categories[]" value="{{ $category->id }}" type="checkbox" @if ($post->getCategories->contains($category->id))
                        checked
                        @endif>
                        <label class="form-check-label">{{ $category->title ?? '' }}</label>
                    </div>
                    @endforeach
                </div>


                <div class="form-group">
                    <label for="summernote">Content</label><span style="color:red; font-size:large"> *</span>
                    <textarea id="summernote" name="content" value="">
                      {{ $post->content }}
                    </textarea>
                </div>


        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>



        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <script>
        const previewImage = e => {
            const reader = new FileReader();
            reader.readAsDataURL(e.target.files[0]);
            reader.onload = () => {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            };
        };
    </script>






@stop
