<?php

if (is_null($pengambilan)) {
    $idPengambilan = 0;
    $statusBelumDiterima = "";
    $statusSudahDiterima = "";
    $statusDitolak = "";
} else {
    $idPengambilan = $pengambilan->id_pengambilan;
    $statusBelumDiterima = $pengambilan->status_pengambilan == "belum_diterima" ? "selected" : "";
    $statusSudahDiterima = $pengambilan->status_pengambilan == "sudah_diterima" ? "selected" : "";
    $statusDitolak = $pengambilan->status_pengambilan == "ditolak" ? "selected" : "";
}

?>
<div class="modal-content border-0">
    <div class="modal-header bg-webapp text-white">
        <h4 class="modal-title ">Status Pengambilan <?= $citizen->nama ?></h4>
    </div>
    <div class="modal-body">
        <form method="post" class="w-100" id="form_status_pengambilan">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            <?php if (is_null($pengambilan)) : ?>
                                <div class="alert alert-warning" role="alert">
                                    Warga bernama <b><?= $citizen->nama ?></b> belum terdata dalam pengambilan daging qurban
                                </div>
                            <?php else : ?>
                                <div class="alert alert-info" role="alert">
                                    Update status pengambilan warga bernama : <b><?= $citizen->nama ?></b>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_pengambilan">Status Pengambilan</label>
                        <select class="form-control" id="status_pengambilan" name="status_pengambilan">
                            <option value="">Pilih Status Pengambilan</option>
                            <option value="belum_diterima" <?= $statusBelumDiterima  ?>>Belum Diterima</option>
                            <option value="sudah_diterima" <?= $statusSudahDiterima  ?>>Sudah Diterima</option>
                            <option value="ditolak" <?= $statusDitolak  ?>>Ditolak</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" onclick="closeModal('modal-default')">Batal</button>
        <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
    </div>
</div>

<script>
    $(document).ready(function(e) {

        $("#saveButton").on("click", function(e) {

            // e.preventDefault();
            let data = $("#form_status_pengambilan").serialize();
            let url = '<?= base_url('admin/pengambilan/updateStatusPengambilan/' . $idPengambilan . '/' . $citizen->id_warga) ?>';
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(success) {
                    let result = $.parseJSON(success);

                    Swal.fire({
                        title: result.message,
                        icon: "success",
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(error) {
                    var jsonError = $.parseJSON(error.responseText);

                    Swal.fire({
                        title: jsonError.message,
                        icon: "error"
                    });
                }
            });
        });

    });
</script>