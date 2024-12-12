<?php
session_start();
include '../koneksi/koneksi.php'; // Koneksi ke database

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: ../login/login.php');
    exit;
}

// Menangani form tambah barang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_barang'])) {
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO barang (nama_barang, harga, stok) VALUES ('$nama_barang', '$harga', '$stok')";

    if (mysqli_query($db, $sql)) {
        $barang_message = "Barang berhasil ditambahkan!";
    } else {
        $barang_message = "Error: " . mysqli_error($db);
    }
}

// Menangani form registrasi (hanya untuk owner)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register']) && $_SESSION['posisi'] === 'owner') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    $posisi = $_POST['posisi']; // owner atau admin

    $sql = "INSERT INTO admin (nama, username, password, posisi) VALUES ('$nama', '$username', '$password', '$posisi')";

    if (mysqli_query($db, $sql)) {
        $user_message = "Admin berhasil didaftarkan!";
    } else {
        $user_message = "Error: " . mysqli_error($db);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
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

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
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
                            <a class="nav-link" href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-box"></i> Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../proses/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Dashboard</h2>
                </div>

                <!-- Statistik dan Barang -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4>Data Barang</h4>
                                <?php if (isset($barang_message)): ?>
                                    <div class="alert alert-info"><?= $barang_message ?></div>
                                <?php endif; ?>
                                <form method="post" action="../proses/proses_tambah.php" enctype="multipart/form-data">
                                <div class="row g-2 align-items-center">
                                    <!-- Input Kategori -->
                                    <div class="col-md-2">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select class="form-select" id="kategori" name="kategori" required>
                                            <option value="A">Bunga</option>
                                            <option value="B">Makanan</option>
                                            <option value="C">Uang</option>
                                        </select>
                                    </div>

                                    <!-- Input Nama Barang -->
                                    <div class="col-md-2">
                                        <label for="nama" class="form-label">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang" required>
                                    </div>

                                    <!-- Input Harga -->
                                    <div class="col-md-2">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang" required>
                                    </div>

                                    <!-- Input Foto -->
                                    <div class="col-md-3">
                                        <label for="foto" class="form-label">Foto Barang</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>

                                    <!-- Input Keterangan -->
                                    <div class="col-md-2">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" rows="1" name="ket" placeholder="Keterangan Barang"></textarea>
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="col-md-1">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="submit" name="simpan" class="btn btn-primary w-100">Tambah</button>
                                    </div>
                                </div>
                            </form>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $result = mysqli_query($db, "SELECT * FROM barang");
                                        while ($row = mysqli_fetch_assoc($result)): ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['nama'] ?></td>
                                                <td><?= $row['harga'] ?></td>
                                                <td><img src="../photo/<?= $row['foto'] ?>" class="img-fluid" alt="Foto" style="max-width: 100%; Height:150px;"></td>
                                                <td>
                                                    <a href="" class="btn btn-warning btn-sm">Edit</a>
                                                    <a href="../proses/hapus-barang.php?id_barang=<?= $row['id_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Register Form (Owner Only) -->
                <?php if ($_SESSION['posisi'] === 'owner'): ?>
                    <div class="card mt-4">
                        <div class="card-body">
                            <h4>Register Admin/User</h4>
                            <?php if (isset($user_message)): ?>
                                <div class="alert alert-info"><?= $user_message ?></div>
                            <?php endif; ?>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="posisi" class="form-label">Posisi</label>
                                    <select class="form-select" id="posisi" name="posisi" required>
                                        <option value="owner">Owner</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <button type="submit" name="register" class="btn btn-primary">Register</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
