<?php
session_start();
require '../functions.php';

function ubah($data)
{
    global $conn;

    // Detail Data Penilaian
    $penilaian_id = htmlspecialchars($data['penilaian_id']);
    $alternatif_id = htmlspecialchars($data['alternatif_id']);
    $kode_kriteria = $data['kode_kriteria'];
    $nilai = $data['nilai'];

    $affectedRows = 0;

    foreach ($kode_kriteria as $index => $kode) {
        $kode = htmlspecialchars($kode);
        $nilai_kriteria = htmlspecialchars($nilai[$index]);

        // Cek apakah penilaian sudah ada untuk kombinasi alternatif_id dan kode_kriteria
        $queryCek = "SELECT * FROM tb_penilaian WHERE alternatif_id = '$alternatif_id' AND kode_kriteria = '$kode'";
        $resultCek = mysqli_query($conn, $queryCek);

        if (mysqli_num_rows($resultCek) > 0) {
            // Jika ada, update nilai
            $query = "UPDATE tb_penilaian SET nilai = '$nilai_kriteria'
                      WHERE alternatif_id = '$alternatif_id' AND kode_kriteria = '$kode'";
        } else {
            // Jika tidak ada, insert nilai baru
            $query = "INSERT INTO tb_penilaian (alternatif_id, kode_kriteria, nilai)
                      VALUES ('$alternatif_id', '$kode', '$nilai_kriteria')";
        }

        mysqli_query($conn, $query);
        $affectedRows += mysqli_affected_rows($conn);
    }

    return $affectedRows;
}

// Ubah Data Penilaian
if (isset($_POST["ubah"])) {
    if (ubah($_POST) > 0) {
        $_SESSION['status'] = "Data Penilaian";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah!";
        header("Location: ../data-penilaian.php");
    } else {
        $_SESSION['status'] = "Data Penilaian";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah!";
        header("Location: ../data-penilaian.php");
    }
}
