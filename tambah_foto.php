<?php
include "koneksi.php";
session_start();

$judulfoto = isset($_POST['judul_foto']) ? mysqli_real_escape_string($conn, $_POST['judul_foto']) : '';
$deskripsifoto = isset($_POST['deskripsi_foto']) ? mysqli_real_escape_string($conn, $_POST['deskripsi_foto']) : '';
$tanggalunggah = date("Y-m-d");
$userid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$albumid = isset($_POST['album_id']) ? $_POST['album_id'] : '';

$ekstensi =  array('png', 'jpg', 'jpeg', 'gif');
$gambar = array();
foreach ($_FILES['lokasi_file']['tmp_name'] as $key => $tmp_name) {
    $filename = $_FILES['lokasi_file']['name'][$key];
    $ukuran = $_FILES['lokasi_file']['size'][$key];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (in_array($ext, $ekstensi) && $ukuran < 1044070) {
        $rand = rand();
        $xx = $rand . '_' . $filename;
        move_uploaded_file($tmp_name, 'gambar/' . $rand . '_' . $filename);
        $gambar[] = $xx;
    }
}

foreach ($gambar as $file) {
    // Cek apakah album yang dipilih sudah ada atau belum
    $checkAlbum = mysqli_query($conn, "SELECT * FROM album WHERE album_id='$albumid' AND user_id='$userid'");
    if (mysqli_num_rows($checkAlbum) > 0) {
        mysqli_query($conn, "INSERT INTO foto (judul_foto, deskripsi_foto, tanggal_unggah, lokasi_file, album_id, user_id) VALUES ('$judulfoto', '$deskripsifoto', '$tanggalunggah', '$file', '$albumid', '$userid')");
    }
}

header("location:foto.php");
