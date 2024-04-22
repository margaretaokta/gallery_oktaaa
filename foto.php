<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:login.php");
    exit();
}

include "koneksi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_foto = mysqli_real_escape_string($conn, $_POST['judul_foto']);
    $deskripsi_foto = mysqli_real_escape_string($conn, $_POST['deskripsi_foto']);
    $album_id = $_POST['album_id'];
    $tanggal_unggah = date("Y-m-d");
    $user_id = $_SESSION['user_id'];

    $file_name = $_FILES['lokasi_file']['name'];
    $file_tmp = $_FILES['lokasi_file']['tmp_name'];
    $file_size = $_FILES['lokasi_file']['size'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($file_ext, $allowed_ext) && $file_size < 1044070) {
        $lokasi_file = 'gambar/' . uniqid() . '.' . $file_ext;
        move_uploaded_file($file_tmp, $lokasi_file);

        // Cek apakah album sudah ada
        $album_query = mysqli_query($conn, "SELECT * FROM album WHERE album_id='$album_id' AND user_id='$user_id'");
        if (mysqli_num_rows($album_query) > 0) {
            $query = "INSERT INTO foto (judul_foto, deskripsi_foto, tanggal_unggah, lokasi_file, album_id, user_id) 
                      VALUES ('$judul_foto', '$deskripsi_foto', '$tanggal_unggah', '$lokasi_file', '$album_id', '$user_id')";
            mysqli_query($conn, $query);
        } else {
            // Tampilkan pesan error jika album tidak ditemukan
            echo "<script>alert('Album tidak ditemukan');</script>";
        }

        header("location:foto.php");
        exit();
    } else {
        // Tampilkan pesan error jika file tidak sesuai
        echo "<script>alert('File tidak sesuai');</script>";
        header("location:foto.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Halaman Foto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            background-color: #333;
            overflow: hidden;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: green;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="file"],
        input[type="submit"] {
            margin-bottom: 10px;
            padding: 5px;
        }

        /* CSS untuk animasi mengambang */
        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        /* CSS untuk menerapkan animasi mengambang */
        .float-animation {
            animation: float 0.5s ease-in-out;
        }
    </style>

</head>

<body>

    <div class="container mt-4">
        <h1>Halaman Foto</h1>
        <p>Selamat datang <b><?= $_SESSION['nama_lengkap'] ?></b></p>

        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
            <li class="nav-item"><a class="nav-link active" href="foto.php">Foto</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>

        <form action="foto.php" method="post" enctype="multipart/form-data" class="mt-4" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="judul_foto" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul_foto" name="judul_foto" required>
            </div>
            <div class="mb-3">
                <label for="deskripsi_foto" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi_foto" name="deskripsi_foto" required>
            </div>
            <div class="mb-3">
                <label for="lokasi_file" class="form-label">Lokasi File</label>
                <input type="file" class="form-control float-animation" id="lokasi_file" name="lokasi_file" required>
            </div>
            <div class="mb-3">
                <label for="album_id" class="form-label">Album</label>
                <select class="form-select" id="album_id" name="album_id" required>
                    <option value="">Pilih Album</option>
                    <?php
                    $user_id = $_SESSION['user_id'];
                    $sql = mysqli_query($conn, "SELECT * FROM album WHERE user_id='$user_id'");
                    while ($data = mysqli_fetch_array($sql)) {
                        echo "<option value='{$data['album_id']}'>{$data['nama_album']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </form>

        <div class="row">
            <?php
            $user_id = $_SESSION['user_id'];
            $sql = mysqli_query($conn, "SELECT * FROM foto WHERE user_id='$user_id'");
            while ($data = mysqli_fetch_array($sql)) {
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo $data['lokasi_file']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['judul_foto']; ?></h5>
                            <p class="card-text"><?php echo $data['deskripsi_foto']; ?></p>
                            <p class="card-text"><small class="text-muted">Tanggal Unggah: <?php echo $data['tanggal_unggah']; ?></small></p>
                            <p class="card-text">Album: <?php echo $data['album_id']; ?></p>
                            <p class="card-text">Disukai:
                                <?php
                                $foto_id = $data['foto_id'];
                                $sql2 = mysqli_query($conn, "SELECT * FROM likefoto WHERE foto_id='$foto_id'");
                                echo mysqli_num_rows($sql2);
                                ?>
                            </p>
                            <style>
                                .btn-group {
                                    display: flex;
                                    flex-wrap: wrap;
                                    gap: 5px;
                                }

                                .btn-group form {
                                    margin-right: 5px;
                                }

                                .mt-3 {
                                    margin-top: 15px;
                                }
                            </style>

                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href='hapus_foto.php?foto_id=<?= $data['foto_id'] ?>' onclick='return confirm("Apakah Anda yakin ingin menghapus foto ini?")' class='btn btn-danger'>Hapus</a>
                                <a href='edit_foto.php?foto_id=<?= $data['foto_id'] ?>' class='btn btn-primary'>Edit</a>
                                <form action="like.php" method="post">
                                    <input type="hidden" name="foto_id" value="<?= $data['foto_id'] ?>">
                                    <button type="submit" class="btn btn-primary">Like</button>
                                </form>
                                <form action="komentar.php" method="post">
                                    <input type="hidden" name="foto_id" value="<?= $data['foto_id'] ?>">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="isi_komentar" placeholder="Tambahkan komentar" aria-label="Tambahkan komentar" aria-describedby="button-addon2" required>
                                        <button class="btn btn-primary" type="submit" id="button-addon2">Komentar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-3">
                                <h5>Komentar:</h5>
                                <?php
                                $foto_id = $data['foto_id'];
                                $sql3 = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE foto_id='$foto_id'");
                                while ($komentar = mysqli_fetch_array($sql3)) {
                                    echo "<p><b>{$komentar['user_id']}</b>: {$komentar['isi_komentar']} - {$komentar['tanggal_komentar']}</p>";
                                }
                                ?>
                            </div>

                            <div class="mt-3">
                                <h5>Komentar:</h5>
                                <?php
                                $foto_id = $data['foto_id'];
                                $sql3 = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE foto_id='$foto_id'");
                                while ($komentar = mysqli_fetch_array($sql3)) {
                                    echo "<p><b>{$komentar['user_id']}</b>: {$komentar['isi_komentar']} - {$komentar['tanggal_komentar']}</p>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>


    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            var judul = document.getElementById('judul_foto').value;
            var deskripsi = document.getElementById('deskripsi_foto').value;
            var lokasi_file = document.getElementById('lokasi_file').value;
            var album_id = document.getElementById('album_id').value;

            if (judul.trim() == '' || deskripsi.trim() == '' || lokasi_file.trim() == '' || album_id.trim() == '') {
                alert('Semua kolom harus diisi');
                return false;
            }
            return true;
        }
    </script>

</body>

</html>