<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">Edit Data Panorama Koneksi</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    <form class="formStore" action="{{route('admin.adminSejarahPanoramaConnectUpdate',$dataPanoramaConnect->id)}}" method="POST" id="formUser" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Panorama Asal</label>
                <select name="sumber_panorama" class="custom-select">
                    <option hidden>Pilih Data</option>
                    @foreach ($dataPanorama as $item)
                        <option {{$dataPanoramaConnect->source_panorama_id == $item->sourcePanorama->id ? 'selected' : ''}}  value="{{$item->sourcePanorama->id }}">{{$item->sourcePanorama->title }} -- {{$item->sourcePanorama->touristSpot->name}}</option>
                    @endforeach
                  
                </select>
            </div>
            <div class="form-group">
                <label>Panorama Tujuan</label>
                <select name="tujuan_panorama" class="custom-select">
                    <option hidden>Pilih Data</option>
                    @foreach ($dataPanorama as $item)
                        <option {{$dataPanoramaConnect->destination_panorama_id == $item->destinationPanorama->id ? 'selected' : ''}}  value="{{$item->destinationPanorama->id }}">{{$item->destinationPanorama->title }} -- {{$item->destinationPanorama->touristSpot->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <input value="{{$dataPanoramaConnect->link_description}}" type="text" name="deskripsi" class="form-control"
                    placeholder="Misal ke pemandangan bukit">
            </div>
            <div class="form-group">
                <label>Pitch (Sudut Vertical)</label>
                <input value="{{$dataPanoramaConnect->pitch}}" type="text" name="pitch" class="form-control"
                    placeholder="Masukkan sudut vertical">
            </div>
            <div class="form-group">
                <label>Yaw (Sudut Horizontal)</label>
                <input value="{{$dataPanoramaConnect->yaw}}" type="text" name="yaw" class="form-control"
                    placeholder="Masukkan sudut horizontal">
            </div>
           
           

           
          
        </div>

      
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="simpanFormKaryawan" type="submit" class="btn btn-primary">Update Data</button>
            </div>
       
    </form>
</div>