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
    <title>CRUD Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <link
      rel="icon"
      type="image/x-icon"
      href="resource/logo.png"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Gaya untuk tombol tambah */
        .tombol-tambah {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-bottom: 30px; /* Jarak antara tombol dan tabel */
        }

        .tombol-tambah:hover {
            background-color: #45a049;
        }

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

        /* Gaya untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .gambar-mahasiswa {
            border-radius: 50%;
        }
        .disclamer {
            width: 90%;
            text-align: center;
            margin: auto;
            padding: 20px 0;
            font-size: 12px;
            color: gray;
            border-top: 1px solid gray;
            bottom: 0px;
        }
    </style>
</head>
<body>
<nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="tambah.php">Tambah Mahasiswa</a>
    <a href="cerrar-sesion.php" class="navbar-right close-sesion">Log Out</a>
</nav><br><br>

<?php
include 'conexion.php';

$query = "SELECT * FROM mahasiswa";
$result = $link->query($query);
?>

<!-- Tombol Tambah untuk menuju tambah.php -->
<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Fakultas</th>
            <th>Alamat</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nim']; ?></td>
            <td><?= $row['jurusan']; ?></td>
            <td><?= $row['fakultas']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><img src="<?=$row['foto']; ?>" class="gambar-mahasiswa" alt="Foto Mahasiswa" style="width:50px; height:50px;"></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>"><i class="fas fa-edit"></i></a>
                <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<footer>
    <p class="disclamer">
        Firman Reski Ramadhan - Dikcy Sukkrysno - Yusril Mahendra
      </p>
</footer>
</body>
</html>
