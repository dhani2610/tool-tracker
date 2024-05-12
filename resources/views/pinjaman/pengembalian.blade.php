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
                <th>Status Peminjaman</th>
                <th>Status Pengembalian</th>
                <th>Action</th>
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
                      <img src="{{ asset('img/foto_alat/'.$item->foto_alat) }}" alt="" srcset="">
                  </td>
                <td>
                  <img src="{{ asset('img/foto_kelengkapan_alat/'.$item->foto_kelengkapan_alat) }}" alt="" srcset="">
              </td>
                  <td>{{ $item->kondisi_alat }}</td>
                  <td>{{ $item->tanggal_statement }}</td>
                  <td>
                    @if ($item->status_peminjaman == 0)
                        Pending
                    @elseif ($item->status_peminjaman == 1)
                        Setuju
                    @elseif ($item->status_peminjaman == 2)
                        Tidak Setuju
                    @endif
                  </td>
                  <td>
                    @if ($item->status_pengembalian == 0)
                        Pending
                    @elseif ($item->status_pengembalian == 1)
                        Setuju
                        <a href="{{ route('ba-pengembalian',$item->id_pinjaman) }}" target="_blank" class="btn btn-danger">BA PDF Pengembalian</a>
                    @elseif ($item->status_pengembalian == 2)
                        Tidak Setuju
                    @endif
                  </td>
                  
                  <td>
                    <div class="btn-group">
                        <a href="#" class="btn btn-primary text-white" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengembalian{{ $item->id_pinjaman }}">
                            Edit
                         </a>
                         <div class="modal fade" id="pengembalian{{ $item->id_pinjaman }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                             <div class="modal-content">
                                 <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Pengembalian Peminjaman Alat {{ $item->nama_alat }} </h5>
                                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     <form action="{{ route('edit-pengembalian-alat',$item->id_pinjaman) }}" method="post">
                                         @csrf
                                         <div class="form-group mb-3">
                                            <label for="name">Kondisi Alat</label>
                                            <select name="kondisi_pengembalian" id="" class="form-control @error('kondisi_pengembalian') is-invalid @enderror" >
                                                <option value="Normal Lengkap" {{ $item->kondisi_pengembalian == 'Normal Lengkap' ? 'selected' : '' }}>Normal Lengkap</option>
                                                <option value="Normal Tidak Lengkap" {{ $item->kondisi_pengembalian == 'Normal Tidak Lengkap' ? 'selected' : '' }}>Normal Tidak Lengkap</option>
                                                <option value="Rusak Bisa Digunakan" {{ $item->kondisi_pengembalian == 'Rusak Bisa Digunakan' ? 'selected' : '' }}>Rusak Bisa Digunakan</option>
                                                <option value="Rusak Tidak Bisa Digunakan" {{ $item->kondisi_pengembalian == 'Rusak Tidak Bisa Digunakan' ? 'selected' : '' }}>Rusak Tidak Bisa Digunakan</option>
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
                    </div>
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