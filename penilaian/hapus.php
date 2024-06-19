<?php
session_start();
require '../functions.php';

$alternatif_id = $_GET["alternatif_id"];

// Hapus Data Penilaian
function hapus($alternatif_id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_penilaian WHERE alternatif_id = '$alternatif_id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Penilaian
if (hapus($alternatif_id) > 0) {
    $_SESSION['status'] = "Data Penilaian";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil DiHapus!";
    header("Location: ../data-penilaian.php");
} else {
    $_SESSION['status'] = "Data Penilaian";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal DiHapus!";
    header("Location: ../data-penilaian.php");
}