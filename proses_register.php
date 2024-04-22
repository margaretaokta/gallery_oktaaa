<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $namalengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];

    // Gunakan parameterized query
    $stmt = $conn->prepare("INSERT INTO user(username, password, email, nama_lengkap, alamat) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $email, $namalengkap, $alamat);
    if ($stmt->execute()) {
        header("location: login.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi
$conn->close();
