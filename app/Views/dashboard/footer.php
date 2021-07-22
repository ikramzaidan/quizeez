            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
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
    <div class="modal fade" id="join_groupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Gabung Grup dengan Kode</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center py-3">
                        <div class="col-11 mb-3">Masukan kode grup yang terdiri dari 5 karakter.
                        </div>
                        <div class="col-8">
                            <form action="<?=base_url()?>/group/join" method="post">
                                <input class="form-control" type="text" name="group_code" placeholder="Kode Grup">
                        </div>
                        <div class="col-3 mb-3">
                                <button class="btn btn-primary w-100" type="submit">Gabung</button>
                            </form>
                        </div>
                        <div class="col-11">Pastikan karakter sesuai dengan tetap mengikuti huruf besar dan kecil.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <a class="btn btn-primary" href="<?=base_url()?>/main/logout/">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="<?=base_url()?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?=base_url()?>/assets/jquery-easing/jquery.easing.min.js"></script>
    
    <script src="<?=base_url()?>/assets/js/sb-admin-2.min.js"></script>
    <script src="<?=base_url()?>/assets/js/demo/chart-area-demo.js"></script>
    <!-- Bootstrap core JavaScript-->

    <!-- Page level plugins -->
    <script src="<?=base_url()?>/assets/chart.js/Chart.min.js"></script>

    <!-- Core plugin JavaScript-->
    <!-- Page level custom scripts -->
    <script src="<?=base_url()?>/assets/js/demo/chart-area-demo.js"></script>
    <script src="<?=base_url()?>/assets/js/demo/chart-pie-demo.js"></script>

    
    
</body>

</html>