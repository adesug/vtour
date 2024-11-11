@extends('admin.layouts.header')
@section('content')

<div class="content-wrapper" style="min-height: 800px;">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Data Wisata</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Wisata</a></li>
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
                            <h3 class="card-title">Formm data wisata</h3>
                        </div>

                        <form id="editSejarah" action="{{route('admin.adminSejarahUpdate',$historySpot->id)}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                              <!-- Input lainnya -->
                              <input type="text" value="wisata" name="category" hidden>
                              <div class="form-group">
                                  <label>Nama Wisata</label>
                                  <input type="text" value="{{ old('name', $historySpot->name) }}" name="name" class="form-control mb-2" placeholder="Masukkan Nama Wisata">
                              </div>
                              <div class="form-group">
                                  <label>Deskripsi Wisata</label>
                                  <textarea name="description" class="form-control mb-2" placeholder="Masukkan Deskripsi Wisata" rows="5">{{ old('description', $historySpot->description) }}</textarea>
                              </div>
                              <div class="form-group">
                                  <label>Alamat Wisata</label>
                                  <input type="text" value="{{ old('address', $historySpot->address) }}" name="address" class="form-control mb-2" placeholder="Masukkan Alamat Wisata">
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
