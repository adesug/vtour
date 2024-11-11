<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Data Panorama</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <form class="formStore" action="{{route('admin.adminWisataPanoramaUpdate',$panorama->id)}}" method="POST" id="formUser" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Nama Wisata</label>
                <select name="name" class="custom-select">
                    <option hidden>Pilih Data</option>
                    @foreach ($touristSpotData as $item)
                    <option {{$item->id == $panorama->tourist_spot_id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                        
                    @endforeach
                    {{-- <option {{$dataAbsensi->waktu_kerja == '1 hari' ? 'selected' : ''}} value="1 Hari">1 Hari</option>
                    <option {{$dataAbsensi->waktu_kerja == '1/2 hari' ? 'selected' : ''}} value="1/2 Hari">1/2 Hari</option> --}}
                   
                </select>
            </div>
            <div class="form-group">
                <label>Judul Panorama</label>
                <input value="{{$panorama->title}}" type="text" name="title" class="form-control"
                    placeholder="Masukkan judul panorama">
            </div>
            <div class="form-group">
                <label>Upload Panorama</label>
                <input type="file" name="panorama" class="form-control"
                    placeholder="Masukkan panorama">
            </div>
           

           
          
        </div>

      
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="simpanFormKaryawan" type="submit" class="btn btn-primary">Update Data</button>
            </div>
       
    </form>
</div>