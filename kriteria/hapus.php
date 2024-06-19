<?php
session_start();
require '../functions.php';

$kriteria_id = $_GET["kriteria_id"];

// Hapus Data Kriteria
function hapus($kriteria_id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_kriteria WHERE kriteria_id = '$kriteria_id'");
    return mysqli_affected_rows($conn);
}

// Hapus Data Kriteria
if (hapus($kriteria_id) > 0) {
    $_SESSION['status'] = "Data Kriteria";
    $_SESSION['status_icon'] = "success";
    $_SESSION['status_info'] = "Berhasil DiHapus!";
    header("Location: ../data-kriteria.php");
} else {
    $_SESSION['status'] = "Data kriteria";
    $_SESSION['status_icon'] = "error";
    $_SESSION['status_info'] = "Gagal DiHapus!";
    header("Location: ../data-kriteria.php");
}