<?php
$title = "Data Alternatif";
require 'layouts/header.php';
require 'layouts/sidebar.php';
require 'layouts/navbar.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Alternatif</h1>

        <!-- Tambah Data -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
            Tambah Data
        </button>

        <!-- Modal Tambah Data -->
        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data Alternatif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="alternatif/tambah.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" autocomplete="off" placeholder="Masukkan Nama Siswa">
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Alternatif</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Siswa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $sqlTamu = mysqli_query($conn, "SELECT * FROM tb_alternatif");
                                while ($row = mysqli_fetch_assoc($sqlTamu)) {
                                ?>
                                    <tr>
                                        <td><?= $i; ?>.</td>
                                        <td><?= $row["nama_siswa"]; ?></td>
                                        <td>
                                            <a class="btn btn-success btn-sm ubah" data-toggle="modal" data-target="#ubahModal<?= $row["alternatif_id"]; ?>"><i class="fas fa-edit"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm hapus_alternatif" href="alternatif/hapus.php?alternatif_id=<?= $row["alternatif_id"]; ?>"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>

                                    <!-- Modal Ubah Data -->
                                    <div class="modal fade" id="ubahModal<?= $row["alternatif_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ubahModalLabel">Ubah Data Alternatif</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="alternatif/ubah.php" method="POST">
                                                    <input type="hidden" name="alternatif_id" value="<?= $row["alternatif_id"]; ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nama_siswa">Nama Siswa</label>
                                                            <input type="text" class="form-control" name="nama_siswa" id="nama_siswa" value="<?= $row["nama_siswa"]; ?>" autocomplete="off" placeholder="Masukkan Nama Siswa">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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