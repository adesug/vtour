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
                            <h3 class="card-title">Form panorama wisata</h3>
                        </div>


                        <form id="addWisata" action="{{route('admin.adminSejarahPanoramaConnectStore')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                              <!-- Input lainnya -->
                              <div class="form-group">
                                  <label>Panorama Asal</label>
                                  <select name="source_panorama_id" class="custom-select">
                                    <option disabled selected> Pilih Panorama Asal</option>
                                   @foreach ($panoramaData as $item)   
                                        <option value="{{$item->id }}"> {{$item->title }} -- {{$item->touristSpot->name}}</option>
                                   @endforeach
                                    </select>
                              </div>
                              <div class="form-group">
                                <label>Panorama Tujuan</label>
                                <select name="destination_panorama_id" class="custom-select">
                                  <option disabled selected> Pilih Panorama Tujuan</option>
                                  @foreach ($panoramaData as $item)   
                                  <option value="{{$item->id }}"> {{$item->title }} -- {{$item->touristSpot->name}}</option>
                             @endforeach
                                  </select>
                            </div>
                             
                            <div class="form-group">
                                <label>Deskripsi </label>
                                <input type="text" name="link_description" class="form-control mb-2" placeholder="Misal : Ke pemandangan bukit">
                            </div>    
                             
                            <div class="form-group">
                                <label>Pitch (Sudut Vertical)</label>
                                <input type="number" step="0.1" name="pitch" class="form-control mb-2" placeholder="Misal: 0.0">
                            </div>    
                            <div class="form-group">
                                <label>Yaw (Sudut Horizontal)</label>
                                <input type="number" step="0.1" name="yaw" class="form-control mb-2" placeholder="Misal: 180.0">
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
