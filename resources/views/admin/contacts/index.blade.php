@extends('admin.layouts.master')

@section('content')

<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">{{ $page_title }}</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
        </ol>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $contact->name ?? '' }}</td>
                    <td>{{ $contact->email ?? '' }}</td>
                    <td>{{ $contact->phone_no ?? '' }}</td>
                    <td>{{ $contact->message ?? '' }}</td>
                    <td>
                        <a href="{{ url('admin/contacts/delete/'.$contact->id) }}" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $contact->id }}').submit();">
                            <button type="button" class="btn btn-danger btn-sm" style="width:auto;">Delete</button>
                        </a>
                        <form id="delete-form-{{ $contact->id }}" action="{{ url('admin/contacts/delete/'.$contact->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
