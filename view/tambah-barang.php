<div class="card">
    <div class="card-body">
        <h4 class="mb-3">Tambah Barang</h4>
        <form action="../proses/proses-tambah.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="A">Bunga</option>
                    <option value="B">Makanan</option>
                    <option value="C">Uang</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Barang</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
            </div>
            <div class="mb-3">
                <label for="ket" class="form-label">Keterangan</label>
                <textarea class="form-control" id="ket" name="ket" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="simpan">Tambah</button>
        </form>
    </div>
</div>
