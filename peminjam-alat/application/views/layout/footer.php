            </div>
            <!-- End of Main Content Area -->

            <!-- Footer -->
            <footer class="bg-white py-3 mt-auto shadow-sm">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto text-muted small">
                        <span>Copyright &copy; Sipanja <?= date('Y') ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- jQuery -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <!-- DataTables JS -->
    <script src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/dataTables.bootstrap5.min.js') ?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <!-- Chart.js -->
    <script src="<?= base_url('assets/js/chart.js') ?>"></script>

    <script>
        $(document).ready(function() {
            // Sidebar toggle for mobile
            $('#sidebarToggle').click(function() {
                $('.sidebar').toggleClass('d-none');
            });
            
            // Initialize DataTables if exists
            if ($('.datatable').length) {
                $('.datatable').DataTable({
                    language: {
                        url: '<?= base_url('assets/js/datatables-id.json') ?>',
                    }
                });
            }
            
            // SweetAlert Notifications based on Flashdata
            <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= $this->session->flashdata('success') ?>',
                timer: 3000,
                showConfirmButton: false
            });
            <?php endif; ?>
            
            <?php if ($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= $this->session->flashdata('error') ?>'
            });
            <?php endif; ?>
        });
    </script>
</body>
</html>
