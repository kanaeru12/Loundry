@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

<!-- Main Content goes here -->

<a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3" style="background-color: #666262; color: rgb(0, 0, 0)">Tambah Transaksi</a>

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif

<table class="table table-bordered table-stripped">
    <thead>
        <tr style="background-color: #666262; color: rgb(255, 255, 255);">
            <th>No</th>
            <th>Kode Invoice</th>
            <th>Pelanggan</th>
            <th>Outlet</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Dibayar</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $trx)
        <tr>
            <td scope="row">{{ $loop->iteration }}</td>
            <td>{{ $trx->kode_invoice }}</td>
            <td>{{ $trx->member->nama }}</td>
            <td>{{ $trx->outlet->nama }}</td>
            <td>Rp. {{ number_format($trx->total_harga,0,',','.') }}</td>

            <td>
                @if ($trx->status == 'baru')
                <span class="badge text-primary py-1 px-2"
                    style="font-size: 13px; border-radius: 20px; background-color: #c8c1ff">{{$trx->status}}</span>
                @endif
                @if ($trx->status == 'proses')
                <span class="badge text-warning py-1 px-2"
                    style="font-size: 13px; border-radius: 20px; background-color: #fdff9b">{{$trx->status}}</span>
                @endif
                @if ($trx->status == 'diambil')
                <span class="badge py-1 px-2"
                    style="font-size: 13px; border-radius: 20px; background-color: #ffdfc2; color: #ff9100">{{$trx->status}}</span>
                @endif
                @if ($trx->status == 'selesai')
                <span class="badge text-success py-1 px-2"
                    style="font-size: 13px; border-radius: 20px; background-color: #b4ffa4">{{$trx->status}}</span>
                @endif
            </td>
            <td>
                @if ($trx->dibayar=='dibayar')
                <span class="badge text-success py-1 px-2"
                    style="font-size: 13px; border-radius: 20px; background-color: #b4ffa4">{{$trx->dibayar}}</span>
                @else()
                <span class="badge text-danger py-1 px-2"
                    style="font-size: 13px; border-radius: 20px; background-color: #ffd9d9">{{$trx->dibayar}}</span>
                @endif
            </td>
            <td>
                <div class="d-flex">
                    <a href="{{ route('transaksi.edit', $trx->id) }}" class="btn mr-2 rounded-circle py-2"
                        style="background-color: rgb(238, 204, 9);"><i class="fas fa-fw fa-pen text-white"></i></a>
                    <form action="{{ route('transaksi.destroy', $trx->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn rounded-circle py-2"
                            style="background-color: rgb(214, 9, 9);"
                            onclick="return confirm('Are you sure to delete this?')"><i
                                class="fas fa-fw fa-trash text-white"></i></button>
                    </form>
                    <a href="{{ url('/dashboard/laporan-transaksi/'. $trx->kode_invoice) }}" class="btn ml-2 rounded-circle py-2"
                        style="background-color: rgb(6, 22, 173);"><i class="fas fa-fw fa-print text-white"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- {{ $users->links() }} --}}

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
