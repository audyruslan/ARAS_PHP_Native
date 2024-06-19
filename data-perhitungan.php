<?php
$title = "Data Perhitungan";
require 'layouts/header.php';
require 'layouts/sidebar.php';
require 'layouts/navbar.php';

// Ambil bobot kriteria dari tabel tb_kriteria
$bobotKriteria = [];
$sqlKriteria = mysqli_query($conn, "SELECT * FROM tb_kriteria");
while ($row = mysqli_fetch_assoc($sqlKriteria)) {
    $bobotKriteria[$row["kode_kriteria"]] = $row["nilai_kriteria"];
}

// Ambil data alternatif dari tabel tb_alternatif
$sqlAlternatif = mysqli_query($conn, "SELECT * FROM tb_alternatif");
$alternatifData = [];
while ($alternatif = mysqli_fetch_assoc($sqlAlternatif)) {
    $alternatifData[] = $alternatif;
}

// Hitung total nilai untuk setiap kriteria
$totalNilai = array_fill_keys(array_keys($bobotKriteria), 0);
foreach ($alternatifData as $alternatif) {
    foreach ($bobotKriteria as $kode_kriteria => $bobot) {
        $sqlPenilaian = mysqli_query($conn, "SELECT nilai FROM tb_penilaian
                                             WHERE alternatif_id = '{$alternatif['alternatif_id']}'
                                             AND kode_kriteria = '$kode_kriteria'");
        $penilaian = mysqli_fetch_assoc($sqlPenilaian);
        $nilai = $penilaian ? $penilaian['nilai'] : 0;
        $totalNilai[$kode_kriteria] += $nilai;
    }
}
?>
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Perhitungan</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">

            <!-- Table Matriks X -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Matriks X</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <?php
                                    $kriteria = [];
                                    $sqlKriteria = mysqli_query($conn, "SELECT * FROM tb_kriteria");
                                    while ($row = mysqli_fetch_assoc($sqlKriteria)) {
                                        $kriteria[] = $row["kode_kriteria"];
                                        echo "<th>{$row['kode_kriteria']}</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sqlAlternatif = mysqli_query($conn, "SELECT * FROM tb_alternatif");
                                while ($alternatif = mysqli_fetch_assoc($sqlAlternatif)) {
                                    echo "<tr>";
                                    echo "<td>{$alternatif['nama_siswa']}</td>";

                                    foreach ($kriteria as $kode_kriteria) {
                                        $sqlPenilaian = mysqli_query($conn, "SELECT nilai FROM tb_penilaian
                                                     WHERE alternatif_id = '{$alternatif['alternatif_id']}'
                                                     AND kode_kriteria = '$kode_kriteria'");
                                        $penilaian = mysqli_fetch_assoc($sqlPenilaian);
                                        $nilai = $penilaian ? $penilaian['nilai'] : '-';
                                        echo "<td>{$nilai}</td>";
                                    }
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <!-- Table Matriks Ternomalisasi -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Matriks Ternomalisasi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <?php
                                    foreach ($bobotKriteria as $kode_kriteria => $bobot) {
                                        echo "<th>{$kode_kriteria}</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($alternatifData as $alternatif) {
                                    echo "<tr>";
                                    echo "<td>{$alternatif['nama_siswa']}</td>";
                                    foreach ($bobotKriteria as $kode_kriteria => $bobot) {
                                        $sqlPenilaian = mysqli_query($conn, "SELECT nilai FROM tb_penilaian
                                                                 WHERE alternatif_id = '{$alternatif['alternatif_id']}'
                                                                 AND kode_kriteria = '$kode_kriteria'");
                                        $penilaian = mysqli_fetch_assoc($sqlPenilaian);
                                        $nilai = $penilaian ? $penilaian['nilai'] : 0;
                                        $nilaiTernormalisasi = $totalNilai[$kode_kriteria] != 0 ? $nilai / $totalNilai[$kode_kriteria] : 0;
                                        echo "<td>" . round($nilaiTernormalisasi, 3) . "</td>";
                                    }
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Table Bobot Matriks Ternomalisasi -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bobot Matriks Ternomalisasi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <?php
                                    foreach ($bobotKriteria as $kode_kriteria => $bobot) {
                                        echo "<th>{$kode_kriteria}</th>";
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalNilaiAlternatif = []; // Array untuk menyimpan total nilai bobot per alternatif

                                foreach ($alternatifData as $alternatif) {
                                    echo "<tr>";
                                    echo "<td>{$alternatif['nama_siswa']}</td>";
                                    $total = 0; // Variabel untuk menyimpan total nilai bobot per alternatif

                                    foreach ($bobotKriteria as $kode_kriteria => $bobot) {
                                        $sqlPenilaian = mysqli_query($conn, "SELECT nilai FROM tb_penilaian
                                                                 WHERE alternatif_id = '{$alternatif['alternatif_id']}'
                                                                 AND kode_kriteria = '$kode_kriteria'");
                                        $penilaian = mysqli_fetch_assoc($sqlPenilaian);
                                        $nilai = $penilaian ? $penilaian['nilai'] : 0;
                                        $nilaiTernormalisasi = $totalNilai[$kode_kriteria] != 0 ? $nilai / $totalNilai[$kode_kriteria] : 0;
                                        $nilaiBerbobot = $nilaiTernormalisasi * $bobot;
                                        echo "<td>" . round($nilaiBerbobot, 3) . "</td>";
                                        $total += $nilaiBerbobot; // Tambahkan nilai berbobot ke total per alternatif
                                    }

                                    // Simpan total nilai ke array
                                    $totalNilaiAlternatif[$alternatif['nama_siswa']] = $total;
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Table Nilai Total dan Ranking -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Nilai Total dan Ranking</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <th>Nilai K</th>
                                    <th>Ranking</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Sorting total nilai untuk menentukan ranking
                                arsort($totalNilaiAlternatif);
                                $ranking = 1;

                                foreach ($totalNilaiAlternatif as $nama_siswa => $nilaiTotal) {
                                    echo "<tr>";
                                    echo "<td>{$nama_siswa}</td>";
                                    echo "<td>" . round($nilaiTotal, 3) . "</td>";
                                    echo "<td>{$ranking}</td>";
                                    echo "</tr>";
                                    $ranking++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php
require 'layouts/footer.php';
?>