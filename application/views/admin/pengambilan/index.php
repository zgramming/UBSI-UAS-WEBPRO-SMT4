  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <div class="d-flex justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Data Pengambilan</h6>
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
                          <th>Jumlah</th>
                          <th>Tanggal Pengambilan</th>
                          <th>Status Aktifasi</th>
                          <th>Status Pengambilan</th>
                          <th>Petugas</th>
                          <th>Kontrol</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr align="center">
                          <th>No</th>
                          <th>NIK</th>
                          <th>Nama Warga</th>
                          <th>Jumlah</th>
                          <th>Tanggal Pengambilan</th>
                          <th>Status Aktifasi</th>
                          <th>Status Pengambilan</th>
                          <th>Petugas</th>
                          <th>Kontrol</th>
                      </tr>
                  </tfoot>
                  <tbody>
                      <?php
                        $no = 0;
                        foreach ($pengambilan as $key => $value) {
                            $no++;
                            $dataPengambilan = $this->PengambilanModel->pengambilanWithWargaAndPetugas($value->id_warga);
                            $statusActivation = $this->db->get_where("aktifasi", ['id_warga' => $value->id_warga])->row()->status_aktifasi;

                            switch ($statusActivation) {
                                case 'ditolak':
                                    $badgeColorAktifasi = "badge-danger";
                                    $statusActivationLabel = "Ditolak";
                                    break;
                                case 'belum_aktifasi':
                                    $badgeColorAktifasi = "badge-info";
                                    $statusActivationLabel = "Belum Aktifasi";
                                    break;
                                case 'proses_aktifasi':
                                    $badgeColorAktifasi = "badge-warning";
                                    $statusActivationLabel = "Proses Aktifasi";
                                    break;

                                default:
                                    $badgeColorAktifasi = "badge-success";
                                    $statusActivationLabel = "Sudah Aktifasi";
                                    break;
                            }

                            $jumlahPengambilan = "-";
                            $tanggalPengambilan = "-";
                            $petugasPengambilan = "-";
                            $statusPengambilan = "Belum Mengambil";
                            $badgeColor = "badge-danger";
                            if (isset($dataPengambilan)) {
                                $jumlahPengambilan = $dataPengambilan['jumlah'];
                                $tanggalPengambilan = getTanggal(date('Y-m-d', strtotime($dataPengambilan['tanggal_pengambilan'])));
                                $petugasPengambilan = $dataPengambilan['namaPetugas'];

                                switch ($dataPengambilan['status_pengambilan']) {
                                    case 'belum_diterima':
                                        $badgeColor = "badge-info";
                                        $statusPengambilan = "Belum Mengambil";
                                        break;
                                    case 'ditolak':
                                        $badgeColor = "badge-danger";
                                        $statusPengambilan = "Ditolak";
                                        break;

                                    default:
                                        $badgeColor = "badge-success";
                                        $statusPengambilan = "Sudah Mengambil";
                                        break;
                                }
                            }

                        ?>
                          <tr>
                              <td><?= $no ?></td>
                              <td><?= $value->nik ?></td>
                              <td><?= $value->namaWarga ?></td>
                              <td><?= $jumlahPengambilan ?></td>
                              <td><?= $tanggalPengambilan ?></td>
                              <td align="center"><span class="badge <?= $badgeColorAktifasi ?> p-2"><?= $statusActivationLabel ?></span></td>
                              <td align="center"><span class="badge <?= $badgeColor ?> p-2"><?= $statusPengambilan ?></span></td>
                              <td><?= $petugasPengambilan ?></td>
                              <td align="center">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                      <?php if ($statusActivation === 'sudah_aktifasi') {
                                            $idPengambilan = is_null($dataPengambilan) ? 0 : $dataPengambilan['id_pengambilan'];

                                        ?>
                                          <a onclick="openBox('<?= base_url('admin/pengambilan/formStatusPengambilan/' . $idPengambilan . '/' . $value->id_warga) ?>')" class="btn btn-primary">Update Status</a>
                                      <?php } ?>
                                  </div>
                              </td>
                          </tr>
                      <?php } ?>
                  </tbody>
              </table>
          </div>
      </div>
  </div>