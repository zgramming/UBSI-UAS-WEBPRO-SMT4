<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
            <div>
                <button type="button" class="btn btn-light" onclick="window.location='<?= base_url() ?>admin/user_access'">Kembali</button>
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
        <center><?= $this->session->flashdata('error_insert') ?: "" ?></center>
        <form action="<?= base_url('admin/user_access/add') ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="password">Role</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="role1" value="superadmin">
                    <label class="form-check-label" for="role1">
                        Superadmin
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="role2" value="petugas" checked>
                    <label class="form-check-label" for="role2">
                        Petugas Pengambilan
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <div class="float-right"><input type="submit" value="Simpan" class="btn btn-success"></div>
        </form>
    </div>
</div>