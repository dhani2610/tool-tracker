<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PinjamanBarang;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use PDF;

class PinjamanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pinjam(Request $request){

        $data = new PinjamanBarang();
        $data->id_pemilik_barang = $request->id_pemilik_barang;
        $data->id_barang = $request->id_barang;
        $data->id_peminjam = $request->id_peminjam;
        $data->jam_diterima = $request->jam_diterima;
        $data->tanggal_mulai = $request->tanggal_mulai;
        $data->tanggal_selesai = $request->tanggal_selesai;
        $data->lokasi_penggunaan = $request->lokasi_penggunaan;
        $data->lat = $request->lat;
        $data->long = $request->long;
        $data->keterangan = $request->keterangan;
        $data->status = 0;
        $data->save();

        return redirect()->route('alat-list-umum')->with(['success' => 'Berhasil Pinjam! Silahkan cek menu peminjaman untuk mengetahui apakah sudah di approve dengan pemilik']);

    }

    public function listReqPinjamMyAlat(){
        $data['page_title'] = 'Request Pinjam Alat';
        $data['breadcumb'] = 'Request Pinjam Alat';
        $data['peminjaman'] = DB::table('pinjaman_barangs')
        ->join('barangs', 'barangs.id', '=', 'pinjaman_barangs.id_barang')
        ->join('users', 'users.id', '=', 'pinjaman_barangs.id_peminjam')
        ->select('pinjaman_barangs.*','barangs.*','users.name as nama_peminjam','pinjaman_barangs.status as status_peminjaman','pinjaman_barangs.id as id_pinjaman')
        ->where('pinjaman_barangs.status',0)
        ->where('pinjaman_barangs.id_pemilik_barang',Auth::user()->id)
        ->get();

        return view('pinjaman.myindex', $data);

    }

    public function setSetuju(Request $request,$id){
        $data = PinjamanBarang::find($id);
        $barang = Barang::find($data->id_barang);
        if ($barang->status_peminjaman == 1) {
            return redirect()->back()->with(['success' => 'Barang Sudah pinjam! anda hanya bisa melakukan penolakan atau menunggu barang dikembalikan']);
        }else {
            $data->status = 1;
            if ($data->save()) {
                $barang->status_peminjaman = 1;
                $barang->save();
            }

            return redirect()->back()->with(['success' => 'Berhasil setujui Request']);
        }

    }
    public function setTidakSetuju(Request $request,$id){
        $data = PinjamanBarang::find($id);
        $data->status = 2;
        $data->save();
        return redirect()->back()->with(['success' => 'successfully!']);

    }

    public function pinjamAlat(){
        $data['page_title'] = 'Pinjam Alat';
        $data['breadcumb'] = 'Pinjam Alat';

        $data['peminjaman'] = DB::table('pinjaman_barangs')
        ->join('barangs', 'barangs.id', '=', 'pinjaman_barangs.id_barang')
        ->join('users', 'users.id', '=', 'pinjaman_barangs.id_peminjam')
        ->select('pinjaman_barangs.*','barangs.*','users.name as nama_peminjam','pinjaman_barangs.status as status_peminjaman','pinjaman_barangs.id as id_pinjaman')
        ->where('pinjaman_barangs.id_peminjam',Auth::user()->id)
        ->get();

        // dd($data['peminjaman']);
      
        return view('pinjaman.pinjamindex', $data);

    }

    public function BApeminjaman($id){
        $data['peminjaman'] = DB::table('pinjaman_barangs')
        ->join('barangs', 'barangs.id', '=', 'pinjaman_barangs.id_barang')
        ->join('users', 'users.id', '=', 'pinjaman_barangs.id_peminjam')
        ->select('pinjaman_barangs.*','barangs.*','users.name as nama_peminjam','pinjaman_barangs.status as status_peminjaman','pinjaman_barangs.id as id_pinjaman')
        ->where('pinjaman_barangs.id_peminjam',Auth::user()->id)
        ->where('pinjaman_barangs.id',$id)
        ->first();

        // dd($data['peminjaman']);

        $pdf = PDF::loadView('ba.peminjaman', $data);
        $pdf->setPaper([0, 0, 480, 700], 'landscape');
        return $pdf->stream('Berita Acara Peminjaman.pdf');
    }

    public function BApengembalian($id){
        $data['pengembalian'] = DB::table('pinjaman_barangs')
        ->join('barangs', 'barangs.id', '=', 'pinjaman_barangs.id_barang')
        ->join('users', 'users.id', '=', 'pinjaman_barangs.id_peminjam')
        ->select('pinjaman_barangs.*','barangs.*','users.name as nama_peminjam','pinjaman_barangs.status as status_peminjaman','pinjaman_barangs.id as id_pinjaman')
        ->where('pinjaman_barangs.id_peminjam',Auth::user()->id)
        ->where('pinjaman_barangs.id',$id)
        ->where('pinjaman_barangs.status_pengembalian',1)
        ->first();

        // dd($data['peminjaman']);

        $pdf = PDF::loadView('ba.pengembalian', $data);
        $pdf->setPaper([0, 0, 480, 700], 'landscape');
        return $pdf->stream('Berita Acara Peminjaman.pdf');
    }


    public function editpinjam(Request $request,$id){

        $data = PinjamanBarang::find($id);
        $data->id_pemilik_barang = $request->id_pemilik_barang;
        $data->id_barang = $request->id_barang;
        $data->id_peminjam = $request->id_peminjam;
        $data->jam_diterima = $request->jam_diterima;
        $data->tanggal_mulai = $request->tanggal_mulai;
        $data->tanggal_selesai = $request->tanggal_selesai;
        $data->lokasi_penggunaan = $request->lokasi_penggunaan;
        $data->lat = $request->lat;
        $data->long = $request->long;
        $data->keterangan = $request->keterangan;
        $data->status = 0;
        $data->save();

        return redirect()->back()->with(['success' => 'Berhasil Edit!']);

    }

    public function hapusPinjam($id){
        $data = PinjamanBarang::find($id);
        $data->delete();

        return redirect()->back()->with(['success' => 'Berhasil Hapus!']);
    }


    public function storePengembalian(Request $request,$id){
        $data = PinjamanBarang::find($id);
        $data->kondisi_pengembalian = $request->kondisi_pengembalian;
        $data->status_pengembalian = 0;
        // $data->tanggal_pengembalian = date('Y-m-d');
        $data->save();

        return redirect()->back()->with(['success' => 'Berhasil Request Pengembalian! silahkan cek di menu pengembalian untuk mengetahui status update nya']);
    }

    public function reqPengembalianMyAlat(){
        $data['page_title'] = 'Request Pengembalian Alat';
        $data['breadcumb'] = 'Request Pengembalian Alat';

        $data['peminjaman'] = DB::table('pinjaman_barangs')
        ->join('barangs', 'barangs.id', '=', 'pinjaman_barangs.id_barang')
        ->join('users', 'users.id', '=', 'pinjaman_barangs.id_peminjam')
        ->select('pinjaman_barangs.*','barangs.*','users.name as nama_peminjam','pinjaman_barangs.status as status_peminjaman','pinjaman_barangs.id as id_pinjaman')
        ->where('pinjaman_barangs.id_pemilik_barang',Auth::user()->id)
        ->where('pinjaman_barangs.status_pengembalian',0)
        ->get();
        return view('pinjaman.reqpengembalian', $data);

    }

    public function setSetujuPengembalian($id){
        $data = PinjamanBarang::find($id);
        $data->status_pengembalian = 1;
        $data->tanggal_pengembalian = date('Y-m-d');
        $data->save();

        return redirect()->back()->with(['success' => 'Berhasil setujui peminjaman! ']);
    }
    public function setTidakSetujuPengembalian($id){
        $data = PinjamanBarang::find($id);
        $data->status_pengembalian = 2;
        // $data->tanggal_pengembalian = date('Y-m-d');
        $data->save();

        return redirect()->back()->with(['success' => 'Berhasil setujui peminjaman! ']);
    }


    public function pengembalianList(){
        $data['page_title'] = 'Pengembalian Alat';
        $data['breadcumb'] = 'Pengembalian Alat';

        $data['peminjaman'] = DB::table('pinjaman_barangs')
        ->join('barangs', 'barangs.id', '=', 'pinjaman_barangs.id_barang')
        ->join('users', 'users.id', '=', 'pinjaman_barangs.id_peminjam')
        ->select('pinjaman_barangs.*','barangs.*','users.name as nama_peminjam','pinjaman_barangs.status as status_peminjaman','pinjaman_barangs.id as id_pinjaman')
        ->where('pinjaman_barangs.id_peminjam',Auth::user()->id)
        ->get();
        return view('pinjaman.pengembalian', $data);

    }

    public function historyAlat($id){
        $data['page_title'] = 'History Alat';
        $data['breadcumb'] = 'History Alat';

        $data['peminjaman'] = DB::table('pinjaman_barangs')
        ->join('barangs', 'barangs.id', '=', 'pinjaman_barangs.id_barang')
        ->join('users', 'users.id', '=', 'pinjaman_barangs.id_peminjam')
        ->select('pinjaman_barangs.*','barangs.*','users.name as nama_peminjam','pinjaman_barangs.status as status_peminjaman','pinjaman_barangs.id as id_pinjaman')
        ->where('pinjaman_barangs.id_barang',$id)
        ->get();

        // dd($data['peminjaman']);
        return view('alat.history', $data);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PinjamanBarang  $pinjamanBarang
     * @return \Illuminate\Http\Response
     */
    public function show(PinjamanBarang $pinjamanBarang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PinjamanBarang  $pinjamanBarang
     * @return \Illuminate\Http\Response
     */
    public function edit(PinjamanBarang $pinjamanBarang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PinjamanBarang  $pinjamanBarang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PinjamanBarang $pinjamanBarang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PinjamanBarang  $pinjamanBarang
     * @return \Illuminate\Http\Response
     */
    public function destroy(PinjamanBarang $pinjamanBarang)
    {
        //
    }
}
