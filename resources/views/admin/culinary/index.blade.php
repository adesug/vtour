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
                    <h1>Data Kuliner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Gallery</a></li>
                        <li class="breadcrumb-item active">Kuliner</li>
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
                            <h3 class="card-title">Daftar Data Kuliner</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                @if(Auth::check() && Auth::user()->role == 'superadmin')
                                <button id="createButton" class="btn btn-success btn-sm">Tambah Data kuliner</button>

                                @endif
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
                                    <table id="history" class="table table-bordered table-hover dataTable dtr-inline"
                                        aria-describedby="example2_info">
                                        <thead>
                                            <tr>
                                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                                    colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending">No</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                                    aria-label="Browser: activate to sort column ascending" style="">Nama</th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending" style="">Deskripsi
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                                    aria-label="Engine version: activate to sort column ascending" style="">Alamat
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending" style="">Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($culinaryData as $item) 
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">{{$loop->iteration}}</td>
                                                    <td style="">{{$item->name}}</td>
                                                    <td style="">{{ \Illuminate\Support\Str::limit($item->description, 50, '...') }}</td>
                                                    <td style="">{{$item->address}}</td>
                                                    <td style="">
                                                        <form action="{{route('admin.adminKulinerDestroy',$item->id)}}" method="POST">
                                                            <div class="btn-group btn-group-sm">
                                                                <a class="btn btn-warning edit" href="{{route('admin.adminKunlinerEdit',$item->id)}}"
                                                                    ><i class="fas fa-pen"></i>
                                                                    Edit</a>
                                                                <a href="{{route('admin.adminKulinerShow',$item->id)}}" class="btn btn-info detail"><i class="fas fa-eye"></i>
                                                                    Detail</a>
                                                                @csrf
                                                                <a class="btn btn-danger  delete-confirm"><i class="fas fa-trash">
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
            window.location.href = '{{route('admin.adminKulinerCreate')}}';
        });
        $('#history').on('click', '.delete-confirm', function (e) {
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
     
      $('#tourist').DataTable({
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
