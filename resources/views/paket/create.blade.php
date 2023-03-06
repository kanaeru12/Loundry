@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

<!-- Main Content goes here -->

<div class="card">
    <div class="card-body">
        <form action="{{ route('paket.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="nama_paket">Nama Paket</label>
                <input type="text" class="form-control @error('nama_paket') is-invalid @enderror"
                    name="nama_paket" id="nama_paket" placeholder="nama paket" autocomplete="off"
                    value="{{ old('nama_paket') }}">
                @error('nama_paket')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="outlet">Outlet</label>
                <select class="form-select form-control @error('id_outlet') is-invalid @enderror" name="id_outlet"
                    id="id_outlet" placeholder="Outlet" autocomplete="off" value="{{ old('id_outlet') }}">
                    <option selected name="id_outlet">Outlet</option>
                    @foreach ($outlet as $otl)
                    <option value="{{ $otl->id }}">{{ $otl->nama }}</option>
                    @endforeach
                    <select>
                        @error('outlet')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
            </div>

            <div class="form-group">
                <label for="jenis">Jenis</label>
                <select class="form-select form-control @error('jenis') is-invalid @enderror" name="jenis" id="jenis"
                    placeholder="Jenis " autocomplete="off" value="{{ old('jenis') }}">
                    <option selected name="jenis">jenis</option>
                    <option value="kiloan">Kiloan</option>
                    <option value="selimut">Selimut</option>
                    <option value="bed cover">Bed Cover</option>
                    <option value="kaos">Kaos</option>
                    <option value="lain">Lain</option>

                    <select>
                        @error('jenis')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
            </div>

            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="harga" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga"
                    placeholder="harga" autocomplete="off" value="{{ old('harga') }}">
                @error('harga')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('basic.index') }}" class="btn btn-default">Back to list</a>

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
