@extends('admin.layouts.header')
@section('content')

<div class="content-wrapper" style="min-height: 800px;">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Kuliner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Kuliner</a></li>
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
                            <h3 class="card-title">Form data Kuliner</h3>
                        </div>


                        <form id="addKuliner" action="{{route('admin.adminKulinerStore')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="card-body">
                              <!-- Input lainnya -->
                              <input type="text" value="kuliner" name="category" hidden>
                              <div class="form-group">
                                  <label>Nama Kuliner</label>
                                  <input type="text" name="name" class="form-control mb-2" placeholder="Masukkan Nama Kuliner">
                              </div>
                              <div class="form-group">
                                  <label>Deskripsi Kuliner</label>
                                  <textarea name="description" class="form-control mb-2" placeholder="Masukkan Deskripsi Kuliner" rows="5"></textarea>
                              </div>
                              <div class="form-group">
                                  <label>Alamat Kuliner</label>
                                  <input type="text" name="address" class="form-control mb-2" placeholder="Masukkan Alamat Kuliner">
                              </div>
                              <div class="form-group">
                                  <label>Foto Kuliner</label>
                                  <div id="image-input-container" class="row">
                                      <div class="col-md-4 mb-3 image-input-wrapper">
                                          <input type="file" name="foto[]" class="form-control mb-2">
                                      </div>
                                  </div>
                                  <button type="button" class="btn btn-success btn-sm" id="add-image-button">Tambah Form Gambar</button>
                                  <small class="form-text text-muted">Maksimal 6 gambar.</small>
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
<script>
  document.addEventListener('DOMContentLoaded', function() {
      const addImageButton = document.getElementById('add-image-button');
      const imageInputContainer = document.getElementById('image-input-container');
      const maxImages = 6;

      // Event listener untuk menambah input gambar
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

              // Tambahkan event listener untuk tombol remove
              newInput.querySelector('.remove-image-button').addEventListener('click', function() {
                  newInput.remove();
              });
          } else {
              alert('Maksimal 6 gambar sudah ditambahkan.');
          }
      });

      // Tambahkan event listener untuk tombol remove pada input gambar pertama jika ingin menghapus
      const firstRemoveButton = imageInputContainer.querySelector('.remove-image-button');
      if (firstRemoveButton) {
          firstRemoveButton.addEventListener('click', function() {
              firstRemoveButton.parentElement.remove();
          });
      }
  });
</script>
@endpush
