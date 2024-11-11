@extends('admin.layouts.header')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                {{-- <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Pengguna Registrasi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div> --}}

                <div class="col-lg-4 col-6">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$dataWisata}}</h3>
                            <p>Wisata</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-suitcase-rolling"></i>
                        </div>
                        <a href="{{route('admin.adminWisata')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                
                <div class="col-lg-4 col-6">
                    
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{$dataSejarah}}</h3>
                            <p>Sejarah</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-landmark"> </i>
                        </div>
                        <a href="{{route('admin.adminSejarah')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$dataKuliner}}</h3>
                            <p>Kuliner</p>
                        </div>
                        <div class="icon">
                            <i class="nav-icon fas fa-hamburger"></i>
                        </div>
                        <a href="{{route('admin.adminKuliner')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
            </div>


        </div>
    </section>

</div>
@endsection