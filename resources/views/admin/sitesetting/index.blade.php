@extends('admin.layouts.master')

@section('content') 


<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">{{ $page_title }}</h1>
     <a href="{{ url('admin/sitesetting/create') }}"><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>Add Sitesetting</button></a> 
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v1</li>
      </ol>
    </div><!-- /.col -->
  </div>


  <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Office Name</th>
            <th>Office Email</th>
            <th>Office Contact</th>
            <th>Office Logo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sitesettings as $sitesetting)
            <tr data-widget="expandable-table" aria-expanded="false">
                <td>{{ $sitesetting->office_name ?? '' }}</td>
                <td>{{ $sitesetting->office_mail ?? '' }}</td>
                <td>{{ $sitesetting->office_contact ?? '' }}</td>
                <td>
              

                  <img id="preview1"  src="{{ url('uploads/sitesetting/' . $sitesetting->main_logo) }}"
                      style="width: 150px; height:150px" />
                </td>
                
                <td>
                    <a href="/admin/sitesetting/edit/{{ $sitesetting->id }}">
                        <div style="display: flex; flex-direction:row;">
                            <button type="button" class="btn btn-block btn-warning btn-sm"><i
                                    class="fas fa-edit"></i> Update </button>
                    </a>
                    <a href="{{ url('admin/sitesetting/delete/'.$sitesetting->id) }}">
                    <button type="button" class="btn btn-block btn-danger btn-sm" data-toggle="modal"
                        data-target="#modal-default" style="width:auto;"
                        onclick="replaceLinkFunction">Delete</button>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>



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