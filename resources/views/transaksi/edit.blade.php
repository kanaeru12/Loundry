@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

<!-- Main Content goes here -->
<div class="row justify-content-center">
    <div class="col-md-8 col-12">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('transaksi.update', $transaksi->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('transaksi.index') }}" class="btn btn-default mb-2"><i
                                    class="fas fa-fw fa-arrow-left"></i></a>
                        </div>
                        <div class="col-md-9 col-6">
                            <div class="form-group">
                                <label for="nama_paket" style="font-size: 16px; font-weight: bold;">Nama Member</label>
                                <br>
                                <div class="nama" style="font-size: 15px; font-weight: 500;">
                                    {{ $transaksi->member->nama }}</div>
                                @error('nama_paket')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="form-group">
                                <label for="nama_paket" style="font-size: 16px; font-weight: bold;">Total Harga</label>
                                <br>
                                <div class="nama" style="font-size: 15px; font-weight: 500;">Rp.
                                    {{ number_format($transaksi->total_harga,0,',','.') }}</div>
                                @error('nama_paket')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="bayar text-center"
                                style="font-size: 25px; font-weight: bold; margin-bottom: 30px; margin-top: 15px">
                                Pembayaran</div>
                        </div>
                        <div class="col-md-4 col-12">
                            @if ($transaksi->dibayar=='belum dibayar')
                            <div class="form-group">
                                <label for="dibayar" style="font-size: 16px; font-weight: bold;">Status
                                    Pembayaran</label>
                                <select class="form-select form-control @error('dibayar') is-invalid @enderror"
                                    name="dibayar" id="dibayar" placeholder="Status " autocomplete="off"
                                    value="{{ old('dibayar') }}" style=" border-bottom: 2px solid black;">
                                    @if ($transaksi->dibayar=='belum dibayar')
                                    <option name="dibayar" style="font-weight: bold">Status Pembayaran</option>
                                    <option selected value="belum dibayar">belum dibayar</option>
                                    <option value="dibayar">dibayar</option>
                                    @elseif($transaksi->dibayar=='dibayar')
                                    <option name="dibayar">Status Pembayaran</option>
                                    <option selected value="dibayar">dibayar</option>
                                    <option value="belum dibayar">belum dibayar</option>
                                    @else ()
                                    <option selected name="dibayar">Status Pembayaran</option>
                                    <option value="dibayar">dibayar</option>
                                    <option value="belum dibayar">belum dibayar</option>
                                    @endif


                                    <select>
                                        @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                            </div>
                            @else()
                            <div class="form-group">
                                <label for="dibayar" style="font-size: 16px; font-weight: bold;">Status
                                    Pembayaran</label>
                                <div class="dibayar py-2 px-3 text-center"
                                    style="background-color: #18be26; border-radius: 5px; color: #fff; font-size: 15px;">
                                    {{ $transaksi->dibayar }}</div>
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @endif

                        </div>
                        <div class="col-md-4 col-12">
                            @if ($transaksi->dibayar=='belum dibayar')
                            <div class="form-group">
                                <label for="status" style="font-size: 16px; font-weight: bold;">Status</label>
                                <select class="form-select form-control @error('status') is-invalid @enderror"
                                    name="status" id="status" placeholder="Status " autocomplete="off"
                                    value="{{ old('status') }}" style=" border-bottom: 2px solid black;">
                                    @if ($transaksi->status=='baru')
                                    <option name="status" style="font-weight: bold">Status</option>
                                    <option selected value="baru">Baru</option>
                                    <option value="proses">Proses</option>
                                    <option value="diambil">Diambil</option>
                                    <option value="selesai">Selesai</option>
                                    @elseif($transaksi->status=='proses')
                                    <option name="status" style="font-weight: bold">Status</option>
                                    <option value="baru">Baru</option>
                                    <option selected value="proses">Proses</option>
                                    <option value="diambil">Di Ambil</option>
                                    <option value="selesai">Selesai</option>
                                    @elseif ($transaksi->status=='diambil')
                                    <option name="status" style="font-weight: bold">status</option>
                                    <option value="baru">Baru</option>
                                    <option value="proses">Proses</option>
                                    <option selected value="diambil">Diambil</option>
                                    <option value="selesai">Selesai</option>
                                    @elseif ($transaksi->status=='selesai')
                                    <option name="status" style="font-weight: bold">status</option>
                                    <option value="baru">Baru</option>
                                    <option value="proses">Proses</option>
                                    <option value="diambil">Diambil</option>
                                    <option selected value="selesai">Selesai</option>
                                    @else ()
                                    <option selected name="status" style="font-weight: bold">status</option>
                                    <option value="baru">Baru</option>
                                    <option value="proses">Proses</option>
                                    <option value="diambil">Diambil</option>
                                    <option value="selesai">Selesai</option>
                                    @endif


                                    <select>
                                        @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                            </div>
                            @else()
                            <label for="status" style="font-size: 16px; font-weight: bold;">Status</label>
                            <div class="status py-2 px-3 text-center"
                                style="background-color: #18be26; border-radius: 5px; color: #fff; font-size: 15px;">
                                {{ $transaksi->status }}</div>
                            @endif

                        </div>
                        <div class="col-md-4 col-12">
                            @if ($transaksi->dibayar=='belum dibayar')
                               <div class="form-group">
                                <label for="tgl_bayar" style="font-size: 16px; font-weight: bold;">Tanggal Bayar</label>
                                <input type="datetime-local" style=" border-bottom: 2px solid black;"
                                    class="form-control @error('tgl_bayar') is-invalid @enderror" name="tgl_bayar"
                                    id="tgl_bayar" placeholder="Tanggal Bayar" autocomplete="off"
                                    value="{{ old('tgl_bayar') }}">
                                @error('tgl_bayar')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> 
                            @else ()
                            <label for="tgl_bayar" style="font-size: 16px; font-weight: bold;">Tanggal Bayar</label>
                            <div class="tgl_bayar py-2 px-3 text-center"
                                style=" border-radius: 5px; color: black; font-size: 15px;">
                                {{ $transaksi->tgl_bayar }}</div>
                            @endif
                            
                        </div>
                    </div>
                    @if ($transaksi->dibayar=='belum dibayar')
                    <button type="submit" class="btn btn-primary float-right w-25">Save</button>
                    @endif


                </form>
            </div>
        </div>
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
