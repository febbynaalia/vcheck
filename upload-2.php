<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Upload Detail - V-Check</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
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
      padding: 20px;
      font-weight: 700;
      font-size: 1.5rem;
      border-radius: 0 0 20px 20px;
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .back-arrow {
      font-size: 1.5rem;
      cursor: pointer;
      user-select: none;
    }

    main {
      padding: 20px;
    }

    .upload-card {
      background-color: white;
      border-radius: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      position: relative;
    }

    .tab-icons {
      display: flex;
      gap: 10px;
      margin-bottom: 15px;
    }

    .tab-icon {
      background-color: #f4f6e8;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.07);
      border: none;
      border-radius: 10px;
      padding: 10px 14px;
      cursor: pointer;
      color: #a3a96e;
      font-size: 1.2rem;
      transition: background 0.2s, color 0.2s;
      outline: none;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .tab-icon:hover, .tab-icon:focus {
      background-color: #e6f0c9;
      color: #7a7f4a;
    }

    .tab-icon:active {
      background-color: #d2e3a7;
    }

    .tab-icon i {
      pointer-events: none;
    }

    .file-size-text {
      position: absolute;
      top: 20px;
      right: 20px;
      font-size: 0.85rem;
      color: #a3a96e;
      font-weight: 600;
    }

    .upload-area {
      border: 2px dashed #a3a96e;
      border-radius: 20px;
      min-height: 150px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
      padding: 1rem;
      text-align: center;
      color: #a3a96e;
    }
    
    .upload-area input[type="file"] {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0; /* Sembunyikan input file asli */
        cursor: pointer;
    }

    .btn-send {
        background-color: #a3a96e;
        border: none;
        color: white;
        font-weight: 600;
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
      box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.1);
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
    }

    .footer button {
      background: none;
      border: none;
      color: white;
      cursor: pointer;
    }

    .footer i:hover {
      color: #e6f0c9;
    }
  </style>
</head>

<body>

  <header class="header d-flex align-items-center sticky-top">
    <div class="back-btn" onclick="history.back()">
      <i class="fa-solid fa-arrow-left"></i>
    </div>
    <div class="page-title mx-auto">Upload Detail</div>
  </header>

  <main>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="upload-card">

          <!-- Tab Icons for File Actions -->
            <div class="tab-icons">
              <button type="button" class="tab-icon" title="Unggah File" onclick="document.getElementById('fileInput').click();">
                <i class="fa-solid fa-file-upload"></i>
              <button type="button" class="tab-icon" title="Edit File" onclick="document.getElementById('fileInput').click();">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
              <button type="button" class="tab-icon" title="Hapus File" onclick="document.getElementById('fileInput').value='';document.getElementById('fileName').textContent='Klik atau jatuhkan file di sini';">
                <i class="fa-solid fa-trash-can"></i>
              </button>
            </div>

            <!-- File Size Text -->
            <div class="file-size-text">Max: 5 MB</div>
            
            <div class="upload-area mt-3">
                <input type="file" name="file" id="fileInput" required>
                <i class="fa-solid fa-upload fs-1 mb-2"></i>
                <p id="fileName" class="fw-bold">Klik atau jatuhkan file di sini</p>
            </div>

            <div class="mt-3">
                <label for="keterangan" class="form-label fw-bold" style="color: #7a7f4a;">Keterangan:</label>
                <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: Surat Izin Mengikuti Lomba" required></textarea>
            </div>
            <button type="submit" class="btn btn-send w-100 mt-3">Kirim</button>
        </div>
    </form>
  </main>

  <footer class="footer">
    <button onclick="window.location.href='menu.php'"><i class="fa-solid fa-bars"></i></button>
    <button onclick="window.location.href='notification.php'"><i class="fa-regular fa-bell"></i></button>
    <button onclick="window.location.href='scanQR.php'"><i class="fa-solid fa-qrcode"></i></button>
    <button onclick="window.location.href='upload-1.php'"><i class="fa-solid fa-upload"></i></button>
    <button onclick="window.location.href='profile.php'"><i class="fa-regular fa-user"></i></button>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Script kecil untuk menampilkan nama file yang dipilih
    const fileInput = document.getElementById('fileInput');
    const fileName = document.getElementById('fileName');
    fileInput.addEventListener('change', function() {
      if (fileInput.files.length > 0) {
        fileName.textContent = fileInput.files[0].name;
      } else {
        fileName.textContent = 'Klik atau jatuhkan file di sini';
      }
    });
  </script>
</body>

</html>