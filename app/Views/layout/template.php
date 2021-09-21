<?= view('layout/header'); ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?= view('layout/sidebar'); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?= view('layout/topbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <?= $this->rendersection('content'); ?>
                    </main>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?= view('layout/footer'); ?>

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
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>/sbadmin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>/sbadmin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>/sbadmin/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url(); ?>/sbadmin/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>/sbadmin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url(); ?>/sbadmin/js/demo/datatables-demo.js"></script>

    <!-- onChange Supplier option -->
    <script type="text/JavaScript">function optSupp() {
        var supp1 = document.getElementById('namaSupp').value;
        document.getElementById("id_supplier").value=supp1;
    }</script>

    <script type="text/JavaScript">function optBrg() {
        var brg1 = document.getElementById('namaBrg').value;
        document.getElementById("id_barang").value=brg1;
    }</script>
    <script type="text/javascript" src="<?= base_url(); ?>/sbadmin/vendor/jquery/my.js"></script>

</body>

</html>