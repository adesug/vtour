<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sejarah</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    <style>
    #panorama {
        margin: auto;
  /* width: 50%; */
  border: 3px solid green;
  /* padding: 10px; */
        width: 600px;
        height: 400px;
    }
    </style>

    <style>
        /* Menambahkan jarak antara gambar dengan garis */
        .card-img {
            margin-bottom: 20px; /* jarak antar gambar */
            border-radius: 8px;  /* memberi efek sudut melengkung */
        }
        /* Membuat deskripsi rata kanan kiri */
        .justify-text {
            text-align: justify;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Detail Kuliner</h2>

        <div class="card mb-4 p-3">
            <div class="row">
                <!-- Bagian Gambar -->
                @foreach ($dataFoto as $item)
                <div class="col-4">
                    <!-- Jika ada beberapa gambar, semuanya akan tampil urut ke bawah -->
                    <img src="{{ $item->foto_url }}" class="img-fluid card-img" style="width: 400px; height: 200px;" alt="Gambar Wisata 1">
                    {{-- <img src="{{ $item->image2 }}" class="img-fluid card-img" alt="Gambar Wisata 2"> --}}
                </div>
                @endforeach
               
              
                <!-- Bagian Detail -->
                <div class="col-12">
                    <div class="card-body">
                        <h5 class="card-title">{{ $touristSpot->name }}</h5>
                        <!-- Membuat deskripsi rata kanan kiri -->
                        <p class="card-text justify-text">
                            <strong>Deskripsi : </strong> {{ $touristSpot->description }}
                        </p>
                        <p class="card-text"><strong>Lokasi: </strong> {{ $touristSpot->address }}</p>
                        {{-- <p class="card-text"><strong>Virtual Tour : </strong> </p> --}}
                      
                        <p class="card-text">
                            <small class="text-muted">Detail lengkap mengenai tempat wisata ini.</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>