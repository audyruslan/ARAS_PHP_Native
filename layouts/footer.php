 </div>
 <!-- End of Main Content -->

 <!-- Footer -->
 <footer class="sticky-footer bg-white">
     <div class="container my-auto">
         <div class="copyright text-center my-auto">
             <span>Copyright &copy; Metode Aras 2024</span>
         </div>
     </div>
 </footer>
 <!-- End of Footer -->

 </div>
 <!-- End of Content Wrapper -->

 </div>
 <!-- End of Page Wrapper -->

 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
     <i class="fas fa-angle-up"></i>
 </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel"><strong><?= $admin["nama_lengkap"]; ?></strong>, Anda
                     Yakin
                     Ingin
                     Keluar?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Pilih Tombol "Keluar" jika ingin melanjtukan.</div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                 <a class="btn btn-primary" href="logout.php">Keluar</a>
             </div>
         </div>
     </div>
 </div>


 <!-- Bootstrap core JavaScript-->
 <script src="vendor/jquery/jquery.min.js"></script>
 <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Core plugin JavaScript-->
 <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="assets/js/sb-admin-2.min.js"></script>

 <!-- Page level plugins -->
 <script src="vendor/chart.js/Chart.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="assets/js/demo/chart-area-demo.js"></script>
 <script src="assets/js/demo/chart-pie-demo.js"></script>

 <!-- Page level plugins -->
 <script src="vendor/datatables/jquery.dataTables.min.js"></script>
 <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

 <!-- Page level custom scripts -->
 <script src="assets/js/demo/datatables-demo.js"></script>

 <!-- Sweetalert -->
 <script src="vendor/sweetalert2/sweetalert2.all.min.js"></script>

 <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
     <script>
         Swal.fire({
             title: '<?= $_SESSION['status'];  ?>',
             icon: '<?= $_SESSION['status_icon'];  ?>',
             text: '<?= $_SESSION['status_info'];  ?>'
         });
     </script>
 <?php
        unset($_SESSION['status']);
    }
    ?>

 <script>
     $(document).ready(function() {

         // Hapus Alternatif
         $(document).on('click', '.hapus_alternatif', function(e) {

             e.preventDefault();
             var href = $(this).attr('href');

             Swal.fire({
                 title: 'Apakah Anda Yakin?',
                 text: "Data Alternatif!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Hapus Data!'
             }).then((result) => {
                 if (result.value) {
                     document.location.href = href;
                 }

             })
         });

         // Hapus Kriteria
         $(document).on('click', '.hapus_kriteria', function(e) {

             e.preventDefault();
             var href = $(this).attr('href');

             Swal.fire({
                 title: 'Apakah Anda Yakin?',
                 text: "Data Kriteria!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Hapus Data!'
             }).then((result) => {
                 if (result.value) {
                     document.location.href = href;
                 }

             })
         });

         // Hapus Penilaian
         $(document).on('click', '.hapus_penilaian', function(e) {

             e.preventDefault();
             var href = $(this).attr('href');

             Swal.fire({
                 title: 'Apakah Anda Yakin?',
                 text: "Data Penilaian!",
                 icon: 'warning',
                 showCancelButton: true,
                 confirmButtonColor: '#3085d6',
                 cancelButtonColor: '#d33',
                 confirmButtonText: 'Hapus Data!'
             }).then((result) => {
                 if (result.value) {
                     document.location.href = href;
                 }

             })
         });

     });
 </script>

 </body>

 </html>