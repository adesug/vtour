@extends('admin.layouts.header')

@section('content')

<div class="content-wrapper" style="min-height: 1302.12px;">
    @if(Session::get('success'))
    <div class="alert alert-success alert-dismissible show fade" id="success-alert">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            {{Session::get('success')}}
        </div>
    </div>
    @endif
    @if(Session::get('warning'))
    <div class="alert alert-danger alert-dismissible show fade" id="warning-alert">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            {{Session::get('warning')}}
        </div>
    </div>
    @endif
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Panorama</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Wisata</a></li>
                        <li class="breadcrumb-item active">Panorama</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Daftar Data Panorama</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <button id="createButton" class="btn btn-success btn-sm">Tambah Data</button>
                                </div>
                            </div>
                        </div>

                        <div id="example2_wrapper" class="table-responsive dataTables_wrapper dt-bootstrap5">
                            <div class="row">
                                <div class="col-sm-12 col-md-6"></div>
                                <div class="col-sm-12 col-md-6"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="panorama" class="table table-bordered table-hover dataTable dtr-inline"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">No</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending" style="">Nama Wisata</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending" style="">Judul Panorama
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending" style="">Panorama
                                                </th>
                                                {{-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending" style="">Foto
                                                </th>  --}}
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="">Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($touristSpotData as $item) 
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">{{$loop->iteration}}</td>
                                                    <td>{{$item->touristSpot->name}}</td>
                                                    <td>{{$item->title}}</td>
                                                    <td><a target="_blank" href="{{$item->panorama_url}}" class="btn btn-secondary btn-xs">Lihat Gambar</a></td>
                                                    {{-- <td style="">{{ \Illuminate\Support\Str::limit($item->description, 50, '...') }}</td> --}}
                                                    {{-- <td style="">{{$item->address}}</td> --}}
                                                    {{-- <td>
                                                      
                                                            <img class="" src="{{$item->image}}" alt="">
                                                    
                                                    </td> --}}
                                                    <td style="">

                                                        <form action="{{route('admin.adminWisataPanoramaDestroy',$item->id)}}" method="POST">
                                                            <div class="btn-group btn-group-sm">
                                                                <a class="btn btn-warning edit" id="{{$item->id}}" data-toggle="modal" data-target="#modal-edit"
                                                                    ><i class="fas fa-pen"></i>
                                                                    Edit</a>
                                                                {{-- <a href="/panelAdmin/tour/detail/{{$item->id}}" class="btn btn-info detail"><i class="fas fa-eye"></i>
                                                                    Detail</a> --}}
                                                                @csrf
                                                                <a  class="btn btn-danger  delete-confirm"><i class="fas fa-trash">
                                                                        Hapus</i></a>
                                                            </div>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                           
                        </div>

                    </div>

                </div>
            </div>
            
          
        </div>
        {{-- modal edit --}}
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">
        
                    <div class="modal-body" id="loadeditform">
                       
                    </div>
        
                </div>
        
            </div>
        
        </div>
    </section>

</div>
@endsection
@push('myscript')
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $('#createButton').click(function(){
            window.location.href = '{{route('admin.adminWisataPanoramaCreate')}}';
        });
        $('#panorama').on('click','.edit', function () {            
            var id = $(this).attr('id');
            $.ajax({
                type : 'POST',
                url : '{{route('admin.adminWisataPanoramaEdit')}}',
                cache: false,
                data : {
                    _token : "{{ csrf_token();  }}",
                    id:id
                }, success:function(respond) {
                    $('#loadeditform').html(respond);
                }
            });
            $('#modal-edit').modal('show');
        });
        $('#panorama').on('click', '.delete-confirm', function (e) {
            var form = $(this).closest('form');
            e.preventDefault();
            Swal.fire({
                title: 'Yakin Data Ini Mau Di hapus ?',
                text: 'Jika ya maka data akan dihapus permanent',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus !',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                        'Deleted !', 'Data Berhasil Dihapus', 'success');
                }
            })
        });
    });
   

</script>
<script>
    $(function () {
     
      $('#panorama').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
   <script>
    $(document).ready(function() {
        // Auto-hide alert after 5 seconds
        setTimeout(function() {
            var successAlert = document.getElementById('success-alert');
            var warningAlert = document.getElementById('warning-alert');

            if (successAlert) {
                $(successAlert).fadeOut(500); // Menggunakan jQuery untuk efek fade
            }

            if (warningAlert) {
                $(warningAlert).fadeOut(500); // Menggunakan jQuery untuk efek fade
            }
        }, 5000); // 5000 milliseconds = 5 seconds
    });
</script>


@endpush
