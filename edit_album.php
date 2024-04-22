<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album</title>
</head>

<body>
    <h2>Edit Album</h2>
    <?php
    // Koneksi ke database
    $conn = mysqli_connect('localhost', 'root', '', 'gallery_okta');
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Ambil album_id yang dikirimkan melalui URL
    $album_id = $_GET['album_id'];

    // Query untuk mengambil data album berdasarkan album_id
    $query = "SELECT * FROM album WHERE album_id='$album_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    ?>
        <form action="update_album.php" method="post">
            <input type="hidden" name="album_id" value="<?php echo $row['album_id']; ?>">
            <label for="nama_album">Nama Album:</label><br>
            <input type="text" id="nama_album" name="nama_album" value="<?php echo $row['nama_album']; ?>"><br>
            <label for="deskripsi">Deskripsi:</label><br>
            <textarea id="deskripsi" name="deskripsi"><?php echo $row['deskripsi']; ?></textarea><br>
            <input type="submit" value="Simpan">
        </form>
    <?php
    } else {
        echo "Album tidak ditemukan.";
    }

    // Tutup koneksi
    mysqli_close($conn);
    ?>
</body>

</html>