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
                    <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ ($breadcumb ?? '') }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header text-center bg-gray1" style="border-radius:10px 10px 0px 0px;">
                <h3 class="card-title text-white">Add {{ ($breadcumb ?? '') }}</h3>
            </div>

            <form action="{{ route('alat-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('components.form-message')


                <div class="card-body">

                    <div class="form-group mb-3">
                        <label for="name">Nama Alat</label>
                        <input type="text" class="form-control @error('nama_alat') is-invalid @enderror" id="nama_alat" name="nama_alat" value="{{ old('nama_alat') }}"  placeholder="Enter ">

                        @error('nama_alat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Tipe</label>
                        <input type="text" class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe" value="{{ old('tipe') }}"  placeholder="Enter ">

                        @error('tipe')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">No Seri</label>
                        <input type="text" class="form-control @error('no_seri') is-invalid @enderror" id="no_seri" name="no_seri" value="{{ old('no_seri') }}"  placeholder="Enter ">

                        @error('no_seri')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               
                    <div class="form-group mb-3">
                        <label for="name">Tahun Pembelian</label>
                        <input type="number" class="form-control @error('tahun_pembelian') is-invalid @enderror" id="tahun_pembelian" name="tahun_pembelian" value="{{ old('tahun_pembelian') }}"  placeholder="Enter ">

                        @error('tahun_pembelian')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               
                    <div class="form-group mb-3">
                        <label for="name">Unit Pemilik</label>
                        <input type="text" class="form-control @error('unit_pemilik') is-invalid @enderror" id="unit_pemilik" name="unit_pemilik" value="{{ old('unit_pemilik') }}"  placeholder="Enter ">

                        @error('unit_pemilik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               
                    <div class="form-group mb-3">
                        <label for="name">Kelengkapan</label>
                        <input type="text" class="form-control @error('kelengkapan') is-invalid @enderror" id="kelengkapan" name="kelengkapan" value="{{ old('kelengkapan') }}"  placeholder="Enter ">

                        @error('kelengkapan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               
                    <div class="form-group mb-3">
                        <label for="name">Dokumen</label>
                        <input type="file" class="form-control @error('dokumen') is-invalid @enderror" id="dokumen" name="dokumen" value="{{ old('dokumen') }}"  placeholder="Enter ">

                        @error('dokumen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Foto Alat Utama</label>
                        <input type="file" class="form-control @error('foto_alat') is-invalid @enderror" id="foto_alat" name="foto_alat" value="{{ old('foto_alat') }}"  placeholder="Enter ">

                        @error('foto_alat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               
                    <div class="form-group mb-3">
                        <label for="name">Foto Kelengkapan Alat</label>
                        <input type="file" class="form-control @error('foto_kelengkapan_alat') is-invalid @enderror" id="foto_kelengkapan_alat" name="foto_kelengkapan_alat" value="{{ old('foto_kelengkapan_alat') }}"  placeholder="Enter ">

                        @error('foto_kelengkapan_alat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               
                    <div class="form-group mb-3">
                        <label for="name">Kondisi Alat</label>
                        <select name="kondisi_alat" id="" class="form-control @error('kondisi_alat') is-invalid @enderror" >
                            <option value="Normal Lengkap">Normal Lengkap</option>
                            <option value="Normal Tidak Lengkap">Normal Tidak Lengkap</option>
                            <option value="Rusak Bisa Digunakan">Rusak Bisa Digunakan</option>
                            <option value="Rusak Tidak Bisa Digunakan">Rusak Tidak Bisa Digunakan</option>
                        </select>

                        @error('kondisi_alat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               
                    <div class="form-group mb-3">
                        <label for="name">Tanggal Statement</label>
                        <input type="date" class="form-control @error('tanggal_statement') is-invalid @enderror" id="tanggal_statement" name="tanggal_statement" value="{{ old('tanggal_statement') }}"  placeholder="Enter ">

                        @error('tanggal_statement')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
               
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-gray1" style="border-radius:0px 0px 10px 10px;">
                    <button type="submit" class="btn btn-success btn-footer">Add</button>
                    <a href="{{ route('alat-list') }}" class="btn btn-secondary btn-footer">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection