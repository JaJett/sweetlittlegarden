<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Form Input Barang</h2>
        <form method="post" action="../proses/proses_tambah.php" enctype="multipart/form-data">
            <!-- Input ID Barang -->
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="A">Bunga</option>
                    <option value="B">Makanan</option>
                    <option value="C">Uang</option>
                </select>
            </div>

            <!-- Input Nama -->
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Barang" required>
            </div>

            <!-- Input Harga -->
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan Harga Barang" required>
            </div>

            <!-- Input Foto -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Barang</label>
                <input type="file" class="form-control" id="foto" name="foto">
            </div>

            <!-- Input Keterangan -->
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" rows="3" name="ket" placeholder="Masukkan Keterangan Barang"></textarea>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
