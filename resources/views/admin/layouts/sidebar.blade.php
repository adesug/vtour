<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="index3.html" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Virtual Tour Kota Tegal</span>
    </a>

    <div class="sidebar">
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
        alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
    </div>
    </div> --}}

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-header">Menu</li>
            <li class="nav-item">
                <a href="{{route('admin.adminDashboard')}}"
                    class="nav-link @if(request()->routeIs('admin.adminDashboard')) active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li
                class="nav-item @if(request()->routeIs('admin.adminWisata') || request()->routeIs('admin.adminWisataCreate') || 
                                    request()->routeIs('admin.adminWisataPanorama') || request()->routeIs('admin.adminWisataPanoramaCreate') ||
                                    request()->routeIs('admin.adminWisataPanoramaConnect') || request()->routeIs('admin.adminWisataPanoramaConnectCreate')) menu-open @endif">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-suitcase-rolling"></i>
                    <p>
                        Wisata
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.adminWisata')}}"
                            class="nav-link @if(request()->routeIs('admin.adminWisata') || request()->routeIs('admin.adminWisataCreate')) active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Wisata</p>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.adminWisataPanorama')}}"
                            class="nav-link @if(request()->routeIs('admin.adminWisataPanorama') || request()->routeIs('admin.adminWisataPanoramaCreate')) active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Panorama Wisata</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.adminWisataPanoramaConnect')}}"
                            class="nav-link @if(request()->routeIs('admin.adminWisataPanoramaConnect') || request()->routeIs('admin.adminWisataPanoramaConnectCreate')) active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Koneksi Panorama</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item @if(request()->routeIs('admin.adminSejarah') || request()->routeIs('admin.adminSejarahCreate') 
                                || request()->routeIs('admin.adminSejarahPanorama') || request()->routeIs('admin.adminSejarahPanoramaCreate') || request()->routeIs('admin.adminSejarahPanoramaConnect') 
                                || request()->routeIs('admin.adminSejarahPanoramaConnectCreate')) menu-open @endif">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-landmark"> </i>
                    <p>
                        Sejarah
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.adminSejarah')}}"
                            class="nav-link @if(request()->routeIs('admin.adminSejarah') || request()->routeIs('admin.adminSejarahCreate')) active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Sejarah</p>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.adminSejarahPanorama')}}"
                            class="nav-link  @if(request()->routeIs('admin.adminSejarahPanorama') || request()->routeIs('admin.adminSejarahPanoramaCreate')) active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Panorama Sejarah</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.adminSejarahPanoramaConnect')}}"
                            class="nav-link @if(request()->routeIs('admin.adminSejarahPanoramaConnect') || request()->routeIs('admin.adminSejarahPanoramaConnectCreate')) active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Koneksi Panorama</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item @if(request()->routeIs('admin.adminKuliner') || request()->routeIs('admin.adminKulinerCreate')) menu-open @endif">
                <a href="#" class="nav-link ">
                    <i class="nav-icon fas fa-hamburger"></i>
                    <p>
                        Kuliner
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.adminKuliner')}}"
                            class="nav-link @if(request()->routeIs('admin.adminKuliner') || request()->routeIs('admin.adminKulinerCreate')) active @endif">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Kuliner</p>

                        </a>
                    </li>
                   
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('logout_proses')}}" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                Log Out
                </p>
                </a>
                </li>
        </ul>
    </nav>

    </div>

</aside>
