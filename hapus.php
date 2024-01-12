<?php
include 'conexion.php';

$id = $_GET['id'];

$query = "DELETE FROM mahasiswa WHERE id = $id";
$link->query($query);

header('Location: dashboard.php');
?>
