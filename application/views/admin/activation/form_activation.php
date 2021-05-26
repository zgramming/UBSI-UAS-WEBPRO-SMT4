<form method="post" class="w-100" id="form_activated_status">
    <div class="modal-content border-0">
        <div class="modal-header bg-webapp text-white">
            <h4 class="modal-title ">Validasi Data Foto Diri & KTP Warga</h4>
        </div>
        <div class="modal-body">
            <div class="container ">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="d-flex flex-column">
                            <div class="text-center">
                                <h3><b>Foto KTP</b></h3>
                            </div>
                            <div>
                                <img src="<?= ($activation->foto_ktp != null) ? base_url(PATH_AKTIFASI . $activation->foto_ktp . "?time=" . time() . "") : base_url('./upload/default.png') ?>" alt="" class="img-fluid rounded mx-auto d-block" style="min-height: 300px; min-width: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="d-flex flex-column">
                            <div class="text-center">
                                <h3><b>Foto Diri</b></h3>
                            </div>
                            <div>
                                <img src="<?= ($activation->foto_diri != null) ? base_url(PATH_AKTIFASI . $activation->foto_diri . "?time=" . time() . "") : base_url('./upload/default.png') ?>" alt="" class="img-fluid rounded mx-auto d-block" style="min-height: 300px; min-width: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="form-group">
                        <label for="status_aktifasi">Status Aktifasi</label>
                        <select class="form-control" id="status_aktifasi" name="status_aktifasi">
                            <option value="">Pilih Status Aktifasi</option>
                            <option value="ditolak" <?= $activation->status_aktifasi == "ditolak" ? "selected" : ""  ?>>Aktifasi Ditolak</option>
                            <option value="belum_aktifasi" <?= $activation->status_aktifasi == "belum_aktifasi" ? "selected" : ""  ?>>Belum Aktifasi</option>
                            <option value="proses_aktifasi" <?= $activation->status_aktifasi == "proses_aktifasi" ? "selected" : ""  ?>>Proses Aktifasi</option>
                            <option value="sudah_aktifasi" <?= $activation->status_aktifasi == "sudah_aktifasi" ? "selected" : ""  ?>>Sudah Aktifasi</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" onclick="closeModal('modal-default')">Batal</button>
            <button type="submit" class="btn btn-primary ">Simpan</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function(e) {

        $("#form_activated_status").on("submit", function(e) {

            e.preventDefault();
            let data = $("#form_activated_status").serialize();
            let url = '<?= base_url('admin/activation/updateStatus/' . $activation->id_aktifasi) ?>';
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