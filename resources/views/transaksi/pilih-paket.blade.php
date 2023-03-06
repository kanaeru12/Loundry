@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Blank Page') }}</h1>

<!-- Main Content goes here -->
<div class="row">

    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">


                    <div class="col-12">
                        <div class="harga-paket mb-3" style="font-size: 28px;">Pilih Paket</div>
                    </div>
                    @foreach ($paket as $row)

                    <div class="col-md-4 col-12 mb-3">
                        <button class="btn btn-success w-100"
                            onclick="return pilihpaket({{$transaksi->id}},{{$row->id}})">
                            <h5>{{$row->nama_paket}}</h5>
                            <p>Rp.{{ number_format($row->harga,0,',','.') }}</p>
                        </button>
                    </div>
                    @endforeach

                    <form action="/dashboard/add-diskon/{{$transaksi->id}}" method="post">
                        @csrf

                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="batas_waktu">Batas Waktu</label>
                                    <input type="datetime-local" style=" border-bottom: 2px solid black;"
                                        class="form-control @error('batas_waktu') is-invalid @enderror"
                                        name="batas_waktu" id="batas_waktu" placeholder="nama paket" autocomplete="off"
                                        value="{{ old('batas_waktu') }}">
                                    @error('batas_waktu')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="biaya_tambahan">Biaya Tambahan</label>
                                    <input type="text" style=" border-bottom: 2px solid black;"
                                        class="form-control @error('biaya_tambahan') is-invalid @enderror"
                                        name="biaya_tambahan" id="biaya_tambahan" placeholder="nama paket"
                                        autocomplete="off" value="{{ old('biaya_tambahan') }}">
                                    @error('biaya_tambahan')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="pajak">Pajak</label>
                                    <input type="text" style=" border-bottom: 2px solid black;"
                                        class="form-control @error('pajak') is-invalid @enderror" name="pajak"
                                        id="pajak" placeholder="nama paket" autocomplete="off"
                                        value="{{ old('pajak') }}">
                                    @error('pajak')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="diskon">Diskon</label>
                                    <input type="text" style=" border-bottom: 2px solid black;"
                                        class="form-control @error('diskon') is-invalid @enderror" name="diskon"
                                        id="diskon" placeholder="nama paket" autocomplete="off"
                                        value="{{ old('diskon') }}">
                                    @error('diskon')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 float-right">
                            <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div class="col-md-6 col-12">
        <div class="card">
            <div class="card-body mb-3">
                <div class="row">
                    <div class="col-12">
                        <div class="" id="selected_paket"></div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <table id="datatrans" class="table table-bordered table-stripped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Paket</th>
                                            <th>Jumlah Barang</th>
                                            <th>Harga</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $dtl)
                                        <tr>
                                            <td scope="row">{{ $loop->iteration }}</td>
                                            <td>{{ $dtl->paket->nama_paket }}</td>
                                            <td>{{ $dtl->qty }}</td>
                                            <td> Rp.{{ number_format($dtl->paket->harga,0,',','.') }} </td>
                                            <td>
                                                <form action="{{ route('hapus-paket', $dtl->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        style="border-radius: 13px;"
                                                        onclick="return confirm('Are you sure to delete this?')"><i
                                                            class="fas fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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

@section('js')
<script>
    function addpaket(id_transaksi, $id_paket) {
        $.ajax({
            type: 'post',
            url: '/dashboard/add-paket/' + id_transaksi + '/' + $id_paket,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'qty': $('#qty').val(),
                'keterangan': $('#keterangan').val(),
            },
            success: function (res) {
                $('#datatrans').load(document.URL + ' #datatrans');

            }
        });
    }

    function pilihpaket(id_transaksi, id) {
        // preventDefault();
        $.ajax({
            type: 'get',
            url: '/dashboard/pilih-paket',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'id_transaksi': id_transaksi,
                'id': id,
            },
            success: function (data) {
                $('#selected_paket').html(data);
            }
        });
    }

</script>
@endsection
