<!-- Topbar -->
<?php
$petugas = $this->session->userdata(SESSION_PETUGAS);
?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="row w-100">
        <div class="col-md-12">
            <div class="d-flex justify-content-end">

                <span>Petugas : <b><?= $petugas->nama ?></b></span>
            </div>
        </div>
    </div>
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
</nav>
<!-- End of Topbar -->