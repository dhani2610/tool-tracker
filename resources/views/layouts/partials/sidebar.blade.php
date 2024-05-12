<!-- ========== Left Sidebar Start ========== -->
<style>
span{
    color: black;
}
#sidebar-menu{
    background: silver;
}
.simplebar-content-wrapper{
    background: silver!important;
}
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu" style="background:silver">
                <li class="menu-title" key="t-menu">Menu Dashboard</li>

                @if(auth()->user()->can('dashboard'))
                <li>
                    <a href="{{ route('dashboard.index') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('menu-admin')) 
                <li class="menu-title" key="t-menu">Menu Admin</li>
                @endif

                @if(auth()->user()->can('approval-user')) 
                <li>
                    <a href="{{ route('approval-list') }}" class="waves-effect">
                        <i class="mdi mdi-tools"></i>
                        <span key="t-dashboards">Approval User</span>
                    </a>
                </li>
                @endif

                
                @if(auth()->user()->can('approval-alat'))
                <li>
                    <a href="{{ route('approve-alat') }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span data-key="t-dashboard">Approve Alat</span>
                    </a>
                </li>
                @endif

                 

                @if(auth()->user()->can('master-data'))
                <li>
                    <a href="{{ route('master-data.index') }}">
                        <i class="mdi mdi-folder-outline"></i>
                        <span data-key="t-dashboard">Master Data</span>
                    </a>
                </li>
                @endif


                @if(auth()->user()->can('menu-user'))
                <li class="menu-title" key="t-menu">Menu User</li>
                @endif


                @if(auth()->user()->can('my-alat'))
                <li>
                    <a href="{{ route('alat-list') }}" class="waves-effect">
                        <i class="mdi mdi-tools"></i>
                        <span key="t-dashboards">My Alat</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('menu-pinjaman'))
                <li class="menu-title" key="t-menu">Menu Pinjaman</li>
                @endif
                
                @if(auth()->user()->can('request-pinjaman-my-alat'))
                <li>
                    <a href="{{ route('request-peminjaman-my-alat') }}" class="waves-effect">
                        <i class="mdi mdi-tools"></i>
                        <span key="t-dashboards"> Request Pinjaman My Alat</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('peminjaman'))
                <li>
                    <a href="{{ route('peminjaman-alat') }}" class="waves-effect">
                        <i class="mdi mdi-tools"></i>
                        <span key="t-dashboards">Peminjaman</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('menu-pengembalian'))
                <li class="menu-title" key="t-menu">Menu Pengembalian</li>
                @endif

                        
                @if(auth()->user()->can('request-pengembalian-my-alat'))
                <li>
                    <a href="{{ route('req-pengembalian-alat') }}" class="waves-effect">
                        <i class="mdi mdi-tools"></i>
                        <span key="t-dashboards"> Request Pengembalian My Alat</span>
                    </a>
                </li>
                @endif

                @if(auth()->user()->can('pengembalian'))
                <li>
                    <a href="{{ route('pengembalian-list') }}" class="waves-effect">
                        <i class="mdi mdi-tools"></i>
                        <span key="t-dashboards">Pengembalian</span>
                    </a>
                </li>
                @endif


                @if(auth()->user()->can('menu-umum'))
                <li class="menu-title" key="t-menu">Menu Umum</li>
                @endif


                @if(auth()->user()->can('alat'))
                <li>
                    <a href="{{ route('alat-list-umum') }}" class="waves-effect">
                        <i class="mdi mdi-tools"></i>
                        <span key="t-dashboards"> Alat</span>
                    </a>
                </li>
                @endif


      

                <li>
                    <form action="{{ url('/logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn"> 
                            <i class="mdi mdi-logout"></i>
                            <span data-key="t-dashboard">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->