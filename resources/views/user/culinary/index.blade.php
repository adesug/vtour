<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wisata Explore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <style>
        footer a {
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        footer .fab {
            font-size: 1.5rem;
            /* Adjust icon size */
            transition: color 0.3s;
        }

        footer .fab:hover {
            color: #f39c12;
            /* Change color on hover */
        }

        .card-img-top {
            width: 100%;
            /* Mengatur lebar gambar agar sesuai dengan lebar kartu */
            height: 250px;
            /* Mengatur tinggi tetap untuk menjaga proporsi */
            object-fit: cover;
            /* Memastikan gambar terpotong dengan baik tanpa distorsi */
        }

        .card-img-top {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .card-text {
            height: 100px;
            /* Atur tinggi tetap */
            overflow: hidden;
            /* Sembunyikan teks yang berlebih */
            display: -webkit-box;
            /* Menggunakan box model untuk memotong teks */
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            /* Jumlah baris maksimum yang ditampilkan */
            text-align: justify;
            /* Rata kanan-kiri */
        }
    </style>
    <nav class="navbar navbar-expand-lg navbar-light bg-black sticky-top" style="height: 60px;">
        <div class="container">
            <a class="navbar-brand text-white" href="/">TegalTour</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav ms-auto ">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#scrollspywisata">Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#scrollspysejarah">Sejarah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#scrollspykuliner">Kuliner</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#scrollspytentang">Tentang Kami</a>
                    </li>
                    @if(Auth::user() != null )
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('logout_proses')}}">Log Out</a>
                    </li>

                    <span class="nav-link text-warning">{{Auth::user()->name}}</span>

                    @else

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('login')}}">Login</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div id="scrollspywisata"></div>
    <div class="card"></div>
    <div class="card"></div>
    <div class="container mt-5">
        <h2 class="my-4 text-center">Gallery Sejarah</h2> <!-- Title Added -->
        <div class="row shadow-lg p-3 mb-5 bg-body-tertiary rounded">
            @foreach ($dataKuliner as $item)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if ($item->fotos->isNotEmpty())
                    <img src="{{ $item->fotos->first()->foto_url }}" class="card-img-top" alt="Foto Wisata">
                    @else
                    <span>Foto Tidak Tersedia</span>
                    @endif
                    <!-- Tambahkan penutup if di sini -->
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->name }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($item->description, 200, '...') }}</p>
                        <a href="/gallery/culinary/detail/{{$item->id}}" class="btn btn-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
     
    </div>
    {{-- footer --}}
    <footer class="bg-black text-light py-5" id="scrollspytentang">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Tentang Kami</h5>
                    <p>Tur Virtual ini dibuat untuk kebutuhan informasi, promosi, edukasi, hiburan, dokumentasi dan
                        presentasi. Jelajahi suatu tempat dari rumah, kami menawarkan pengalaman mendalam yang membawa
                        anda ke lokasi secara virtual. </p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Menu</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light">Beranda</a></li>
                        <li><a href="#" class="text-light">Wisata</a></li>
                        <li><a href="#" class="text-light">Sejarah</a></li>
                        <li><a href="#" class="text-light">Kuliner</a></li>
                        <li><a href="#" class="text-light">Tentang Kami</a></li>
                        <li><a href="#" class="text-light">Login</a></li>


                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Kontak Kami</h5>
                    <p>Email: <a href="mailto:info@example.com" class="text-light">info@example.com</a></p>
                    <p>Phone: <a href="tel:+123456789" class="text-light">+123 456 789</a></p>
                    <h5>Follow Us</h5>
                    <a href="#" class="text-light me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; 2024 Virtual Tour Kota Tegal. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
