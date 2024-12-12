<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Daftar Barang</title>
</head>

<body>
    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm8 col-md-6 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <center>
                                    <h1>Daftar Barang</h1>
                                </center>
                                <div class="btn-group d-flex" role="group" aria-label="Basic example">
                                    <a href="../Proses/logout.php" class="btn btn-primary ms-auto">Logout</a>
                                    <a href="tambah_product.php" class="btn btn-success ms-auto">Tambah Data</a>

                                </div>
                                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" method="POST">
                                    <input type="search" name="search" class="form-control form-control-dark" 
                                    placeholder="Search..." aria-label="Search">
                                </form>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Product</th>
                                        <th>Kategori</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Foto</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    <?php
                                    $no = 1;
                                    include "../Proses/tampil-data.php";
                                    include "../Koneksi/koneksi.php";
                                    $search = $_POST['search'] ?? '';
                                    $sql = "SELECT * FROM barang WHERE nama LIKE '%$search%' 
                                    OR kategori LIKE '%$search%'";
                                    $data = mysqli_query($db, $sql);


                                   
                                    

                                    while ($tampil = mysqli_fetch_assoc($data)):
                                    ?>

                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $tampil['id_barang'] ?></td>
                                        <td><?= $tampil['kategori'] ?></td>
                                        <td><?= $tampil['nama'] ?></td>
                                        <td><?= $tampil['harga'] ?></td>
                                        <td><img src="../photo/<?= $tampil['foto'] ?>" class="img-fluid" alt="Foto" style="max-width: 100%; Height:auto;"></td>
                                        <td><?= $tampil['ket'] ?></td>
                                        <td>
                                            <a onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-sm btn-danger mt-2" href="../Proses/delete-data.php?id=<?php echo $tampil['idanggota'] ?>">Hapus</a>
                                            <a onclick="return confirm('Apakah anda yakin mengedit data ini?')" class="btn btn-sm btn-warning mt-2" href="anggota-edit.php?idanggota=<?php echo $tampil['idanggota'] ?>">Edit</a>
                                        </td>
                                    </tr>
                                <?php
                                    endwhile;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>