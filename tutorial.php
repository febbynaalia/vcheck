<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tutorial - V-Check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6e8;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding-bottom: 80px;
        }

        header {
            background-color: #a3a96e;
            color: white;
            padding: 20px 25px;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 700;
            font-size: 1.4rem;
        }

        .back-btn {
            font-size: 1.4rem;
            cursor: pointer;
        }

        main {
            padding: 20px;
        }

        .tutorial-card {
            background-color: white;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .tutorial-card h5 {
            color: #7a7f4a;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }

        .tutorial-grid {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 15px;
            flex-wrap: wrap;
        }

        .tutorial-section {
            flex: 1;
            min-width: 160px;
        }

        .tutorial-section h6 {
            font-weight: 600;
            color: #7a7f4a;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }

        .tutorial-section img {
            max-width: 100%;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .tutorial-section p {
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 8px;
        }

        .note {
            color: #7a7f4a;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .skpm-box {
            background-color: white;
            border-radius: 15px;
            padding: 15px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 700;
            font-size: 1rem;
            color: #7a7f4a;
        }

        .accordion-button {
            font-weight: 600;
            color: #7a7f4a;
            /* Warna hijau olive yang sama seperti di gambar kanan */
            font-family: 'Poppins';
            /* Sesuaikan jika kamu pakai font khusus */
        }


        .footer {
            background-color: #a3a96e;
            padding: 12px 0;
            display: flex;
            justify-content: space-around;
            align-items: center;
            border-radius: 20px 20px 0 0;
            color: white;
            font-size: 1.5rem;
            position: fixed;
            bottom: 0;
            width: 100%;
            left: 0;
            box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.1);
        }

        .footer button {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }

        @media (max-width: 500px) {
            .tutorial-grid {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header class="header d-flex align-items-center sticky-top">
        <div class="back-btn" onclick="history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </div>
        <div class="page-title mx-auto">Tutorial</div>
    </header>

    <!-- Main Content -->
    <main>
        <div class="accordion" id="tutorialAccordion">
            <!-- Absensi -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingAbsensi">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseAbsensi" aria-expanded="true" aria-controls="collapseAbsensi">
                        Absensi
                    </button>
                </h2>
                <div id="collapseAbsensi" class="accordion-collapse collapse show" aria-labelledby="headingAbsensi"
                    data-bs-parent="#tutorialAccordion">
                    <div class="accordion-body">
                        <!-- Konten absensi (dari kode kamu yang sebelumnya) -->
                        <div class="row gx-3">
                            <div class="col-12 col-md-6">
                                <div class="p-2">
                                    <h6 class="text-center" style="color:#7a7f4a; font-weight:600;">Kalau kamu hadir…
                                    </h6>
                                    <div class="text-center mb-2">
                                        <img src="assets/scanQR.jpg" alt="Scan QR" class="img-fluid rounded mb-2"
                                            style="max-height: 200px;" />
                                    </div>
                                    <p class="text-center" style="font-size: 0.85rem;">Klik icon ‘scan’ di bagian tengah
                                        bawah.</p>
                                    <p class="text-center" style="font-size: 0.85rem;">Arahkan kamera ke QR code yang
                                        diberikan oleh dosen di kelas.</p>
                                    <p class="text-center note">Ingat! Scan QR hanya bisa dilakukan di kelas saat
                                        mengikuti perkuliahan.</p>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="p-2">
                                    <h6 class="text-center" style="color:#7a7f4a; font-weight:600;">Kalau tidak hadir…
                                    </h6>
                                    <div class="text-center mb-2">
                                        <img src="assets/upload.jpg" alt="Upload" class="img-fluid rounded mb-2"
                                            style="max-height: 200px;" />
                                    </div>
                                    <p class="text-center" style="font-size: 0.85rem;">Klik icon ‘upload’ di bagian
                                        tengah bawah.</p>
                                    <p class="text-center" style="font-size: 0.85rem;">Pilih jenis absensi berdasarkan
                                        kondisimu.</p>
                                    <p class="text-center note">Upload bukti ketidakhadiran.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SKPM -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSKPM">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSKPM" aria-expanded="false" aria-controls="collapseSKPM">
                        SKPM
                    </button>
                </h2>
                <div id="collapseSKPM" class="accordion-collapse collapse" aria-labelledby="headingSKPM"
                    data-bs-parent="#tutorialAccordion">
                    <div class="accordion-body">
                        <p>Penjelasan tentang SKPM dimasukkan di sini...</p>
                    </div>
                </div>
            </div>

            <!-- STUDY PARTNER -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSP">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSP" aria-expanded="false" aria-controls="collapseSP">
                        Study Partner
                    </button>
                </h2>
                <div id="collapseSP" class="accordion-collapse collapse" aria-labelledby="headingSP"
                    data-bs-parent="#tutorialAccordion">
                    <div class="accordion-body">
                        <p>Penjelasan tentang SKPM dimasukkan di sini...</p>
                    </div>
                </div>
            </div>

            <!-- Oyen -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOyen">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOyen" aria-expanded="false" aria-controls="collapseOyen">
                        Oyen
                    </button>
                </h2>
                <div id="collapseOyen" class="accordion-collapse collapse" aria-labelledby="headingOyen"
                    data-bs-parent="#tutorialAccordion">
                    <div class="accordion-body">
                        <p class="text-center" style="font-size: 0.85rem;">Oyen adalah teman yang memandumu berkuliah.
                            Karena di dunia ini tidak ada yang gratis, oyen harus dikasih makan!</p>
                        <p class="text-center" style="font-size: 0.85rem;">Setiap menyelesaikan satu presensi, kamu akan
                            mendapat cat food.</p>
                        <div class="text-center mb-2">
                            <img src="assets/tutorOyen.jpg" alt="Scan QR" class="img-fluid rounded mb-2"
                                style="max-height: 200px;" />
                        </div>
                        <p class="text-center" style="font-size: 0.85rem;">Kasih makan dengan klik tombol hijau.</p>
                        <p class="text-center note">Jangan lupa kasih makan sebelum Oyen sakit!</p>
                        <p class="text-center" style="font-size: 0.65rem;">"ingat, oyen bukan makanan darurat!"</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <button onclick="window.location.href='menu.php'"><i class="fa-solid fa-bars"></i></button>
        <button onclick="window.location.href='notification.php'"><i class="fa-regular fa-bell"></i></button>
        <button onclick="window.location.href='scanQR.php'"><i class="fa-solid fa-qrcode"></i></button>
        <button onclick="window.location.href='upload-1.php'"><i class="fa-solid fa-upload"></i></button>
        <button onclick="window.location.href='profile.php'"><i class="fa-regular fa-user"></i></button>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>