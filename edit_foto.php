<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit Foto</title>
</head>

<body>
    <h1>Halaman Edit Foto</h1>
    <p>Selamat datang <b><?= $_SESSION['namalengkap'] ?></b></p>

    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="album.php">Album</a></li>
        <li><a href="foto.php">Foto</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <form action="update_foto.php" method="post" enctype="multipart/form-data">
        <?php
        include "koneksi.php";
        $fotoid = $_GET['fotoid'];
        $sql = mysqli_query($conn, "select * from foto where foto_id='$fotoid'");
        while ($data = mysqli_fetch_array($sql)) {
        ?>
            <input type="text" name="fotoid" value="<?= $data['foto_id'] ?>" hidden>
            <table>
                <tr>
                    <td>Judul</td>
                    <td><input type="text" name="judulfoto" value="<?= $data['judul_foto'] ?>"></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><input type="text" name="deskripsifoto" value="<?= $data['deskripsi_foto'] ?>"></td>
                </tr>
                <tr>
                    <td>Lokasi File</td>
                    <td><input type="file" name="lokasifile"></td>
                </tr>
                <tr>
                    <td>Album</td>
                    <td>
                        <select name="albumid">
                            <?php
                            $userid = $_SESSION['userid'];
                            $sql2 = mysqli_query($conn, "select * from album where user_id='$userid'");
                            while ($data2 = mysqli_fetch_array($sql2)) {
                            ?>
                                <option value="<?= $data2['album_id'] ?>" <?php if ($data2['album_id'] == $data['album_id']) {
                                                                            echo 'selected';
                                                                        } ?>><?= $data2['nama_album'] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Ubah"></td>
                </tr>
            </table>
        <?php
        }
        ?>
    </form>


</body>

</html>