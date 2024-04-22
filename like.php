<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:login.php");
    exit();
}

include "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foto_id = $_POST['foto_id'];
    $user_id = $_SESSION['user_id'];
    $tanggal_like = date("Y-m-d");

    $query = "INSERT INTO likefoto (foto_id, user_id, tanggal_like) VALUES ('$foto_id', '$user_id', '$tanggal_like')";
    mysqli_query($conn, $query);

    header("location:foto.php");
    exit();
}
