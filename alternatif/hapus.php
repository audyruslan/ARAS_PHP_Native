<?php
session_start();
require '../functions.php';

$alternatif_id = $_GET["alternatif_id"];

// Hapus Data Alternatif
function hapus($alternatif_id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_alternatif WHERE alternatif_id = '$alternatif_id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Alternatif
if (hapus($alternatif_id) > 0) {
    $_SESSION['status'] = "Data Alternatif";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil DiHapus!";
    header("Location: ../data-alternatif.php");
} else {
    $_SESSION['status'] = "Data Alternatif";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal DiHapus!";
    header("Location: ../data-alternatif.php");
}
