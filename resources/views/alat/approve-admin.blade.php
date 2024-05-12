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
                <th>Pemilik Alat</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($alat as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
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
                  <td>{{ $item->id_pemilik_barang }}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('set-status-setuju-alat', $item->id) }}" class="btn btn-warning text-white">
                        Setujui
                      </a>
                      <a href="{{ route('set-status-tidak-setuju-alat', $item->id) }}" class="btn btn-danger f-12">
                        Tidak Setujui
                      </a>
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