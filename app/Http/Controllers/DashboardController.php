<?php

namespace App\Http\Controllers;

use App\Models\penelitian; 
use App\Models\pengabdian;
use App\Models\kegiatan;
use App\Models\publikasi;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
}
