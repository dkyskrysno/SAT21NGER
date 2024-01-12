<?php

    session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>

<!-- update.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <link
      rel="icon"
      type="image/x-icon"
      href="resource/logo.png"
    />
    <style>
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

        #preview {
            max-width: 100px;
            margin-top: 10px;
        }
    </style>
    <script>
        // Fungsi JavaScript untuk menampilkan pratinjau foto yang dipilih
        function previewPhoto() {
            var input = document.getElementById('foto');
            var preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
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
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $fakultas = $_POST['fakultas'];
    $alamat = $_POST['alamat'];
    $mahasiswa['foto'] = $foto_path;

    // Periksa apakah file foto baru diupload
    if (!empty($_FILES['foto']['name'])) {
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

        $foto_path = $uploadDirectory . $foto; // Path lengkap ke file foto baru
    } else {
        // Jika foto tidak diubah, gunakan foto yang sudah ada di database
        $foto_path = $_POST['existing_foto'];
    }

    $query = "UPDATE mahasiswa SET nama='$nama', nim='$nim', jurusan='$jurusan', fakultas='$fakultas', alamat='$alamat', foto='$foto_path' WHERE id=$id";
    $link->query($query);

    header('Location: dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $link->query("SELECT * FROM mahasiswa WHERE id=$id");
    $mahasiswa = $result->fetch_assoc();
}
?>

<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $mahasiswa['id']; ?>">
    
    <label for="nama">Nama:</label>
    <input type="text" id="nama" name="nama" value="<?php echo $mahasiswa['nama']; ?>" required>

    <label for="nim">NIM:</label>
    <input type="text" id="nim" name="nim" value="<?php echo $mahasiswa['nim']; ?>" required>

    <label for="jurusan">Jurusan:</label>
    <input type="text" id="jurusan" name="jurusan" value="<?php echo $mahasiswa['jurusan']; ?>" required>

    <label for="fakultas">Fakultas:</label>
    <input type="text" id="fakultas" name="fakultas" value="<?php echo $mahasiswa['fakultas']; ?>" required>

    <label for="alamat">Alamat:</label>
    <input type="text" id="alamat" name="alamat" value="<?php echo $mahasiswa['alamat']; ?>" required>

    <label for="foto">Foto</label>
    <input type="file" name="foto" id="foto" onchange="previewPhoto()">
    <?php
    // Tampilkan foto yang diperbarui segera setelah diunggah
    if (!empty($mahasiswa['foto'])) {
        echo '<img id="preview" src="' . $mahasiswa['foto'] . '" alt="Foto Diperbarui" style="max-width: 100px;"><br>';
    } else {
        // Tampilkan tag gambar kosong untuk pratinjau
        echo '<img id="preview" alt="Pratinjau" style="max-width: 200px;"><br>';
    }
    ?>
    <input type="hidden" name="existing_foto" value="<?php echo $mahasiswa['foto']; ?>">


    <button type="submit">Update Mahasiswa</button>
</form>

<script>
    <?php
    // Periksa apakah formulir telah dikirim dan pembaruan berhasil
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
        echo 'alert("Data Mahasiswa berhasil diperbarui!");';
    }
    ?>
</script>

</body>
</html>
