        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-database"></i>
                </div>
                <div class="sidebar-brand-text mx-3">METODE ARAS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if ($title == "Dashboard") echo "active"; ?>">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Master Data
            </div>

            <!-- Nav Item - Data Kriteria -->
            <li class="nav-item <?php if ($title == "Data Kriteria") echo "active"; ?>">
                <a class="nav-link" href="data-kriteria.php">
                    <i class="fas fa-fw fa-boxes"></i>
                    <span>Data Kriteria</span></a>
            </li>

            <!-- Nav Item - Data Alternatif -->
            <li class="nav-item <?php if ($title == "Data Alternatif") echo "active"; ?>">
                <a class="nav-link" href="data-alternatif.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Alternatif</span></a>
            </li>

            <!-- Nav Item - Data Penilaian -->
            <li class="nav-item <?php if ($title == "Data Penilaian") echo "active"; ?>">
                <a class="nav-link" href="data-penilaian.php">
                    <i class="fas fa-fw fa-edit"></i>
                    <span>Data Penilaian</span></a>
            </li>

            <!-- Nav Item - Data Hasil Akhir -->
            <li class="nav-item <?php if ($title == "Data Perhitungan") echo "active"; ?>">
                <a class="nav-link" href="data-perhitungan.php">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Data Perhitungan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengaturan
            </div>

            <!-- Nav Item - Profile -->
            <li class="nav-item <?php if ($title == "Profile") echo "active"; ?>">
                <a class="nav-link" href="profile.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profile</span></a>
            </li>

            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">


        </ul>
        <!-- End of Sidebar -->