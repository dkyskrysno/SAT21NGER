<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sat21nger</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="styles.css">
    <link
      rel="icon"
      type="image/x-icon"
      href="resource/logo.png"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .gambar-mahasiswa {
            border-radius: 50%;
        }
        body {
            font-family: Arial, sans-serif;
            /* margin: 20px; */
        }
        table {
            width: 97%;
            border-collapse: collapse;
            /* background-color:red; */
            margin: 20px;
           
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
        }
    </style>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
<section class="hero__section">
      <header>
        <nav class="navbar">
          <img src="resource/logo.png" alt="Logo" width="50" height="50">
          <div class="navbar__menu_container">
            <a href="index.php" class="link">Home</a>
            <a href="index.php" class="link">About</a>
            <a href="index.php" class="link">Collection</a>
            <a href="index.php" class="link">Contact</a>
            <a href="read.php" class="link">Data</a>
            <a href="team/team.html" class="link" target="_blank">Teams</a>
            <a href="login.php" class="link" target="_blank">Login</a>
            <a href="register.php" class="link" target="_blank">Sign Up</a>
            <a href="#" class="user__icon">
              <i class="fa-solid fa-user"></i>
            </a>
          </div>
        </nav>
      </header>
      <div class="hero__section_container">
        <img
          class="hero__section_logo"
          src="resource/sat2.png"
          alt="Sat21nger Logo"
        />
        <h1 class="hero__section_title">
          Sturdy Aware of The 2estful and 1Ncredible GEneRation
        </h1>
      </div>
    </section>

<?php
include 'conexion.php';

$query = "SELECT * FROM mahasiswa";
$result = $link->query($query);
?>

<br><br><table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Fakultas</th>
            <th>Alamat</th>
            <th>Gambar</th>
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
    </tr>
<?php endwhile; ?>
    </tbody>
</table>

<script>
      feather.replace();
    </script>
</body>
</html>
