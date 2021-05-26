<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit Persediaan</h6>
            <div>
                <button type="button" class="btn btn-light" onclick="window.location='<?= base_url() ?>admin/daging_qurban'">Kembali</button>
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
        <center><?= $this->session->flashdata('error_file') ?: "" ?></center>
        <form action="<?= base_url('admin/daging_qurban/update/' . $meat->id_daging) ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="nama_hewan">Nama Hewan</label>
                <input type="text" class="form-control" id="nama_hewan" name="nama_hewan" value="<?= $meat->nama_hewan ?>">
            </div>

            <div class="form-group">
                <label for="total_stok">Total Stok (kantong)</label>
                <input type="text" class="form-control" id="total_stok" name="total_stok" onkeyup="cekAngka(this)" value="<?= getAngka($meat->total_stok) ?>">
            </div>
            <div class="form-group">
                <label for="sisa_stok">Sisa Stok (kantong)</label>
                <input type="text" class="form-control" id="sisa_stok" name="sisa_stok" onkeyup="cekAngka(this)" value="<?= getAngka($meat->sisa_stok) ?>">
            </div>

            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
                <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $meat->image ?>">

            </div>

            <div class="float-right"><input type="submit" value="Simpan" class="btn btn-success"></div>
        </form>
    </div>
</div>