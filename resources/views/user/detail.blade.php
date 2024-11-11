<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Wisata</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
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
            margin-bottom: 20px;
            /* jarak antar gambar */
            border-radius: 8px;
            /* memberi efek sudut melengkung */
        }

        /* Membuat deskripsi rata kanan kiri */
        .justify-text {
            text-align: justify;
        }

    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Detail Wisata</h2>

        <div class="card mb-4 p-3">
            <div class="row">
                <!-- Bagian Gambar -->
                <div class="col-4">
                    <!-- Jika ada beberapa gambar, semuanya akan tampil urut ke bawah -->
                    <img src="https://res.cloudinary.com/dallljsye/image/upload/v1727027758/wisata_foto/jrxo9ze1mqpnbzpvaqrq.jpg"
                        class="img-fluid card-img" style="width: 400px; height: 200px;" alt="Gambar Wisata 1">

                </div>
                <div class="col-4">
                    <!-- Jika ada beberapa gambar, semuanya akan tampil urut ke bawah -->
                    <img src="https://res.cloudinary.com/dallljsye/image/upload/v1727027761/wisata_foto/zybczlkxlmjflbqmb9uk.jpg"
                        class="img-fluid card-img" style="width: 400px; height: 200px;" alt="Gambar Wisata 1">

                </div>
                <div class="col-4">
                    <!-- Jika ada beberapa gambar, semuanya akan tampil urut ke bawah -->
                    <img src="https://res.cloudinary.com/dallljsye/image/upload/v1727027764/wisata_foto/pvcjur8sgxslmciql1ln.jpg"
                        class="img-fluid card-img" style="width: 400px; height: 200px;" alt="Gambar Wisata 1">

                </div>


                <!-- Bagian Detail -->
                <div class="col-12">
                    <div class="card-body">
                        <h5 class="card-title">Waterpark Bahari</h5>
                        <!-- Membuat deskripsi rata kanan kiri -->
                        <p class="card-text justify-text">
                            <strong>Deskripsi : </strong> Gerbang Mas Bahari Waterpark atau Bahari Waterpark merupakan
                            salah satu wahana permainan air terbesar di Tegal, Jawa Tengah. Obyek wisata ini bisa
                            menjadi alternatif wisata Tegal selain pantai. Lokasi Gerbang Mas Bahari Waterpark berada di
                            Sumurpanggang, Jalan Dr. Wahidin Sudirohusodo, Pesurungan Lor, Kecamatan Margadana, Kota
                            Tegal. Waterpark ini berada di pusat Kota Tegal, sekitar 3,4 kilometer (km) atau 8 menit
                            berkendara dari Alun-alun Tegal.
                            Waterpark ini merupakan salah satu obyek wisata favorit warga Tegal. Selain bisa menikmati
                            beragam wahana permainan air yang seru, harga tiket Bahari Waterpark juga cukup ramah
                            kantong.
                        </p>
                        <p class="card-text"><strong>Lokasi: </strong> Kota Tegal</p>
                        <p class="card-text"><strong><a target="_blank" href="https://www.google.com/maps/place/Pantai+Alam+Indah/@-6.8474907,109.1390353,18z/data=!3m1!4b1!4m6!3m5!1s0x2e6fb7755674bc29:0xf84b949fae96c67a!8m2!3d-6.8475532!4d109.1403735!16s%2Fg%2F11b81xrvtz?entry=ttu&g_ep=EgoyMDI0MDkyOS4wIKXMDSoASAFQAw%3D%3D">Lihat Lokasi</a></strong></p>

                        <div class="text-center">
                            <h1>Virtual Tour</h1>
                            <div id="panorama"></div>
                        </div>
                        <p class="card-text">
                            <small class="text-muted">Detail lengkap mengenai tempat wisata ini.</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data scenes yang diambil dari controller
        var scenes = {
            "8": {
                "title": "Gerbang Tikett",
                "hfov": 110,
                "pitch": 0,
                "yaw": 0,
                "type": "equirectangular",
                "panorama": "https:/res.cloudinary.com/dallljsye/image/upload/v1727328062/panorama_wisata_foto/csygj8xmdqgikgmsubr5.jpg",
                "hotSpots": []
            }
        };
        console.log({
            "8": {
                "title": "Gerbang Tikett",
                "hfov": 110,
                "pitch": 0,
                "yaw": 0,
                "type": "equirectangular",
                "panorama": "https:/res.cloudinary.com/dallljsye/image/upload/v1727328062/panorama_wisata_foto/csygj8xmdqgikgmsubr5.jpg",
                "hotSpots": []
            }
        });


        // Buat Pannellum viewer dengan data dinamis dari scenes
        pannellum.viewer('panorama', {
            "default": {
                "firstScene": Object.keys(scenes)[0], // Panorama pertama (scene pertama)
                // "author": "Tour Guide",
                // "sceneFadeDuration": 1000
            },
            "scenes": scenes
        });

    </script>
</body>

</html>
