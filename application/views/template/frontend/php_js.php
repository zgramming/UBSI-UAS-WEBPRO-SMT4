<script src="<?= base_url('vendor/jquery/jquery.min.js') ?>"></script>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="<?= base_url('vendor/datatables/jquery.dataTables.min.js') ?>"></script>

<script src="<?= base_url('js/main.js') ?>"></script>
<script type="text/javascript">
    function showModal(idModal) {
        $("#" + idModal).modal('show');
        //  return data;

    }

    function closeModal(idModal) {
        $("#" + idModal).modal('hide');
    }
</script>