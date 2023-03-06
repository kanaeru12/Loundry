@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

<!-- Main Content goes here -->

<a href="{{ route('member.create') }}" class="btn btn-primary mb-3" style="background-color: #666262; color: rgb(0, 0, 0);">Tambah Membership</a>

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<table class="table table-bordered table-stripped">
    <thead>
        <tr style="background-color: #666262; color: white;">
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>No Telp</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($member as $item)
        <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->jenis_kelamin }}</td>
            <td>{{ $item->tlp }}</td>
            <td>
                <div class="d-flex">
                    <a href="{{ route('member.edit', $item->id) }}" class="btn mr-2 rounded-circle py-2" style="background-color: rgb(238, 204, 9);"><i class="fas fa-fw fa-pen text-white"></i></a>
                    <form action="{{ route('member.destroy', $item->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn rounded-circle py-2" style="background-color: rgb(214, 9, 9);"
                            onclick="return confirm('Are you sure to delete this?')"><i class="fas fa-fw fa-trash text-white"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<!-- End of Main Content -->
@endsection

@push('notif')
@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('warning'))
<div class="alert alert-warning border-left-warning alert-dismissible fade show" role="alert">
    {{ session('warning') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
</div>
@endif
@endpush
