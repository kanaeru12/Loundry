@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

<!-- Main Content goes here -->

<div class="card">
    <div class="card-body">
        <form action="{{ route('member.update', $member->id) }}" method="post">
            @csrf
        @method('put')

           

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama"
                    placeholder="Nama" autocomplete="off" value="{{ $member->nama }}">
                @error('nama')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                    id="alamat" placeholder="Alamat" autocomplete="off" value="{{ $member->alamat }}">
                @error('alamat')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-select form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin"
                    placeholder="Jenis Kelamin" autocomplete="off" value="{{ old('jenis_kelamin') }}">

                    @if ($member->jenis_kelamin=='L')
                        <option name="jenis_kelamin">jenis kelamin</option>
                    <option selected value="L">Laki Laki</option>
                    <option value="P">Perempuan</option>

                    @elseif ($member->jenis_kelamin=='P')
                    <option name="jenis_kelamin">jenis kelamin</option>
                    <option value="L">Laki Laki</option>
                    <option selected value="P">Perempuan</option>
                    
                    @else()
                    <option selected name="jenis_kelamin">jenis kelamin</option>
                    <option value="L">Laki Laki</option>
                    <option value="P">Perempuan</option>
                    @endif
                    

                    <select>
                        @error('role')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
            </div>

            <div class="form-group">
                <label for="tlp">No Telp</label>
                <input type="text" class="form-control @error('tlp') is-invalid @enderror" name="tlp"
                    id="tlp" placeholder="No Telp" autocomplete="off" value="{{ $member->tlp }}">
                @error('tlp')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

           

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('member.index') }}" class="btn btn-default">Back to list</a>

        </form>
    </div>
</div>

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
