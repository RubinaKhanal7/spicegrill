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
            <form id="quickForm" method="POST" action="{{ route('Viewmenu.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $viewmenus->id }}">
                {{-- <input type="hidden" name="id" value="{{ $about->id }}"> --}}
                <div class="form-group">
                    <label for="title">Title</label><span style="color:red; font-size:large"> *</span>
                    <input style="width:auto;" type="text" name="title" class="form-control" id="title"
                        placeholder="Title" value="{{ $viewmenus->title }}">
                </div>
               

              
                <div class="form-group">
                    <label for="image">Image</label><span style="color:red; font-size:large"> *</span>
                    <input type="file" name="image" class="form-control" id="image" onchange="previewImage(event)"
                        placeholder="Image">
                    <img id="preview1" src="{{ url('uploads/viewmenu/' . $viewmenus->image) }}"
                        style="max-width: 300px; max-height:300px" />
                </div>

                <div class="form-group" style="margin: auto;">
                    <label>Type</label>
                    <select class="form-control" name="type">
                        <option value="0" disabled selected>--Select Type --</option>
                        <option value="meat" @if ($viewmenus->type=='meat')
                            selected
                        @endif>Meat</option>
                        <option value="fish" @if ($viewmenus->type=='fish')
                            selected
                        @endif>Fish</option>
                        <option value="vegetable" @if ($viewmenus->type=='vegetable')
                            selected
                        @endif>Vegetable</option>
                       
                        <option value="softdrink" @if ($viewmenus->type=='softdrink')
                            selected
                        @endif>Soft Drink</option>
                       
                        <option value="alcohol" @if ($viewmenus->type=='alcohol')
                            selected
                        @endif>Alcohol</option>
                       
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input style="width:auto;" type="text" name="price" class="form-control" id="price"
                        placeholder="Price" value="{{ $viewmenus->price }}">
                </div>

                <div>
                    <label for="registration_date">Description</label><span style="color:red; font-size:large">
                        *</span>
                    <textarea style="max-width: 30%;" type="text" class="form-control" name="description" id="description"
                        placeholder="Add Description" value="{{ old('description') }}">
                        {{ $viewmenus->description }}
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


