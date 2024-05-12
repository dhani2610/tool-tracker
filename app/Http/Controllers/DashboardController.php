<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:dashboard', ['only'=> 'dashboard']);
    }

    public function dashboard(Request $request)
    {
        $data['page_title'] = 'Dashboard';
        $data['breadcumb'] = 'Dashboard';
        return view('dashboard.index', $data);
    }

    public function getMap(){
        if (Auth::user()->getRoleNames()[0] == 'SuperAdmin') {
            $locations = DB::table('pinjaman_barangs')
            ->join('barangs', 'barangs.id', '=', 'pinjaman_barangs.id_barang')
            ->join('users', 'users.id', '=', 'pinjaman_barangs.id_peminjam')
            ->select('pinjaman_barangs.*')
            ->get();
        }else {
            $locations = DB::table('pinjaman_barangs')
            ->join('barangs', 'barangs.id', '=', 'pinjaman_barangs.id_barang')
            ->join('users', 'users.id', '=', 'pinjaman_barangs.id_peminjam')
            ->select('pinjaman_barangs.*')
            ->where('pinjaman_barangs.id_pemilik_barang',Auth::user()->id)
            ->get();
        }

        return json_encode($locations);
    }

 
}
