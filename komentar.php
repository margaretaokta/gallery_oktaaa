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
    $isi_komentar = mysqli_real_escape_string($conn, $_POST['isi_komentar']);
    $tanggal_komentar = date("Y-m-d");

    $query = "INSERT INTO komentarfoto (foto_id, user_id, isi_komentar, tanggal_komentar) VALUES ('$foto_id', '$user_id', '$isi_komentar', '$tanggal_komentar')";
    mysqli_query($conn, $query);

    header("location:foto.php");
    exit();
}
