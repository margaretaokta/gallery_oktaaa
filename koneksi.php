<?php
// Memulai session jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'gallery_okta');
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_foto'])) {
    $judul_foto = isset($_POST['judul_foto']) ? mysqli_real_escape_string($conn, $_POST['judul_foto']) : '';
    $deskripsi_foto = isset($_POST['deskripsi_foto']) ? mysqli_real_escape_string($conn, $_POST['deskripsi_foto']) : '';
    $tanggal_unggah = date('Y-m-d');
    $lokasi_file = isset($_POST['lokasi_file']) ? mysqli_real_escape_string($conn, $_POST['lokasi_file']) : '';
    $album_id = isset($_POST['album_id']) ? $_POST['album_id'] : '';
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

    $query = "INSERT INTO foto (judul_foto, deskripsi_foto, tanggal_unggah, lokasi_file, album_id, user_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ssssii', $judul_foto, $deskripsi_foto, $tanggal_unggah, $lokasi_file, $album_id, $user_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Data foto berhasil ditambahkan.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

// Ambil data yang dikirimkan melalui form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan data yang diterima tidak kosong
    $nama_album = isset($_POST['nama_album']) ? mysqli_real_escape_string($conn, $_POST['nama_album']) : '';
    $deskripsi = isset($_POST['deskripsi']) ? mysqli_real_escape_string($conn, $_POST['deskripsi']) : '';
    // Tanggal dibuat dapat diambil langsung dari PHP
    $tanggal_dibuat = date('Y-m-d');
    // User ID harus diambil dari session atau form, tergantung dari implementasi
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

    // Query untuk menambahkan data album ke database
    $query = "INSERT INTO album (nama_album, deskripsi, tanggal_dibuat, user_id) VALUES ('$nama_album', '$deskripsi', '$tanggal_dibuat', '$user_id')";
    if (mysqli_query($conn, $query)) {
        echo "";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Cek apakah form login telah disubmit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data yang dikirimkan melalui form
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Query untuk mencari user berdasarkan username dan password
            $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
            $result = mysqli_query($conn, $query);

            // Jika data ditemukan, set session dan redirect ke halaman utama
            if ($result && mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                header('Location: index.php');
                exit;
            } else {
                // Jika data tidak ditemukan, tampilkan pesan error
                echo "Username atau password salah.";
                exit;
            }
        }
    }
}
