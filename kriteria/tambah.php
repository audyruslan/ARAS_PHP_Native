<?php
session_start();
require '../functions.php';

function tambah($data)
{
    global $conn;

    // Detail Data Kriteria
    $kode_kriteria = htmlspecialchars($data['kode_kriteria']);
    $kriteria = htmlspecialchars($data['kriteria']);
    $nilai_kriteria = htmlspecialchars($data['nilai_kriteria']);

    $query = "INSERT INTO tb_kriteria
                VALUES 
				('','$kode_kriteria','$kriteria','$nilai_kriteria')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//Tambah Data Kriteria
if (isset($_POST["tambah"])) {
    if (tambah($_POST) > 0) {
        $_SESSION['status'] = "Data Kriteria";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Ditambahkan!";
        header("Location: ../data-kriteria.php");
    } else {
        $_SESSION['status'] = "Data Kriteria";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Ditambahkan!";
        header("Location: ../data-kriteria.php");
    }
}
