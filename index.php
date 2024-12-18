<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Little Garden</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #FCD7E2; /* Warna background pink */
        }
        .navbar {
            background-color: #00281C !important; /* Warna hijau untuk navbar */
        }
        .navbar-brand img {
            height: 50px;
            width: 50px; 
            border-radius: 50%; 
            transition: transform 0.3s ease; 
        }
        .navbar-brand img:hover {
            transform: scale(1.3); 
        }
        .nav-link {
            color: white !important; /* Warna teks navbar menjadi putih */
        }
        .nav-link:hover {
            color: #FCD7E2 !important; /* Warna hover teks navbar */
        }
        .btn-link i {
            color: white !important; /* Warna ikon akun dan keranjang */
        }
        .hero {
            position: relative;
            height: 80vh;
            color: white;
        }
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4); 
        }
        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            top: 50%;
            transform: translateY(-50%);
        }
        .hero h1 {
            font-size: 4rem;
            font-weight: bold;
        }
        .hero p {
            font-size: 1.5rem;
        }
        .carousel-item {
        transition: transform 1.5s ease-in-out; /* Transisi lebih halus */
        }
        .product-card img {
            width: 100%; 
            height: 300px; 
            object-fit: cover; 
            border-radius: 8px; 
        }
        .product-card .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .product-card:hover {
            transform: scale(1.1); /* Membesar */
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2); /* Menambahkan bayangan */
        }

        .footer {
            background-color: #00281C;
            padding: 20px 0;
            text-align: center;
            color: white;
            
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="photo-content/logo.JPEG" alt="Sweet Little Garden"> 
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop-all.php">Shop All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Occasions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="proses/order.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="hero" style="background: url('photo-content/hero1.jpeg') no-repeat center center/cover;">
                    <div class="hero-overlay"></div>
                    <div class="hero-content text-white">
                        <h1>Sweet Little Garden</h1>
                        <p>Your Destination for Premium Floral Arrangements</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero" style="background: url('photo-content/hero2.jpeg') no-repeat center center/cover;">
                    <div class="hero-overlay"></div>
                    <div class="hero-content text-white">
                        <h1>Beautiful Flowers</h1>
                        <p>Perfect for Every Occasion</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="hero" style="background: url('photo-content/hero3.jpeg') no-repeat center center/cover;">
                    <div class="hero-overlay"></div>
                    <div class="hero-content text-white">
                        <h1>Unique Arrangements</h1>
                        <p>Handcrafted with Love</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            include "koneksi/koneksi.php"; 
            $search = $_POST['search'] ?? '';
            $sql = "SELECT * FROM barang WHERE nama LIKE '%$search%' OR kategori LIKE '%$search%' LIMIT 4";
            $data = mysqli_query($db, $sql);

            while ($product = mysqli_fetch_assoc($data)) {
                echo '
                <div class="col">
                    <div class="card product-card">
                        <img src="photo/' . htmlspecialchars($product['foto']) . '" class="card-img-top" alt="' . htmlspecialchars($product['nama']) . '">
                        <div class="card-body text-center">
                            <h5 class="card-title">' . htmlspecialchars($product['nama']) . '</h5>
                            <p class="text-muted">Rp ' . number_format($product['harga'], 2, ',', '.') . '</p>
                        </div>
                    </div>
                </div>
                ';
            }
            ?>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Sweet Little Garden. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
