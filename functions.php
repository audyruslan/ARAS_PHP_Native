<?php

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_aras");

// Hapus Data Admin
function hapus_admin($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM admin WHERE username = '$id'");
    return mysqli_affected_rows($conn);
}

function ImgTamu($nama_lengkap)
{
    $namaFile = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];

    $ext = pathinfo($namaFile, PATHINFO_EXTENSION);

    $namaFileBaru = $nama_lengkap . '.' . $ext;

    move_uploaded_file($tmpName, 'image/' . $namaFileBaru);

    return $namaFileBaru;
}

function avatar($character)
{
    $path = "image/" . time() . ".png";
    $image = imagecreate(200, 200);
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);
    imagecolorallocate($image, $red, $green, $blue);
    $textcolor = imagecolorallocate($image, 255, 255, 255);

    $font = dirname(__FILE__) . "/assets/font/arial.ttf";

    imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
    imagepng($image, $path);
    imagedestroy($image);
    return $path;
}

// Format Tanggal IDR
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
