<?php
$title = "Profile";
require 'layouts/header.php';
require 'layouts/sidebar.php';
require 'layouts/navbar.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>
    <div class="row">
        <?php if (isset($_SESSION['pesan'])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['pesan'];  ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['pesan']); ?>
        <?php } ?>
        <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'];  ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['error']); ?>
        <?php } ?>
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="img-fluid rounded" src="admin/<?= $admin["img_dir"]; ?>" alt="Profile">
                    </div>

                    <h3 class="profile-username text-center mt-3"><?= $admin["nama_lengkap"]; ?></h3>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Data
                                Akun Administrator</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Ubah
                                Password</a>
                        </li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="d-flex justify-content-between mb-3">
                                <h3 class="card-title">Tabel Data Administrator</h3>
                                <button type="button" class="card-tools btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#tambahModal">
                                    Tambah Admin
                                </button>

                                <!-- Modal Tambah Data Admin -->
                                <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Admin
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="admin/tambah.php" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="nama_lengkap">Nama Lengkap</label>
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            id="nama_lengkap" name="nama_lengkap"
                                                            placeholder="Nama Lengkap">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="username">Username</label>
                                                        <input type="text" autocomplete="off" class="form-control"
                                                            id="username" name="username"
                                                            placeholder="Masukkan Username">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" autocomplete="off" class="form-control"
                                                            id="password" name="password"
                                                            placeholder="Masukkan Password">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Kembali</button>
                                                    <button type="submit" name="tambah"
                                                        class="btn btn-primary">Tambah</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover text-center" id="example" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $nama_admnin = $admin["nama_lengkap"];
                                $sql = mysqli_query($conn, "SELECT * FROM admin WHERE nama_lengkap <> '$nama_admnin'");
                                while ($row = mysqli_fetch_assoc($sql)) {
                                ?>
                                <tr>
                                    <td><?= $i; ?>.</td>
                                    <td><?= $row['nama_lengkap']; ?></td>
                                    <td><?= $row['username']; ?></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm hapus_admin"
                                            href="admin/hapus.php?username=<?= $row["username"]; ?>"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; ?>

                                <?php
                                }
                                ?>
                            </table>
                        </div>
                        <div class="tab-pane" id="settings">

                            <form action="" method="POST">
                                <input type="hidden" name="username" value="<?= $_SESSION["username"]; ?>">
                                <div class="form-group">
                                    <label for="password_lama">Masukkan Password Lama</label>
                                    <input type="password" autocomplete="off" class="form-control" id="password_lama"
                                        name="password_lama" placeholder="Masukkan Password Lama">
                                </div>
                                <div class="form-group">
                                    <label for="password_baru">Masukkan Password Baru</label>
                                    <input type="password" autocomplete="off" class="form-control" id="password_baru"
                                        name="password_baru" placeholder="Masukkan Password Baru">
                                </div>
                                <div class="form-group">
                                    <label for="konfirmasi_password">Konfirmasi Password</label>
                                    <input type="password" autocomplete="off" class="form-control"
                                        id="konfirmasi_password" name="konfirmasi_password"
                                        placeholder="Konfirmasi Password">
                                </div>
                                <button type="submit" class="btn btn-primary" name="ubah">Ubah
                                    Password!</button>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</div>
<!-- /.container-fluid -->

<?php
require 'layouts/footer.php';
?>