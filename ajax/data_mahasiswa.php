<?php
include '../koneksi.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM data_mahasiswa WHERE npm LIKE '%$keyword%' OR nao LIKE '%$keyword%' OR nama LIKE '%$keyword%'";
$data_mahasiswa = getData($query);


?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<table  class="table table-bordered table-hover">
                          <tr>
                              <th>No</th>
                              <th>NAO</th>
                              <th>NPM</th>
                              <th>Nama</th>
                              <th>Aksi</th>
                          </tr>
                          <?php if($keyword != '') : ?>
                          <?php
                          $no = 1;
                          foreach($data_mahasiswa as $mahasiswa) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $mahasiswa["nao"]; ?></td>
                                <td><?= $mahasiswa["npm"]; ?></td>
                                <td><?= $mahasiswa["nama"]; ?></td>
                                <td>
                                   <button  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#npm<?= $mahasiswa["npm"]; ?>" >Lihat</button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="npm<?= $mahasiswa["npm"]; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Mahasiswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-6 mb-3">
                                                <img src="img/profil/<?= $mahasiswa["foto"]; ?>" width="150" alt="Foto Mahasiswa">
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                            <div class="col-lg-6">
                                                 <p><b>Nama :</b> <?= $mahasiswa["nama"]; ?></p>
                                                <p><b>NAO :</b> <?= $mahasiswa["nao"]; ?></p>
                                                <p><b>NPM :</b> <?= $mahasiswa["npm"]; ?></p>
                                                <p><b>Prodi :</b> <?= $mahasiswa["prodi"]; ?></p>
                                                <p><b>Angkatan :</b> <?= $mahasiswa["akt"]; ?></p>
                                                <p><b>Semester :</b> <?= $mahasiswa["semester"]; ?></p>
                                            </div>
                                            <div class="col-lg-6">
                                                <p><b>Email :</b> <?= $mahasiswa["email"]; ?></p>
                                                <p><b>No HP :</b> <?= $mahasiswa["hp"]; ?></p>
                                                <p><b>Asal Daerah :</b> <?= $mahasiswa["asal_daerah"]; ?></p>
                                                <p><b>Alamat :</b> <?= $mahasiswa["alamat"]; ?></p>
                                                <p><b>UKM/ORMAWA :</b> 
                                               <ol>
                                                      <?php 
                                                      $npm_detail = $mahasiswa["npm"];
                                                      $data_mahasiswa_ukm = getData("SELECT nama_ukm FROM data_mahasiswa_ukm WHERE npm = '$npm_detail'");
                                                      foreach($data_mahasiswa_ukm as $data_mhs) : ?>
                                                        <li><?= $data_mhs["nama_ukm"]; ?></li>
                                                        <?php endforeach; ?>
                                                    </ol>
                                            </p>
                                            </div>
                                        </div>
                                        <!-- <div class="row justify-content-between ">
                                            <div class="col-lg-2">
                                                <img src="img/user.jpg" width="150" alt="Foto Mahasiswa">
                                            </div>
                                            <div class="col-lg-7">
                                               
                                              
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                                </div>
                            </div>
                            </div>
                          <?php endforeach; ?>
                        <?php endif; ?>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>