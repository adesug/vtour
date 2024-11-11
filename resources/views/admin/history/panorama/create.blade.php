@extends('admin.layouts.header')
@section('content')

<div class="content-wrapper" style="min-height: 800px;">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Panorama Sejarah</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Sejarah</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form panorama sejarah</h3>
                        </div>


                        <form id="addWisata" action="{{route('admin.adminSejarahPanoramaStore')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                              <!-- Input lainnya -->
                              <div class="form-group">
                                  <label>Nama Sejarah</label>
                                  <select name="tourist_spot_id" class="custom-select">
                                    <option disabled selected> Pilih Nama Sejarah</option>
                                   @foreach ($touristSpotData as $item)   
                                        <option value="{{$item->id}}"> {{$item->name}}</option>
                                   @endforeach
                                    </select>
                              </div>
                              <div class="form-group">
                                  <label>Judul Panorama</label>
                                  <input type="text" name="title" class="form-control mb-2" placeholder="Masukkan Judul Panorama">
                              </div>
                              <div class="form-group">
                                <label>Foto Utama Panorama</label>
                                <input type="file" name="panorama" class="form-control mb-2">
                            </div>
                          </div>
                          <div class="card-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </form>
                    </div>

                </div>


                <div class="col-md-6">
                </div>

            </div>

        </div>
    </section>

</div>

@endsection
@push('myscript')

@endpush
