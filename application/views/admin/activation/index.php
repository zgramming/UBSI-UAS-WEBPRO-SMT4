  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <div class="d-flex justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Data Aktifasi Warga</h6>
          </div>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr align="center">
                          <th>No</th>
                          <th>NIK</th>
                          <th>Nama Warga</th>
                          <th>Tanggal Aktifasi</th>
                          <th>Status Aktifasi</th>
                          <th>Kontrol</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr align="center">
                          <th>No</th>
                          <th>NIK</th>
                          <th>Nama Warga</th>
                          <th>Tanggal Aktifasi</th>
                          <th>Status Aktifasi</th>
                          <th>Kontrol</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      <?php
                        $no = 0;

                        foreach ($activations as $key => $activation) {
                            $no++;
                            switch ($activation->status_aktifasi) {
                                case 'ditolak':
                                    $badgeColor = "badge-danger";
                                    $statusAktifasi = "Ditolak";
                                    break;
                                case 'belum_aktifasi':
                                    $badgeColor = "badge-info";
                                    $statusAktifasi = "Belum Aktifasi";
                                    break;
                                case 'proses_aktifasi':
                                    $badgeColor = "badge-warning";
                                    $statusAktifasi = "Proses Aktifasi";
                                    break;

                                default:
                                    $badgeColor = "badge-success";
                                    $statusAktifasi = "Sudah Aktifasi";
                                    break;
                            }
                        ?>
                          <tr>
                              <td><?= $no ?></td>
                              <td><?= $activation->nik ?></td>
                              <td><?= $activation->nama ?></td>
                              <td align="center"><?= getTanggal(date('Y-m-d', strtotime($activation->tanggal_aktifasi))) ?></td>
                              <td align="center"><span class="badge <?= $badgeColor ?> p-2"><?= $statusAktifasi ?></span></td>
                              <td align="center">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <a onclick="openBox('<?= base_url('admin/activation/formActivation/' . $activation->id_aktifasi . '/' . $activation->id_warga) ?>','modal-xl')" class="btn btn-primary">Aktifasi</a>
                                  </div>
                              </td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>