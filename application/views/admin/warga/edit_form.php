<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Data Warga</h6>
            <div>
                <button type="button" class="btn btn-light" onclick="window.location='<?= base_url() ?>admin/warga'">Kembali</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php if (!empty(validation_errors())) : ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Terdapat masalah ! </h4>
                <p><?= validation_errors() ?></p>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('admin/warga/update/' . $citizen->id_warga) ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="nama">Nama Warga</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $citizen->nama ?>">
            </div>

            <div class="form-group">
                <label for="nik">NIK Warga</label>
                <input type="text" class="form-control" id="nik" name="nik" onkeyup="cekPhone(this)" maxlength="16" value="<?= $citizen->nik ?>">
            </div>

            <div class="form-group">
                <label for="birth_place">Tempat Lahir</label>
                <input type="text" class="form-control" id="birth_place" name="birth_place" value="<?= $citizen->birth_place ?>">
            </div>

            <div class="form-group">
                <label for="birth_date">Tanggal Lahir</label>
                <input type="text" class="form-control datepicker" id="birth_date" name="birth_date" value="<?= $citizen->birth_date ?>">
            </div>

            <div class="form-group">
                <label for="daging_qurban">Daging Qurban</label>
                <select class="form-control" id="daging_qurban" name="daging_qurban">
                    <option value="">Pilih Daging</option>
                    <?php foreach ($meats as $key => $meat) { ?>
                        <option value="<?= $meat->id_daging ?>" <?= $meat->id_daging == $citizen->id_daging ? "selected" : "" ?>><?= $meat->nama_hewan ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="gender">Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender1" value="laki_laki" <?= $citizen->gender == "laki_laki" ? "checked" : "" ?>>
                    <label class="form-check-label" for="gender1">
                        Laki-Laki
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="perempuan" <?= $citizen->gender == "perempuan" ? "checked" : "" ?>>
                    <label class="form-check-label" for="gender2">
                        Perempuan
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
                <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $citizen->image ?>">
            </div>

            <div class="float-right"><input type="submit" value="Simpan" class="btn btn-success"></div>
        </form>
    </div>
</div>