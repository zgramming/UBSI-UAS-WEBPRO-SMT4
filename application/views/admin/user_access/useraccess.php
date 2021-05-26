  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <div class="d-flex justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
              <div>
                  <button type="button" class="btn btn-success" onclick="window.location='<?= base_url() ?>admin/user_access/addForm'">Tambah</button>
              </div>
          </div>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr align="center">
                          <th>No</th>
                          <th>Gambar</th>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Kontrol</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr align="center">
                          <th>No</th>
                          <th>Gambar</th>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Kontrol</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      <?php
                        $no = 0;
                        foreach ($users as $key => $user) {
                            $no++;
                        ?>
                          <tr>
                              <td><?= $no ?></td>
                              <td align="center"><img src="<?= ($user->image != null) ? base_url(PATH_USER_ACCESS . $user->image . "?time=" . time() . "") : base_url("upload/default.png") ?>" class="img-fluid rounded" style="min-height: 100px; max-height: 100px; max-width:100px; object-fit: cover;" alt=""></td>
                              <td><?= $user->nama ?></td>
                              <td><?= $user->username ?></td>
                              <td align="center">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <button type="button" class="btn btn-danger" onclick="window.location='<?= base_url('admin/user_access/delete/' . $user->id_petugas) ?>'">Hapus</button>
                                      <button type="button" class="btn btn-primary" onclick="window.location='<?= base_url('admin/user_access/editForm/' . $user->id_petugas) ?>'">Edit</button>
                                  </div>
                              </td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>