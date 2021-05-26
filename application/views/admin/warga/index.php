  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <div class="d-flex justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Data Warga</h6>
              <div>
                  <button type="button" class="btn btn-success" onclick="window.location='<?= base_url() ?>admin/warga/addForm'">Tambah</button>
              </div>
          </div>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr align="center">
                          <th>No</th>
                          <th>Image</th>
                          <th>NIK</th>
                          <th>Nama</th>
                          <th>Tempat & Tanggal Lahir</th>
                          <th>Jenis Kelamin</th>
                          <th>Kontrol</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr align="center">
                          <th>No</th>
                          <th>Image</th>
                          <th>NIK</th>
                          <th>Nama</th>
                          <th>Tempat & Tanggal Lahir</th>
                          <th>Jenis Kelamin</th>
                          <th>Kontrol</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      <?php
                        $no = 0;
                        foreach ($citizens as $key => $citizen) {
                            $no++;
                        ?>
                          <tr>
                              <td><?= $no ?></td>
                              <td align="center"><img src="<?= ($citizen->image != null) ? base_url(PATH_WARGA . $citizen->image . "?time=" . time() . "") : base_url("upload/default.png") ?>" class="img-fluid rounded" style="min-height: 100px; max-height: 100px; min-width:100px; max-width:100px; object-fit: cover;"></td>
                              <td><?= $citizen->nik ?></td>
                              <td><?= $citizen->nama ?></td>
                              <td><?= $citizen->birth_place . " " . getTanggal($citizen->birth_date)  ?></td>
                              <td><?= ($citizen->gender == "laki_laki")  ? "Laki-laki" : "Perempuan" ?></td>
                              <td align="center">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <button type="button" class="btn btn-danger" onclick="window.location='<?= base_url('admin/warga/delete/' . $citizen->id_warga) ?>'">Hapus</button>
                                      <button type="button" class="btn btn-primary" onclick="window.location='<?= base_url('admin/warga/editForm/' . $citizen->id_warga) ?>'">Edit</button>
                                  </div>
                              </td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>