<?php
include "koneksi.php";
session_start();

$fotoid = $_GET['foto_id'];

$sql = mysqli_query($conn, "delete from foto where foto_id='$fotoid'");

header("location:foto.php");
