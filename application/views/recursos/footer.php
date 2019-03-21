        <!-- Bootstrap core JavaScript -->
        <script src="<?php echo base_url('assets/vendor/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/vendor/js/bootstrap.bundle.min.js'); ?>"></script>

        <!-- FontAwesome 5 -->
        <script defer src="<?php echo base_url('assets/vendor/js/fontawesome-all.js'); ?>"></script>

        <!-- Custom JavaScript to search Reporte Historial de Pláticas and download a XLSX file -->
        <?php if(isset($reporte_platicas_js)) echo '<script src="' . base_url() . 'assets/vendor/js/reporte_platicas.js"></script>'; ?>

    </body>

    <!-- Custom script -->
    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }
    </script>
</html>