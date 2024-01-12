<?php

    session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <link
      rel="icon"
      type="image/x-icon"
      href="resource/logo.png"
    />

    <style>
    nav {
            background-color: #333;
            overflow: hidden;
            margin-top: -20px;
            margin-left: -20px;
            margin-right: -20px;

        }

        nav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar-right {
            float: right;
        }
        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<nav>
    <!-- <a href="#">Home</a> -->
    <a href="dashboard.php">Dashboard</a>
    <a href="tambah.php">Tambah Mahasiswa</a>
</nav><br><br>

<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $fakultas = $_POST['fakultas'];
    $alamat = $_POST['alamat'];

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    $uploadDirectory = 'gambar/'; // Tentukan direktori upload Anda

    // Periksa apakah file berhasil diupload
    if (move_uploaded_file($tmp, $uploadDirectory . $foto)) {
        echo 'File berhasil diupload.';
        // Sekarang Anda dapat menyimpan nama file atau pathnya di database atau melakukan operasi lainnya
    } else {
        echo 'Gagal mengupload file.Error: ' . $_FILES['foto']['error'];
    } 

    $foto_path = $uploadDirectory . $foto; // Path lengkap ke file foto

    $query = "INSERT INTO mahasiswa (nama, nim, jurusan, fakultas, alamat, foto) VALUES ('$nama', '$nim', '$jurusan', '$fakultas', '$alamat', '$foto_path')";
    $link->query($query);

    header('Location: dashboard.php');
}
?>


<form method="POST" action="" enctype="multipart/form-data">
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" required>

    <label for="nim">NIM:</label>
    <input type="text" id="nim" name="nim" required>

    <label for="jurusan">Jurusan:</label>
    <input type="text" id="jurusan" name="jurusan" required>

    <label for="fakultas">Fakultas:</label>
    <input type="text" id="fakultas" name="fakultas" required>

    <label for="alamat">Alamat:</label>
    <input type="text" id="alamat" name="alamat" required>

    <label for="foto">Foto</label>
    <input type="file" name="foto" id="foto" onchange="previewImage(event)">
    <img id="image-preview" src="#" alt="Preview" style="display: none; widht:100px; height:100px;">


    <button type="submit">Tambah Mahasiswa</button>
</form>
<script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById('image-preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</body>
</html>
