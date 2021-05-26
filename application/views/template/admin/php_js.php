 <!-- Bootstrap core JavaScript-->
 <script src="<?= base_url('vendor/jquery/jquery.min.js') ?>"></script>
 <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

 <!-- Core plugin JavaScript-->
 <script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>

 <!-- Page level plugins -->
 <!-- <script src="<?= base_url('vendor/chart.js/Chart.min.js') ?>"></script> -->

 <!-- Page level custom scripts -->
 <!-- <script src="<?= base_url('js/demo/chart-area-demo.js') ?>"></script>
 <script src="<?= base_url('js/demo/chart-pie-demo.js') ?>"></script> -->

 <!-- Datatable -->
 <script src="<?= base_url('vendor/datatables/jquery.dataTables.min.js') ?>"></script>
 <script src="<?= base_url('vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
 <script src="<?= base_url('js/datepicker/bootstrap-datepicker.min.js') ?>"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
 <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>

 <script src="<?= base_url('js/main.js') ?>"></script>

 <script type="text/javascript">
     $(function() {
         $(".datepicker").datepicker({
             format: 'yyyy-mm-dd',
             autoclose: true,
             todayHighlight: true,
         });

     });

     function showModal(idModal) {
         $("#" + idModal).modal('show');
         //  return data;

     }

     function closeModal(idModal) {
         $("#" + idModal).modal('hide');
     }
 </script>