<?php
// Koneksi ke database
include "koneksi.php";


// Ambil data yang dikirimkan melalui form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_album'])) {
    // Pastikan data yang diterima tidak kosong
    $nama_album = isset($_POST['nama_album']) ? mysqli_real_escape_string($conn, $_POST['nama_album']) : '';
    $deskripsi = isset($_POST['deskripsi']) ? mysqli_real_escape_string($conn, $_POST['deskripsi']) : '';

    if (!empty($nama_album) && !empty($deskripsi)) {
        // Tanggal dibuat dapat diambil langsung dari PHP
        $tanggal_dibuat = date('Y-m-d');
        // User ID harus diambil dari session atau form, tergantung dari implementasi
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

        // Query untuk menambahkan data album ke database
        $query = "INSERT INTO album (nama_album, deskripsi, tanggal_dibuat, user_id) VALUES ('$nama_album', '$deskripsi', '$tanggal_dibuat', '$user_id')";
        if (mysqli_query($conn, $query)) {
            echo "Data album berhasil ditambahkan.";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Nama album dan deskripsi harus diisi.";
    }
}


// // Fungsi Read (Select)
// $query = "SELECT * FROM album WHERE user_id = $_SESSION[user_id]";
// $result = mysqli_query($conn, $query);

// Fungsi Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $album_id = $_POST['album_id'];
    $nama_album = $_POST['nama_album'];
    $deskripsi = $_POST['deskripsi'];

    $query = "UPDATE album SET nama_album='$nama_album', deskripsi='$deskripsi' WHERE album_id='$album_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Album berhasil diupdate.";
    } else {
        echo "Gagal mengupdate album: " . mysqli_error($conn);
    }
}



// Fungsi Delete
if (isset($_GET['hapus'])) {
    $album_id = $_GET['hapus'];

    $query = "DELETE FROM album WHERE album_id='$album_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Album berhasil dihapus.";
    } else {
        echo "Gagal menghapus album: " . mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Album</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 40px;
        }

        form {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            text-decoration: none;
            color: #007bff;
        }

        td a:hover {
            text-decoration: underline;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }

        b {
            color: #007bff;
        }
    </style>
</head>

<body>
    <h1>Halaman Album</h1>
    <p>Selamat Datang <b><?= $_SESSION['nama_lengkap'] ?></b></p>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="album.php">Album</a></li>
        <li><a href="foto.php">Foto</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <form action="" method="post">
        <table>
            <tr>
                <td>Nama Album</td>
                <td><input type="text" name="nama_album" required></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><input type="text" name="deskripsi" required></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="tambah" value="Tambah">
                    <input type="submit" name="edit" value="Edit">
                </td>
            </tr>
        </table>
    </form>


    <h2>Daftar Album</h2>
    <table border="1">
        <tr>
            <th>Album ID</th>
            <th>Nama Album</th>
            <th>Deskripsi</th>
            <th>Tanggal Dibuat</th>
            <th>User ID</th>
            <th>Aksi</th>
        </tr>
        <?php
        // Koneksi ke database
        $conn = mysqli_connect('localhost', 'root', '', 'gallery_okta');
        if (!$conn) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        // Query untuk mengambil data album
        $query = "SELECT * FROM album";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            // Periksa apakah album_id terdefinisi sebelum digunakan
            if (isset($row["album_id"])) {
                echo "<tr>";
                echo "<td>" . $row["album_id"] . "</td>";
                echo "<td>" . $row["nama_album"] . "</td>";
                echo "<td>" . $row["deskripsi"] . "</td>";
                echo "<td>" . $row["tanggal_dibuat"] . "</td>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td><a href='edit_album.php?album_id=" . $row["album_id"] . "'>Edit</a> | <a href='hapus_album.php?album_id=" . $row["album_id"] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus album ini?\")'>Hapus</a></td>";

                echo "</tr>";
            } else {
                echo "album_id tidak terdefinisi";
            }
        }

        // Tutup koneksi
        mysqli_close($conn);
        ?>
    </table>
</body>

</html>