<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        /* Menambahkan margin antara foto dan deskripsi album */
        .card-body {
            margin-top: 10px;
        }

        /* Memberi warna teks pada tombol */
        .btn {
            color: white;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="koneksi.php" method="post">
                    <table>
                        <tr>
                            <td>Username</td>
                            <td><input type="text" class="form-control" name="username" required></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" class="form-control" name="password" required></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" class="btn btn-primary" value="Login"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>



    <div class="container mt-4">

        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="album.php">Album</a></li>
            <li class="nav-item"><a class="nav-link active" href="foto.php">Foto</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
        </ul>

        <div class="container">
            <div class="row justify-content-start">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://picsum.photos/552/552" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Example Album 1</h5>
                            <p class="card-text">This is a short description of the album.</p>
                            <a href="#" class="btn btn-primary">Lihat Album</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://picsum.photos/377/377" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Example Album 2</h5>
                            <p class="card-text">This is a short description of the album.</p>
                            <a href="#" class="btn btn-primary">Lihat Album</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://picsum.photos/552/552" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Example Album 3</h5>
                            <p class="card-text">This is a short description of the album.</p>
                            <a href="#" class="btn btn-primary">Lihat Album</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tambahkan baris dan kartu-kartu berikutnya sesuai kebutuhan -->
        <!-- <div class="row justify-content-start">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://picsum.photos/552/552" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Example Album 4</h5>
                        <p class="card-text">This is a short description of the album.</p>
                        <a href="#" class="btn btn-primary">Lihat Album</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://picsum.photos/377/377" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Example Album 5</h5>
                        <p class="card-text">This is a short description of the album.</p>
                        <a href="#" class="btn btn-primary">Lihat Album</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://picsum.photos/552/552" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Example Album 6</h5>
                        <p class="card-text">This is a short description of the album.</p>
                        <a href="#" class="btn btn-primary">Lihat Album</a>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
</body>

</html>