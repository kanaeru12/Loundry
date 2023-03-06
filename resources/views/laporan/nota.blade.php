<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Laporan</title>
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
  
</head>
<body>
        <div class="section-body">
          <div class="row justify-content-center">
              <div class="col-7">
                <div class="card">
                    <div class="card-body">
                                            <!-- card-header -->
                      <div class="card-header px-0">
                          <div class="row">
                            <div class="col-12 mb-3">
                                <a href="{{ route('transaksi.index') }}" class="no-print"><i class="fas fa-fw fa-arrow-left text-dark"></i></a>
                            </div>
                              <div class="col-md-12 col-lg-7 col-xl-4 mb-50">
                                  <span class="invoice-id font-weight-bold">Invoice# </span>
                                  <span>{{ $transaksi->kode_invoice }}</span>
                              </div>
                              <div class="col-md-12 col-lg-5 col-xl-8">
                                  <div class="d-flex align-items-center justify-content-end justify-content-xs-start">
                                      <div class="issue-date pr-2">
                                          <span class="font-weight-bold no-wrap">Tanggal Masuk: </span>
                                          <span>{{ $transaksi->created_at }}</span>
                                      </div>
                                      <div class="due-date">
                                          <span class="font-weight-bold no-wrap">Batas Waktu Pengambilan: </span>
                                          <span>{{ $transaksi->batas_waktu }}</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <hr>
  
                      <!-- invoice address and contacts -->
                      <div class="row invoice-adress-info py-2">
                          <div class="col-6 mt-1 from-info">
                              <div class="info-title mb-1">
                                  <span>Outlet</span>
                              </div>
                              <div class="company-name mb-1">
                                  <span class="text-muted">
                                    {{ $transaksi->outlet->nama }}
                                </span>
                              </div>
                              <div class="company-address mb-1">
                                  <span class="text-muted">
                                    {{ $transaksi->outlet->alamat }}
                                </span>
                              </div>
                              <div class="company-phone  mb-1">
                                  <span class="text-muted">
                                    {{ $transaksi->outlet->tlp }}
                                </span>
                              </div>
                              <div class="company-kasir  mb-1 mb-1">
                                  <span class="text-muted">Kasir - 
                                    {{ $transaksi->user->name }} / {{ Auth::user()->role }}
                                </span>
                              </div>
                              <div class="company-status  mb-1 mb-1">
                                  <span class="text-muted">Status Pesanan -
                                    @if ($transaksi->status == 'baru')
                                    <span class="text-black py-1 px-2">{{$transaksi->status}}</span>
                                @endif
                                @if ($transaksi->status == 'proses')
                                    <span class="text-black py-1 px-2">{{$transaksi->status}}</span>
                                @endif
                                @if ($transaksi->status == 'selesai')
                                    <span class="text-black py-1 px-2">{{$transaksi->status}}</span>
                                @endif
                                    </span>
                              </div>
                              <div class="company-dibayar  mb-1 mb-1">
                                  <span class="text-muted">Status Pembayaran -
                                    @if ($transaksi->dibayar=='dibayar')
                                    <span class="text-black py-1 px-2">{{$transaksi->dibayar}}</span>
                                    @else()
                                    <span class="text-black py-1 px-2">{{$transaksi->dibayar}}</span>
                                    @endif
                                  </span>
                              </div>
                          </div>
                          <div class="col-6 mt-1 to-info">
                              <div class="info-title mb-1">
                                  <span>Pelanggan</span>
                              </div>
                              <div class="company-name mb-1">
                                  <span class="text-muted">
                                    {{ $transaksi->member->nama }}
                                </span>
                              </div>
                              <div class="company-address mb-1">
                                  <span class="text-muted">
                                    {{ $transaksi->member->alamat }}
                                </span>
                              </div>
                              <div class="company-phone  mb-1">
                                  <span class="text-muted">
                                    {{ $transaksi->member->tlp }}
                                </span>
                              </div>
                          </div>
                      </div>
  
                      <!--product details table -->
                      <div class="product-details-table py-2 table-responsive">
                          <table class="table table-hover">
                              <thead>
                                  <tr>
                                      <th scope="col">Jenis Cucian</th>
                                      <th scope="col">Paket</th>
                                      <th scope="col">Jumlah Cucian</th>
                                      <th scope="col">Harga</th>
                                      <th scope="col">Keterangan</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse($detail as $dtl)
                                  <tr>
                                      <td>{{ $dtl->paket->jenis }}</td>
                                      <td>{{ $dtl->paket->nama_paket }}</td>
                                      <td>{{ $dtl->qty }}</td>
                                      <td>{{ number_format($dtl->paket->harga, 2) }}/Cucian</td>
                                      <td>{{ $dtl->keterangan }}</td>
                                  </tr>
                                  @empty
                                  <tr>
                                      <td colspan="5"><b><i>Tidak Ada Data</i></b></td>
                                  </tr>
                                  @endforelse
                              </tbody>
                          </table>
                      </div>
                      <hr>
  
                      <!-- invoice total -->
                      <div class="invoice-total py-2">
                          <div class="row">
                              <div class="col-4 col-sm-6 mt-75">
                              </div>
                              <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                                  <ul class="list-group cost-list">
                                     <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                          <span class="cost-title mr-2">Subtotal </span>
                                          <span class="cost-value">Rp.
                                             {{ number_format($subtotal,0,',','.') }}
                                          </span>
                                      </li>
                                      <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                          <span class="cost-title mr-2">Biaya Tambahan </span>
                                          <span class="cost-value">Rp. {{ number_format($transaksi->biaya_tambahan,0,',','.') }}</span>
                                      </li>
                                      <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                          <span class="cost-title mr-2">Pajak </span>
                                          <span class="cost-value">Rp. {{ number_format($transaksi->pajak,0,',','.') }}</span>
                                      </li>
                                      <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                          <span class="cost-title mr-2">Diskon </span>
                                          @if($transaksi->diskon=='')
                                          <span class="cost-value">0%</span>
                                          @else
                                          <span class="cost-value">{{ $transaksi->diskon }}%</span>
                                          @endif
                                      </li>
                                      
                                      <li class="dropdown-divider"></li>
                                      <li class="list-group-item each-cost border-0 p-50 d-flex justify-content-between">
                                          <span class="cost-title mr-2">Total</span>
                                          <span class="cost-value">Rp. {{ number_format($transaksi->total_harga,0,',','.') }}</span>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
      </section>
      <script>
        window.print();
      </script>
      <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
