@extends('layouts.app')

@section('style')

@endsection

@section('breadcumb')
  <div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ ($breadcumb ?? '') }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">/</li>
                    <li class="breadcrumb-item active"><a href="{{ route('alat-list') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
  </div>
@endsection

@section('content')
<div class="row mt-4">
  <div class="col-12">
    <div class="card">
      <div class="card-header bg-gray1" style="border-radius:10px 10px 0px 0px;">
        <div class="row">
          <div class="col-6 mt-1">
            <span class="tx-bold text-lg text-white" style="font-size:1.2rem;">
              <i class="far fa-user text-lg"></i> 
              {{ ($breadcumb ?? '') }}
            </span>
          </div>

          <div class="col-6 d-flex justify-content-end">
            <a href="{{ route('alat-create') }}" class="btn btn-md btn-info">
              <i class="fa fa-plus"></i> 
              Add New
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            @include('sweetalert::alert')
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="table-responsive">
          <table id="example" class="table table-hover table-bordered dt-responsive" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                {{-- <th>Nama Peminjam</th> --}}
                <th>Nama Alat</th>
                <th>Tipe</th>
                <th>No Seri</th>
                <th>Tahun Pembelian</th>
                <th>Unit Pemilik</th>
                <th>Kelengkapan</th>
                <th>Dokumen</th>
                <th>Foto Alat</th>
                <th>Foto Kelengkapan</th>
                <th>Foto Kondisi Alat</th>
                <th>Tanggal Statement</th>
                {{-- <th>Pemilik Alat</th> --}}
                <th>Status</th>
                <th>Action</th>
                <th>BA Pengembalian</th>
                <th>Action Pengembalian</th>
              </tr>
            </thead>
            <tbody>
  
              @foreach ($peminjaman as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                {{-- <td>
                    {{ $item->nama_peminjam }}
                </td> --}}
                  <td>{{ $item->nama_alat }}</td>
                  <td>{{ $item->tipe }}</td>
                  <td>{{ $item->no_seri }}</td>
                  <td>{{ $item->tahun_pembelian }}</td>
                  <td>{{ $item->unit_pemilik }}</td>
                  <td>{{ $item->kelengkapan }}</td>
                  <td>
                    <a href="{{ asset('documents/document-alat/'.$item->dokumen) }}">{{ $item->dokumen }}</a>
                </td>
                <td>
                      <img style="width: 150px;" src="{{ asset('img/foto_alat/'.$item->foto_alat) }}" alt="" srcset="">
                  </td>
                <td>
                  <img style="width: 150px;" src="{{ asset('img/foto_kelengkapan_alat/'.$item->foto_kelengkapan_alat) }}" alt="" srcset="">
              </td>
                  <td>{{ $item->kondisi_alat }}</td>
                  <td>{{ $item->tanggal_statement }}</td>
                  <td>
                    @if ($item->status_peminjaman == 0)
                        Pending
                    @elseif ($item->status_peminjaman == 1)
                        Setuju
                        <a href="{{ route('ba-peminjaman',$item->id_pinjaman) }}" target="_blank" class="btn btn-danger">BA PDF Peminjaman</a><
                    @elseif ($item->status_peminjaman == 2)
                        Tidak Setuju
                    @endif
                  </td>
                  <td>
                    <div class="btn-group">
                      
                        @if ($item->status_peminjaman == 0 )
                            <a href="{{ route('hapus-peminjaman-alat', $item->id_pinjaman) }}" class="btn btn-danger f-12">
                                Hapus
                            </a>
                        @endif
                        <a href="#" class="btn btn-primary text-white" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id_pinjaman }}">
                           Edit
                        </a>
                        <div class="modal fade" id="exampleModal{{ $item->id_pinjaman }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Peminjaman Alat {{ $item->nama_alat }} </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('edit-peminjaman-alat',$item->id_pinjaman) }}" method="post">
                                        @csrf
                                    <div class="form-group mb-3">
                                        <label for="name">Lokasi Penggunaan</label>
                                        <input type="text" class="form-control @error('lokasi_penggunaan') is-invalid @enderror" id="lokasi_penggunaan" name="lokasi_penggunaan" value="{{ $item->lokasi_penggunaan }}"  placeholder="Enter " >
                
                                        @error('lokasi_penggunaan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Latitude</label>
                                        <input type="text" class="form-control @error('lat') is-invalid @enderror lat" id="lat" name="lat" value="{{ $item->lat }}"  placeholder="Enter " readonly>
                
                                        @error('lat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Longitude</label>
                                        <input type="text" class="form-control @error('long') is-invalid @enderror long" id="long" name="long" value="{{ $item->long }}"  placeholder="Enter " readonly>
                
                                        @error('long')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Jam Diterima</label>
                                        <input type="time" class="form-control @error('jam_diterima') is-invalid @enderror jam_diterima" id="jam_diterima" name="jam_diterima" value="{{ $item->jam_diterima }}"  placeholder="Enter " >
                
                                        @error('jam_diterima')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Tanggal Mulai</label>
                                        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror tanggal_mulai" id="tanggal_mulai" name="tanggal_mulai" value="{{ $item->tanggal_mulai }}"  placeholder="Enter " >
                
                                        @error('tanggal_mulai')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="name">Tanggal Selesai</label>
                                        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror tanggal_selesai" id="tanggal_selesai" name="tanggal_selesai" value="{{ $item->tanggal_selesai }}"  placeholder="Enter " >
                
                                        @error('tanggal_selesai')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                        
                                    <div class="form-group mb-3">
                                        <label for="name">Keterangan</label>
                                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror keterangan" id="keterangan" name="keterangan" value="{{ $item->keterangan }}"  placeholder="Lengkap / Tidak " >
                
                                        @error('keterangan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <input type="hidden" name="id_pemilik_barang" value="{{ $item->id_pemilik_barang }}">
                                    <input type="hidden" name="id_barang" value="{{ $item->id_barang }}">
                                    <input type="hidden" name="id_peminjam" value="{{ $item->id_peminjam }}">
                          
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" >Save</button>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
                    </div>
                  </td>
                  {{-- <td><a href="{{ route('ba-peminjaman',$item->id_pinjaman) }}" target="_blank" class="btn btn-danger">BA PDF Peminjaman</a></td> --}}
                  
                  <td>
                    @if ($item->status_pengembalian == '')
                    <a href="#" class="btn btn-primary text-white" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengembalian{{ $item->id_pinjaman }}">
                        Pengembalian
                     </a>
                     <div class="modal fade" id="pengembalian{{ $item->id_pinjaman }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                         <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Pengembalian Peminjaman Alat {{ $item->nama_alat }} </h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                             </div>
                             <div class="modal-body">
                                 <form action="{{ route('store-pengembalian-alat',$item->id_pinjaman) }}" method="post">
                                     @csrf
                                     <div class="form-group mb-3">
                                        <label for="name">Kondisi Alat</label>
                                        <select name="kondisi_pengembalian" id="" class="form-control @error('kondisi_pengembalian') is-invalid @enderror" >
                                            <option value="Normal Lengkap">Normal Lengkap</option>
                                            <option value="Normal Tidak Lengkap">Normal Tidak Lengkap</option>
                                            <option value="Rusak Bisa Digunakan">Rusak Bisa Digunakan</option>
                                            <option value="Rusak Tidak Bisa Digunakan">Rusak Tidak Bisa Digunakan</option>
                                        </select>
                
                                        @error('kondisi_pengembalian')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                               
                             </div>
                             <div class="modal-footer">
                                 <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-primary" >Kirim</button>
                             </div>
                         </form>
                         </div>
                         </div>
                     </div>
                     @else
                     Menunggu Persetujuan Pengembalian
                    @endif
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
@endsection

@section('script')
<script>
$('#example').dataTable();
</script>
@endsection