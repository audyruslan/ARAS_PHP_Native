<?php
session_start();
require '../functions.php';

function tambah($data)
{
    global $conn;

    // Detail Data Siswa
    $nama_siswa = htmlspecialchars($data['nama_siswa']);

    $query = "INSERT INTO tb_alternatif
                VALUES 
				('','$nama_siswa')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//Tambah Data Alternatif
if (isset($_POST["tambah"])) {
    if (tambah($_POST) > 0) {
        $_SESSION['status'] = "Data Alternatif";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Ditambahkan!";
        header("Location: ../data-alternatif.php");
    } else {
        $_SESSION['status'] = "Data Alternatif";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Ditambahkan!";
        header("Location: ../data-alternatif.php");
    }
}