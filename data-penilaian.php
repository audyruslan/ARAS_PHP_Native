<?php
$title = "Data Penilaian";
require 'layouts/header.php';
require 'layouts/sidebar.php';
require 'layouts/navbar.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penilaian</h1>

        <!-- Tambah Data -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
            Tambah Data
        </button>

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data Penilaian</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="penilaian/tambah.php" method="POST">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="alternatif_id">Nama Siswa</label>
                                        <select class="form-control" name="alternatif_id" id="alternatif_id">
                                            <option value="">--Silahkan Pilih--</option>
                                            <?php
                                            $sqlTamu = mysqli_query($conn, "SELECT * FROM tb_alternatif WHERE alternatif_id NOT IN (SELECT alternatif_id FROM tb_penilaian)");
                                            while ($row = mysqli_fetch_assoc($sqlTamu)) {
                                            ?>
                                            <option value="<?= $row["alternatif_id"]; ?>"><?= $row["nama_siswa"]; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <?php
                                $sqlTamu = mysqli_query($conn, "SELECT * FROM tb_kriteria");
                                while ($row = mysqli_fetch_assoc($sqlTamu)) {
                                ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="hidden" name="kode_kriteria[]"
                                            value="<?= $row["kode_kriteria"]; ?>">
                                        <label for="<?= $row["kode_kriteria"]; ?>"><?= $row["kriteria"]; ?></label>
                                        <input type="number" class="form-control" name="nilai[]"
                                            id="<?= $row["kode_kriteria"]; ?>" autocomplete="off"
                                            placeholder="Masukkan Nilai <?= $row["kriteria"]; ?>">
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Penilaian</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Alternatif</th>
                                    <?php
                                    // Ambil semua kriteria untuk header tabel
                                    $kriteria = [];
                                    $sqlKriteria = mysqli_query($conn, "SELECT * FROM tb_kriteria");
                                    while ($row = mysqli_fetch_assoc($sqlKriteria)) {
                                        $kriteria[] = $row["kode_kriteria"];
                                        echo "<th>{$row['kode_kriteria']}</th>";
                                    }
                                    ?>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Ambil semua alternatif
                                $sqlAlternatif = mysqli_query($conn, "SELECT * FROM tb_alternatif");
                                while ($alternatif = mysqli_fetch_assoc($sqlAlternatif)) {
                                    echo "<tr>";
                                    echo "<td>{$alternatif['nama_siswa']}</td>";

                                    // Ambil data penilaian untuk setiap alternatif dan kriteria
                                    foreach ($kriteria as $kode_kriteria) {
                                        $sqlPenilaian = mysqli_query($conn, "SELECT nilai FROM tb_penilaian
                                                     WHERE alternatif_id = '{$alternatif['alternatif_id']}'
                                                     AND kode_kriteria = '$kode_kriteria'");
                                        $penilaian = mysqli_fetch_assoc($sqlPenilaian);
                                        $nilai = $penilaian ? $penilaian['nilai'] : '-'; // Jika tidak ada nilai, tampilkan '-'
                                        echo "<td>{$nilai}</td>";
                                    }

                                    // Tambahkan kolom aksi (misalnya, tombol edit/hapus)
                                    echo "<td>
                    <a href='#' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#ubahModal{$alternatif['alternatif_id']}'>Edit</a>
                    <a href='penilaian/hapus.php?alternatif_id={$alternatif['alternatif_id']}' class='btn btn-danger btn-sm hapus_penilaian'>Hapus</a>
                  </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- Modal Ubah Data -->
                        <?php
                        $sqlAlternatif = mysqli_query($conn, "SELECT * FROM tb_alternatif");
                        while ($alternatif = mysqli_fetch_assoc($sqlAlternatif)) {
                            // Ambil nilai penilaian untuk modal
                            $nilaiPenilaian = [];
                            $sqlPenilaian = mysqli_query($conn, "SELECT * FROM tb_penilaian WHERE alternatif_id = '{$alternatif['alternatif_id']}'");
                            while ($penilaian = mysqli_fetch_assoc($sqlPenilaian)) {
                                $nilaiPenilaian[$penilaian['kode_kriteria']] = $penilaian['nilai'];
                            }
                        ?>
                        <div class="modal fade" id="ubahModal<?= $alternatif['alternatif_id']; ?>" tabindex="-1"
                            role="dialog" aria-labelledby="ubahModalLabel<?= $alternatif['alternatif_id']; ?>"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="ubahModalLabel<?= $alternatif['alternatif_id']; ?>">
                                            Ubah Data Penilaian</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="penilaian/ubah.php" method="POST">
                                        <input type="hidden" name="penilaian_id"
                                            value="<?= $alternatif['alternatif_id']; ?>">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="alternatif_id">Nama Siswa</label>
                                                        <select class="form-control" name="alternatif_id"
                                                            id="alternatif_id">
                                                            <option value="">--Silahkan Pilih--</option>
                                                            <?php
                                                                $sqlTamu = mysqli_query($conn, "SELECT * FROM tb_alternatif");
                                                                while ($row = mysqli_fetch_assoc($sqlTamu)) {
                                                                ?>
                                                            <option value="<?= $row["alternatif_id"]; ?>"
                                                                <?= ($row["alternatif_id"] == $alternatif['alternatif_id']) ? 'selected' : ''; ?>>
                                                                <?= $row["nama_siswa"]; ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <?php
                                                    $sqlKriteria = mysqli_query($conn, "SELECT * FROM tb_kriteria");
                                                    while ($row = mysqli_fetch_assoc($sqlKriteria)) {
                                                        $nilai = isset($nilaiPenilaian[$row['kode_kriteria']]) ? $nilaiPenilaian[$row['kode_kriteria']] : '';
                                                    ?>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="hidden" name="kode_kriteria[]"
                                                            value="<?= $row["kode_kriteria"]; ?>">
                                                        <label
                                                            for="<?= $row["kode_kriteria"]; ?>"><?= $row["kriteria"]; ?></label>
                                                        <input type="number" class="form-control" name="nilai[]"
                                                            id="<?= $row["kode_kriteria"]; ?>" value="<?= $nilai; ?>"
                                                            autocomplete="off"
                                                            placeholder="Masukkan Nilai <?= $row["kriteria"]; ?>">
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                                            <button type="button" class="btn btn-dark"
                                                data-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

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