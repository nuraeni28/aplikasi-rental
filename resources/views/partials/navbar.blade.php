<body class="fixed-left">
 
    <!-- Loader -->
    <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center">
                    <a href="{{ route('dashboard') }}" class="logo"><img src="{{ asset('assets/images/logo-rental.png') }}" style="max-width: 100px" alt=""> ReM0</a>
                    <!-- <a href="index.html" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
                </div>
            </div>

            <div class="sidebar-inner slimscrollleft">

                <div id="sidebar-menu">
                    <ul>

                        <li>
                            <a href="{{ route('dashboard') }}" class="waves-effect">
                                <i class="mdi mdi-airplay"></i>
                                <span> Dashboard </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('mobil.index') }}" class="waves-effect">
                                <i class="mdi mdi-car"></i>
                                <span>Mobil</span>
                            </a>
                        </li>
                       
                        <li>
                            <a href="{{ route('peminjaman.index') }}" class="waves-effect">
                                <i class="mdi mdi-book"></i>
                                <span>Peminjaman</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('pengembalian.index') }}" class="waves-effect">
                                <i class="mdi mdi-book"></i>
                                <span>Pengembalian</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('user') }}" class="waves-effect">
                                <i class="mdi mdi-account"></i>
                                <span>{{ Auth::user()->nama }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="waves-effect">
                                <i class="mdi mdi-schedule"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    
                       

                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>
        <!-- Left Sidebar End -->
