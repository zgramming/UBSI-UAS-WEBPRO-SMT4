<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

    <title>Beranda</title>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }


        .btn-circle.btn-sm {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            font-size: 8px;
            text-align: center;
        }

        .btn-circle.btn-md {
            width: 50px;
            height: 50px;
            padding: 7px 10px;
            border-radius: 25px;
            font-size: 10px;
            text-align: center;
        }

        .btn-circle.btn-xl {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 12px;
            text-align: center;
        }

        .btn-circle.btn-xxl {
            width: 100px;
            height: 100px;
            padding: 10px 16px;
            border-radius: 50px;
            font-size: 12px;
            text-align: center;
        }

        @media (min-width: 992px) {
            .rounded-lg-3 {
                border-radius: .3rem;
            }
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>



</head>

<body>
    <?php
    $idActivation = isset($aktifasi) ?  $aktifasi['id_aktifasi'] : 0;

    $statusPengambilan = "Belum Diterima";
    $statusAktifasi = "Belum Aktifasi";

    $colorStatusAktifasi = "bg-info";
    $colorStatusPengambilan = "bg-info";

    if (isset($pengambilan)) {
        switch ($pengambilan['status_pengambilan']) {
            case 'ditolak':
                $statusPengambilan = "Ditolak";
                $colorStatusPengambilan = "bg-danger";
                break;
            case 'sudah_diterima':
                $statusPengambilan = "Sudah Mengambil";
                $colorStatusPengambilan = "bg-success";
                break;

            default:
                # code...
                break;
        }
    }

    if (isset($aktifasi)) {
        switch ($aktifasi['status_aktifasi']) {
            case 'ditolak':
                $statusAktifasi = "Aktifasi Ditolak";
                $colorStatusAktifasi = "bg-danger";

                break;
            case 'proses_aktifasi':
                $statusAktifasi = "Proses Aktifasi";
                $colorStatusAktifasi = "bg-warning";
                break;
            case 'sudah_aktifasi':
                $statusAktifasi = "Sudah Aktifasi";
                $colorStatusAktifasi = "bg-success";
                break;

            default:
                break;
        }
    }
    if ($warga->gender == "perempuan") {
        $pathGender = PATH_GENDER_IMAGE . "perempuan.png";
    } else {
        $pathGender = PATH_GENDER_IMAGE . "pria.png";
    }

    ?>
    <main>
        <div style="position: fixed; bottom: 30px; right: 30px; z-index:999;" id="floating_action_button">
            <a href="<?= base_url('home/logout') ?>">
                <button type="button" class="btn btn-danger btn-circle btn-xl"><i class="fas fa-sign-out-alt fa-2x"></i></button>
            </a>
        </div>
        <div class="px-4 py-5 my-5 mx-auto " style="max-width: 70em;">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <img src="<?= ($warga->image != null) ? base_url(PATH_WARGA . $warga->image . "?time=" . time() . "") : base_url("upload/default.png") ?>" alt="" class="img-fluid rounded" style='max-height:350px; width: 100%; object-fit: cover; '>
                </div>
                <div class="col-md-9 col-sm-12">
                    <div class="row h-100">
                        <div class="col-12">
                            <div class="d-flex align-items-start flex-column h-100 w-100">
                                <div class="d-none d-sm-block d-md-none my-3"></div>
                                <div class="d-flex justify-content-between w-100 mt-2">
                                    <div class="display-4 mb-4"><b><?= $warga->nama ?></b></div>
                                    <div><img src="<?= $pathGender ?>" alt="" style="max-width: 50px;"></div>
                                </div>

                                <p>NIK : <b><?= $warga->nik ?></b></p>
                                <p class="mb-5">Tempat & Tanggal Lahir : <b><?= $warga->birth_place . " " . getTanggal($warga->birth_date) ?></b></p>
                                <div class="mb-auto w-100">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card mb-3 " style="min-height: 150px; ">
                                                <div class="card-header text-center fw-bold">Jatah daging</div>
                                                <div class="card-body">
                                                    <h3 class="card-text text-center ">
                                                        Daging <?= $warga->nama_hewan ?>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card mb-3 <?= $colorStatusAktifasi ?> text-white" style="min-height: 150px; ">
                                                <div class="card-header text-center fw-bold">Status Aktifasi</div>
                                                <div class="card-body">
                                                    <h3 class="card-text text-center ">
                                                        <?= $statusAktifasi ?>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card mb-3 <?= $colorStatusPengambilan ?> text-white" style="min-height: 150px; ">
                                                <div class="card-header text-center fw-bold">Status Pengambilan</div>
                                                <div class="card-body">
                                                    <h3 class="card-text text-center ">
                                                        <?= $statusPengambilan ?>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="w-100 d-grid">
                                    <button type="button" class="btn btn-primary btn-block fw-bold p-3 m-3" id="button_status_aktifasi" onclick="openBox('<?= base_url('home/form_upload_activation/' . $idActivation) ?>','modal-xl')">Lihat Detail Aktifasi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="b-example-divider"></div>
        <div class="px-4 pt-5 my-5 mx-auto" style=" max-width: 70em;">
            <h1 class="display-4 fw-bold text-center mb-5">Update Persediaan Daging Qurban</h1>
            <div class="row">
                <?php
                foreach ($meats as $key => $meat) {
                    $pathImage = PATH_QURBAN . $meat['image'];
                    $totalMeatTaken =  (int) $this->db->select('COUNT(t1.id_pengambilan)')
                        ->from('pengambilan as t1')
                        ->join("warga as t2", "t2.id_warga = t1.id_warga", "INNER")
                        ->where("t2.id_daging", $meat['id_daging'])
                        ->count_all_results();
                    $currentStock = (int) $meat['sisa_stok'] - $totalMeatTaken;

                ?>
                    <div class="col-sm-12 col-md-6">
                        <div class="card my-3">
                            <img src="<?= $pathImage ?>" class="card-img-top" alt="..." style="max-height: 300px; object-fit: cover;">
                            <div class="card-body">
                                <h1 class="card-title mb-5"><?= $meat['nama_hewan'] ?></h1>
                                <div class="w-100 d-flex justify-content-around">
                                    <button type="button" class="btn btn-primary">Total Stok&nbsp;:&nbsp;<b><?= getAngka($meat['total_stok']) ?></b></button>
                                    <button type="button" class="btn btn-success">Sisa Stok&nbsp;:&nbsp;<b><?= getAngka($currentStock) ?></b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="b-example-divider"></div>
        <div class="px-4 pt-5 my-5 mx-auto" style=" max-width: 70em;">
            <h1 class="display-4 fw-bold text-center mb-5">Update Pengambilan Daging Qurban</h1>

            <?php if (empty($daftarPengambilan)) : ?>

                <div class="row ">
                    <div class="col-md-12">
                        <div class="d-flex flex-column">
                            <img src="<?= PATH_TRANSACTION_IMAGE . "empty_transaction.png" ?>" class="img-fluid rounded mx-auto my-5" style="max-height: 200px; object-fit: conver;">

                            <h3 class="text-center"><?= ($isYouAlreadyTake > 0)  ? "Selain kamu, belum ada yang mengambil daging" : "Sepertinya belum ada warga yang mengambil daging ..." ?></h3>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="row">
                    <?php
                    foreach ($daftarPengambilan as $key => $value) {
                    ?>
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="row ">
                                    <div class="col-md-2">
                                        <img src="<?= ($value['imageWarga'] != null) ? base_url(PATH_WARGA . $value['imageWarga'] . "?time=" . time() . "") : base_url("upload/default.png") ?>" class="img-fluid rounded" style='min-height: 250px; max-height:250px; width: 100%; object-fit: cover; '>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body d-flex flex-column h-100">
                                            <h2 class="card-title"><?= $value['namaWarga'] ?></h2>
                                            <p class="card-text mb-auto">Mengambil daging pada tanggal <b><?= getTanggal(date('Y-m-d', strtotime($value['tanggal_pengambilan'])), "t") ?></b> pukul <?= date('H:i:s', strtotime($value['tanggal_pengambilan'])) ?></p>
                                            <p class="card-text"><small class="text-muted">Petugas yang melayani : <b><?= $value['namaPetugas'] ?></b></small></p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 ">
                                        <div class="d-flex align-items-center h-100 mx-4">
                                            <img src="<?= ($value['imageHewan'] != null) ? base_url(PATH_QURBAN . $value['imageHewan'] . "?time=" . time() . "") : base_url("upload/default.png") ?>" class="img-fluid rounded" style='min-height: 50%; width: 100%; object-fit: cover; '>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php endif; ?>

        </div>

        <!-- <div class="b-example-divider"></div>
        <div class="container col-xxl-8 px-4 py-5">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img src="bootstrap-themes.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">Responsive left-aligned hero with image</h1>
                    <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Primary</button>
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Default</button>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="b-example-divider mb-0"></div>
    </main>
</body>
<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-view">

        </div>
    </div>
</div>

<?php $this->load->view('template/frontend/php_js'); ?>

</html>