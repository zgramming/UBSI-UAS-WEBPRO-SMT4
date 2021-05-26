<?php
$displayNone = "";
if (isset($activation)) {
    $pathKTP = PATH_AKTIFASI . $activation->foto_ktp;
    $pathFotoProfile = PATH_AKTIFASI . $activation->foto_diri;

    if ($activation->status_aktifasi == "sudah_aktifasi") {
        $displayNone = "d-none";
    }
} else {
    $pathKTP = PATH_TRANSACTION_IMAGE . "empty_file.png";
    $pathFotoProfile = PATH_TRANSACTION_IMAGE . "empty_file.png";
}

?>
<form method="post" class="w-100" id="form_activated_status">
    <div class="modal-content border-0">
        <div class="modal-header ">
            <h4 class="modal-title text-center w-100">Upload File Aktifasi</h4>
        </div>
        <div class=" modal-body">
            <div class="container" style="max-width: 50em;">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (isset($activation)) : ?>
                            <?php if ($activation->status_aktifasi == "sudah_aktifasi") : ?>
                                <div class="alert alert-success text-center" role="alert">
                                    <b> Data diri terbaru kamu sudah diaktifasi oleh petugas, silahkan datang ke masjid setempat untuk mengambil daging</b>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-primary text-center" role="alert">
                                    Kamu sudah melakukan aktifasi sebelumnya, kamu masih bisa mengubah <b>Foto KTP & Foto Diri</b> sampai petugas memvalidasi data kamu.
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex flex-column mx-3">
                            <center class="mb-3">
                                <h3>File KTP</h3>
                            </center>
                            <img id="preview_ktp" src="<?= $pathKTP ?>" alt="No-Image" class="img-fluid rounded mb-3" style=" min-height: 300px; max-height: 300px; object-fit: cover;">

                            <div class="mb-3 <?= $displayNone ?>">
                                <input name="file_ktp" class="form-control" type="file" id="file_ktp" onchange="previewFile(event,'preview_ktp')" accept=".png,.jpg">
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex flex-column mx-3">
                            <center class="mb-3">
                                <h3>Foto Diri</h3>
                            </center>
                            <img id="preview_profile" src="<?= $pathFotoProfile ?>" alt="No-Image" class="img-fluid rounded mb-3" style=" min-height: 300px; max-height: 300px; object-fit: cover;">
                            <div class="mb-3 <?= $displayNone ?>">
                                <input name="file_profile" class="form-control" type="file" id="file_profile" onchange="previewFile(event,'preview_profile')" accept=".png,.jpg">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" onclick="closeModal('modal-default')">Batal</button>
            <div class="<?= $displayNone ?>">
                <button type="submit" class="btn btn-primary" id="button_save">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    var previewFile = function(event, imageID) {
        let file = event.target.files[0];

        var preview = document.getElementById(imageID);
        preview.src = URL.createObjectURL(file);
        preview.onload = function() {
            URL.revokeObjectURL(preview.src) // free memory
        }
    };

    $(document).ready(function(e) {
        $("#button_save").on("click", function(e) {

            e.preventDefault();
            var form_data = new FormData($('#form_activated_status')[0]);
            let data = form_data;
            let url = '<?= base_url('home/insertOrUpdateActivation') ?>';
            $.ajax({
                data: data,
                method: "POST",
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response, status) {
                    let result = $.parseJSON(response);
                    console.log(result);
                    Swal.fire({
                        title: result.message,
                        icon: "success"
                    }).then(() => {
                        closeModal('modal-default');
                        location.reload();
                    });
                },
                error: function(response, status) {
                    let result = $.parseJSON(response.responseText);
                    Swal.fire({
                        title: result.message,
                        icon: "error"
                    });

                }
            });
        });
    });
</script>