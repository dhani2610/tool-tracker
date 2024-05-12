<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['page_title'] = 'Alat';
        $data['breadcumb'] = 'Alat';
        $data['alat'] = Barang::where('approve_admin',1)->where('id_pemilik_barang',Auth::user()->id)->orderby('id', 'asc')->get();

        return view('alat.index', $data);
    }

    public function indexUmum()
    {
        $data['page_title'] = 'Alat';
        $data['breadcumb'] = 'Alat';
        $data['alat'] = Barang::where('approve_admin',1)->orderby('id', 'asc')->get();

        return view('alat.indexUmum', $data);
    }

    public function listApproveAlat()
    {
        $data['page_title'] = 'Approve Alat';
        $data['breadcumb'] = 'Approve Alat';
        $data['alat'] = Barang::where('approve_admin',0)->orderby('id', 'asc')->get();

        return view('alat.approve-admin', $data);
    }

    public function setSetuju(Request $request,$id){
        $data = Barang::find($id);
        $data->approve_admin = 1;
        $data->save();
        return redirect()->route('alat-list')->with(['success' => 'successfully!']);

    }
    public function setTidakSetuju(Request $request,$id){
        $data = Barang::find($id);
        $data->approve_admin = 2;
        $data->save();
        return redirect()->route('alat-list')->with(['success' => 'successfully!']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['page_title'] = 'Alat';
        $data['breadcumb'] = 'Alat';

        return view('alat.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = new Barang();
        $data->nama_alat = $request->nama_alat;
        $data->tipe = $request->tipe;
        $data->no_seri = $request->no_seri;
        $data->tahun_pembelian = $request->tahun_pembelian;
        $data->unit_pemilik = $request->unit_pemilik;
        $data->kelengkapan = $request->kelengkapan;

            // upload document 
            $dokumenval = $request->dokumen;

            $documentLaporanPath = public_path('documents/document-alat/');
            $documentNameLaporan = $dokumenval->getClientOriginalName();
            $i = 1;
            while (file_exists($documentLaporanPath . $documentNameLaporan)) {
                $documentNameLaporan = pathinfo($dokumenval->getClientOriginalName(), PATHINFO_FILENAME) . "($i)." . $dokumenval->getClientOriginalExtension();
                $i++;
            }
            $dokumenval->move($documentLaporanPath, $documentNameLaporan);
            $data->dokumen = $documentNameLaporan;
        // end upload dokumen 

        if ($request->hasFile('foto_alat')) {
            $foto_alat = $request->file('foto_alat');
            $namefoto_alat = time() . '.' . $foto_alat->getClientOriginalExtension();
            $destinationPath = public_path('img/foto_alat/');
            $foto_alat->move($destinationPath, $namefoto_alat);
            $data->foto_alat = $namefoto_alat;
        }

        if ($request->hasFile('foto_kelengkapan_alat')) {
            $foto_kelengkapan_alat = $request->file('foto_kelengkapan_alat');
            $namefoto_kelengkapan_alat = time() . '.' . $foto_kelengkapan_alat->getClientOriginalExtension();
            $destinationPath = public_path('img/foto_kelengkapan_alat/');
            $foto_kelengkapan_alat->move($destinationPath, $namefoto_kelengkapan_alat);
            $data->foto_kelengkapan_alat = $namefoto_kelengkapan_alat;
        }

        $data->kondisi_alat = $request->kondisi_alat;
        $data->tanggal_statement = $request->tanggal_statement;
        $data->approve_admin = 0;
        $data->status_peminjaman = 0;
        $data->id_pemilik_barang = Auth::user()->id;
        $data->save();

        return redirect()->route('alat-list')->with(['success' => 'successfully!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        //
    }
}
