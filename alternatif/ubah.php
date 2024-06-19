<?php
session_start();
require '../functions.php';

function ubah($data)
{
    global $conn;
    $alternatif_id = $data["alternatif_id"];

    // Detail Data Siswa
    $nama_siswa = htmlspecialchars($data['nama_siswa']);

    $query = "UPDATE tb_alternatif
                SET
				nama_siswa = '$nama_siswa'
                WHERE alternatif_id = $alternatif_id
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Ubah Data Alternatif
if (isset($_POST["ubah"])) {
    if (ubah($_POST) > 0) {
        $_SESSION['status'] = "Data Alternatif";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah!";
        header("Location: ../data-alternatif.php");
    } else {
        $_SESSION['status'] = "Data Alternatif";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah!";
        header("Location: ../data-alternatif.php");
    }
}