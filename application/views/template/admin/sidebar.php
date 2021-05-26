 <?php

    $hideMenu = "";
    $menu = [
        'pengambilan' => 'Daftar Pengambilan',
        'aktifasi' => "Aktifasi Warga",
        'daging' => 'Daging Qurban',
        'user' => 'User',
    ];

    $petugas = $this->session->userdata(SESSION_PETUGAS);

    $menuPengambilan = "";
    $menuAktifasi = "";
    $menuDaftarWarga = "";
    $menuDagingQurban = "";
    $menuAccessUser = "";

    switch ($petugas->role) {
        case 'petugas':
            $menuPengambilan = "d-block";
            $menuAktifasi = "d-none";
            $menuDaftarWarga = "d-none";
            $menuDagingQurban = "d-none";
            $menuAccessUser = "d-none";
            break;

        default:
            # code...
            break;
    }

    ?>

 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center mb-3" href="#">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">SIM Pembagian Daging</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Menu Utama
     </div>

     <li class="nav-item <?= $menuPengambilan ?>">
         <a class="nav-link" href="<?= base_url('admin/pengambilan') ?>">
             <i class="fas fa-handshake"></i>
             <span>Daftar Pengambilan</span></a>
     </li>

     <li class="nav-item <?= $menuAktifasi ?>">
         <a class="nav-link" href="<?= base_url('admin/activation') ?>">
             <i class="fas fa-check-double"></i>
             <span>Aktifasi Warga</span></a>
     </li>

     <li class="nav-item <?= $menuDaftarWarga ?>">
         <a class="nav-link" href="<?= base_url('admin/warga') ?>">
             <i class="fas fa-user"></i>
             <span>Daftar Warga</span></a>
     </li>

     <li class="nav-item <?= $menuDagingQurban ?>">
         <a class="nav-link" href="<?= base_url('admin/daging_qurban') ?>">
             <i class="fas fa-kiwi-bird"></i>
             <span>Daging Qurban</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Pengaturan
     </div>

     <!-- Nav Item - Pages Collapse Menu -->

     <li class="nav-item <?= $menuAccessUser ?>">
         <a class="nav-link" href="<?= base_url('admin/user_access') ?>">
             <i class="fas fa-users-cog"></i>
             <span>User</span></a>
     </li>

     <li class="nav-item">
         <a class="nav-link" href="<?= base_url("auth/logout") ?>">
             <i class="fas fa-sign-out-alt"></i>
             <span>Keluar</span></a>
     </li>


     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

 </ul>

 <!-- <li class="nav-item">
         <a class="nav-link" href="charts.html">
             <i class="fas fa-fw fa-chart-area"></i>
             <span>Charts</span></a>
     </li> -->