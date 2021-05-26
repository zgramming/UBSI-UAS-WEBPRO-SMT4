  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <div class="d-flex justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Persediaan Daging</h6>
              <div>
                  <button type="button" class="btn btn-success" onclick="window.location='<?= base_url() ?>admin/daging_qurban/addForm'">Tambah</button>
              </div>
          </div>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr align="center">
                          <th>No</th>
                          <th>Nama Hewan</th>
                          <th>Total Stok</th>
                          <th>Sisa Stok</th>
                          <th>Image</th>
                          <th>Kontrol</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr align="center">
                          <th>No</th>
                          <th>Nama Hewan</th>
                          <th>Total Stok</th>
                          <th>Sisa Stok</th>
                          <th>Image</th>
                          <th>Kontrol</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      <?php
                        $no = 0;
                        foreach ($meats as $key => $meat) {
                            $no++;
                        ?>
                          <tr>
                              <td><?= $no ?></td>
                              <td><?= $meat->nama_hewan ?></td>
                              <td><?= getAngka($meat->total_stok) ?></td>
                              <td><?= getAngka($meat->sisa_stok) ?></td>
                              <td align="center"><img src="<?= ($meat->image != null) ? base_url(PATH_QURBAN . $meat->image . "?time=" . time() . "") : base_url("upload/default.png") ?>" class="img-fluid rounded" style="min-height: 100px; max-height: 100px; max-width:100px; object-fit: cover;"></td>
                              <td align="center">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <button type="button" class="btn btn-danger" onclick="window.location='<?= base_url('admin/daging_qurban/delete/' . $meat->id_daging) ?>'">Hapus</button>
                                      <button type="button" class="btn btn-primary" onclick="window.location='<?= base_url('admin/daging_qurban/editForm/' . $meat->id_daging) ?>'">Edit</button>
                                  </div>
                              </td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>