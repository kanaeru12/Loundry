@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
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

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pelanggan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['member'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Transaksi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['trx'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Paket</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $widget['paket'] }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('Users') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['users'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-12">
            <a href="{{ url('/home/generate-data') }}" class="btn btn-primary mb-2" style="background-color: #666262; color: white;">Cetak Data</a>
        </div>
        <div class="col-12">
            <table class="table table-bordered table-stripped">
                <thead>
                    <tr style="background-color: #24256d; color: white;">
                        <th>No</th>
                        <th>Kode Invoice</th>
                        <th>Pelanggan</th>
                        <th>Outlet</th>
                        <th>No Telp</th>
                        <th>Tanggal Bayar</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Dibayar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksiPaid as $trx)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $trx->kode_invoice }}</td>
                        <td>{{ $trx->member->nama }}</td>
                        <td>{{ $trx->outlet->nama }}</td>
                        <td>{{ $trx->member->tlp }}</td>
                        <td>{{ $trx->tgl_bayar }}</td>
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
