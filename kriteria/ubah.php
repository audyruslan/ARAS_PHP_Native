<?php
session_start();
require '../functions.php';

function ubah($data)
{
    global $conn;
    $kriteria_id = $data["kriteria_id"];

    // Detail Data Kriteria
    $kode_kriteria = htmlspecialchars($data['kode_kriteria']);
    $kriteria = htmlspecialchars($data['kriteria']);
    $nilai_kriteria = htmlspecialchars($data['nilai_kriteria']);


    $query = "UPDATE tb_kriteria
                SET
				kode_kriteria = '$kode_kriteria',
				kriteria = '$kriteria',
				nilai_kriteria = '$nilai_kriteria'
                WHERE kriteria_id = $kriteria_id
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// Ubah Data Kriteria
if (isset($_POST["ubah"])) {
    if (ubah($_POST) > 0) {
        $_SESSION['status'] = "Data Kriteria";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah!";
        header("Location: ../data-kriteria.php");
    } else {
        $_SESSION['status'] = "Data Kriteria";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah!";
        header("Location: ../data-kriteria.php");
    }
}