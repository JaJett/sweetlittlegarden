<?php
    include '../koneksi/koneksi.php'; 
   
    function generateIdBarang($kategori, $db){
        //cari id barang berdasarkan kategori

        $sql = "SELECT id_barang FROM barang WHERE kategori = '$kategori' ORDER BY id_barang DESC LIMIT 1";
        $result = $db->query($sql);

        if($result->num_rows > 0){
            //ambil id terakhir
            $row = $result->fetch_assoc();
            $lastId = $row['id_barang']; // contoh 3
            $number = (int)substr($lastId, 1); // ambil angka (003 -> 3)
            $newNumber = $number + 1; // tambahkan angka 1
            return $kategori . str_pad($newNumber, 3, '0', STR_PAD_LEFT); // format baru, contoh : 004
        }else{
            return $kategori . "001";
        }
    }
    $kategori = $_POST['kategori']; // memasukkan A,B atau C
    $id_barang = generateIdBarang($kategori, $db);
   
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $ket = $_POST['ket'];   


    if(isset($_POST['simpan'])){
        extract($_POST);
         // generate id barang     
        $foto = $_FILES['foto']['name'];
        //upload foto
        if(!empty($foto)){
            //baca lokasi file sementara dan nama file dari form(upload)
            $lokasi_file = $_FILES['foto']['tmp_name'];
            $tipe_file = pathinfo($foto, PATHINFO_EXTENSION);
            $file_foto = $id_barang . "." . $tipe_file;

            //Tentukan folder unutk menyimpan file
            $folder = "../photo/$file_foto";
            //Apabila file berhasil di upload
            move_uploaded_file($lokasi_file, "$folder");
        }else{
            $file_foto = '-';
        }

       

        $sql = "INSERT INTO barang VALUES ('$id_barang', '$kategori', '$nama', '$harga', '$file_foto', '$ket')";

        if($db->query($sql) === TRUE){
            header("location:../view/index.php");
        }else{
            echo "Error: " . $sql. "<br>". $db->error;
        }
    }


?>