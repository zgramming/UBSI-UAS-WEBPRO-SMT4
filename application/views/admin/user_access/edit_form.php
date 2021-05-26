<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Edit User Akses</h6>
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
        <form action="<?= base_url('admin/user_access/update/' . $user->id_petugas) ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $user->nama ?>">
            </div>

            <div class="form-group">
                <label for="username">Email</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user->username ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="">
            </div>

            <div class="form-group">
                <label for="password">Role</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="role1" value="superadmin" <?= $user->role == "superadmin" ? "checked" : "" ?>>
                    <label class="form-check-label" for="role1">
                        Superadmin
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="role2" value="petugas" <?= $user->role == "petugas" ? "checked" : "" ?>>
                    <label class="form-check-label" for="role2">
                        Petugas Pengambilan
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
                <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $user->image ?>">

            </div>

            <div class="float-right"><input type="submit" value="Simpan" class="btn btn-success"></div>
        </form>
    </div>
</div>