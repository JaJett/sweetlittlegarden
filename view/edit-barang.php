<div class="card">
    <div class="card-body">
        <h4 class="mb-3">Edit Barang</h4>
        <?php
            include '../Koneksi/koneksi.php';
        
            $id = $_GET['id_barang'];
            $qry = "SELECT * FROM barang WHERE id_barang='$id'";
            $data = mysqli_query($db, $qry);
            $tampil = mysqli_fetch_assoc($data);
                if(empty($tampil['foto'])or($tampil['foto']=='-'))
                    $foto = "admin-no-foto.jpg";
                else{
                    $foto = $tampil['foto'];
                }
   
        ?>

        
        <form action="../proses/proses-edit.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_barang" value="<?= $tampil['id_barang'] ?>">
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori" required>
                    <option value="A" <?= $tampil['kategori'] === 'A' ? 'selected' : '' ?>>Bunga</option>
                    <option value="B" <?= $tampil['kategori'] === 'B' ? 'selected' : '' ?>>Makanan</option>
                    <option value="C" <?= $tampil['kategori'] === 'C' ? 'selected' : '' ?>>Uang</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $tampil['nama'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?= $tampil['harga'] ?>" required>
            </div>
            <div class="mb-3">
                <div class="foto-preview">
                    <label for="foto" class="form-label">Foto Barang (Opsional)</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                    <small>Biarkan kosong jika tidak ingin mengubah foto</small>
                    <div class="foto-box">
                        <p>Foto saat ini:</p>   
                        <img src="../photo/<?= $tampil['foto'] ?>" alt="Foto Barang" class="img-fluid" style="max-height: 100px;">
                        <input type="hidden" name="foto_awal" value="<?= $tampil['foto'] ?>" >
                    </div>  
                </div>
            </div>
            <div class="mb-3">
                <label for="ket" class="form-label">Keterangan</label>
                <textarea class="form-control" id="ket" name="ket" rows="3"><?= $tampil['ket'] ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="update" onclick="return confirm('Apakah anda yakin ingin meng edit data ini?')">Simpan Perubahan</button>
        </form>
    </div>
</div>
