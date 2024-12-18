<?php
session_start();
include '../koneksi/koneksi.php';

// Periksa sesi login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}


// Ambil parameter halaman dari URL (default ke dashboard)
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sweet Litle Garden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            min-height: 100vh;
        }
        .sidebar .nav-link {
            color: white;
            margin: 5px 0;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
        }
        .main-content {
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar">
            <div class="p-4">
                <h4>Admin Dashboard</h4>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=tambah_barang"><i class="fas fa-box"></i> Tambah Barang</a>
                    </li>
                    <?php if ($_SESSION['posisi'] === 'owner'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=tambah_admin"><i class="fas fa-user-plus"></i> Tambah Admin</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../proses/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-10 main-content">
            <?php
            // Jika halaman bukan tambah_barang atau tambah_admin
            if ($page === 'dashboard'):
                ?>
                <h2>Daftar Barang</h2>
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($db, "SELECT * FROM barang");
                    while ($row = mysqli_fetch_assoc($query)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['id_barang'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            
                            <td>
                                <img src="../photo/<?= $row['foto'] ?>" alt="Foto" class="img-fluid" style="max-height: 100px;">
                            </td>
                            <td>
                                <a href="index.php?page=edit_barang&id_barang=<?= $row['id_barang'] ?>" class="btn btn-warning btn-sm" onclick="return confirm('Apakah anda yakin ingin meng edit data ini?')">Edit</a>
                                <a href="../proses/hapus-barang.php?id_barang=<?= $row['id_barang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            <?php
            // Halaman Tambah Barang
            elseif ($page === 'tambah_barang' && file_exists("tambah-barang.php")):
                include "tambah-barang.php";
            // Halaman Edit Barang
            elseif ($page === 'edit_barang' && file_exists("edit-barang.php")):
                include "edit-barang.php";
            
            // Halaman Tambah Admin
            elseif ($page === 'tambah_admin' && $_SESSION['posisi'] === 'owner' && file_exists("tambah-admin.php")):
                include "tambah-admin.php";
            
            else:
                echo "<h4>Halaman tidak ditemukan atau Anda tidak memiliki akses!</h4>";
            endif;
            ?>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
