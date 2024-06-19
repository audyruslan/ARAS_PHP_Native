<?php
session_start();
require '../functions.php';

function tambah($data)
{
    global $conn;

    // Detail Data Penilaian
    $alternatif_id = htmlspecialchars($data['alternatif_id']);
    $kode_kriteria = $data['kode_kriteria'];
    $nilai = $data['nilai'];

    foreach ($kode_kriteria as $index => $kode) {
        $kode = htmlspecialchars($kode);
        $nilai_kriteria = htmlspecialchars($nilai[$index]);

        $query = "INSERT INTO tb_penilaian (alternatif_id, kode_kriteria, nilai)
                    VALUES 
                    ('$alternatif_id', '$kode', '$nilai_kriteria')";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}


//Tambah Data Penilaian
if (isset($_POST["tambah"])) {
    if (tambah($_POST) > 0) {
        $_SESSION['status'] = "Data Penilaian";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Ditambahkan!";
        header("Location: ../data-penilaian.php");
    } else {
        $_SESSION['status'] = "Data Penilaian";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Ditambahkan!";
        header("Location: ../data-penilaian.php");
    }
}
