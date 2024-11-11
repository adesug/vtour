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
                            <h3 class="card-title">Form data wisata</h3>
                        </div>


                        <form id="editWisata" action="/panelAdmin/tour/store" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                              <!-- Input lainnya -->
                              <input type="text" value="wisata" name="category" hidden>
                              <div class="form-group">
                                  <label>Nama Wisata</label>
                                  <input type="text" value="{{ old('name', $touristSpot->name) }}}" name="name" class="form-control mb-2" placeholder="Masukkan Nama Wisata">
                              </div>
                              <div class="form-group">
                                  <label>Deskripsi Wisata</label>
                                  <textarea name="description" class="form-control mb-2" placeholder="Masukkan Deskripsi Wisata" rows="5">{{ old('description', $touristSpot->description) }}</textarea>
                              </div>
                              <div class="form-group">
                                  <label>Alamat Wisata</label>
                                  <input type="text" value="{{ old('address', $touristSpot->address) }}" name="address" class="form-control mb-2" placeholder="Masukkan Alamat Wisata">
                              </div>
                              {{-- <div class="form-group">
                                  <label>Url Maps Wisata</label>
                                  <input type="text" name="url_maps" class="form-control mb-2" placeholder="Masukkan Url Maps Wisata">
                              </div> --}}
                          
                           

                            <div class="form-group">
                                <label>Foto yang sudah ada:</label>
                                <div class="row">
                                    @foreach ($fotos as $foto)
                                        <div class="col-md-4">
                                            <img src="{{ $foto->foto_url }}" class="img-thumbnail mb-2" alt="Foto" style="width: 100%; height: 250px; object-fit: cover;">
                                            <form action="{{ route('tourist_spots.photo.delete', $foto->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE') <!-- Simulasi metode DELETE -->
                                                <button type="submit" class="btn btn-danger btn-sm delete-photo">Hapus</button>
                                            </form>                                    </div>
                                    @endforeach
                                </div>
                            </div>   

                            @if(count($fotos) < 3 ) 
                            <div class="form-group">
                                <label>Foto Wisata</label>
                                <div id="image-input-container" class="row">
                                    <div class="col-md-4 mb-3 image-input-wrapper">
                                        <input type="file" name="foto[]" class="form-control mb-2">
                                    </div>
                                </div>
                                @if(count($fotos) < 3 )
                                <button type="button" class="btn btn-success btn-sm" id="add-image-button">Tambah Form Gambar</button>
                                @endif
                                <small class="form-text text-muted">Maksimal 3 gambar.</small>
                            </div>
                          @endif
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const existingPhotosCount = {{ count($fotos) }}; // Pass the count from the server
        let maxImages = 3 - existingPhotosCount; // Calculate max images based on existing photos

        const addImageButton = document.getElementById('add-image-button');
        const imageInputContainer = document.getElementById('image-input-container');

        // Event listener for adding image input fields
        addImageButton.addEventListener('click', function() {
            const currentInputs = imageInputContainer.querySelectorAll('.image-input-wrapper').length;

            if (currentInputs < maxImages) {
                const newInput = document.createElement('div');
                newInput.classList.add('col-md-4', 'mb-3', 'image-input-wrapper');
                newInput.innerHTML = `
                    <input type="file" name="foto[]" class="form-control mb-2">
                    <button type="button" class="btn btn-danger btn-sm remove-image-button">Remove</button>
                `;
                imageInputContainer.appendChild(newInput);

                // Add event listener for remove button
                newInput.querySelector('.remove-image-button').addEventListener('click', function() {
                    newInput.remove();
                });
            } else {
                alert('Maksimal 3 gambar sudah ditambahkan.');
            }
        });
    });
</script>



@endpush
