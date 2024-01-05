<div class="col-md-12">
    <div class="card card-outline card-danger">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <div class="card-body">


            <?php
            //notifikasi
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?> <div class="alert alert-danger" role="alert">
                    <h4>Periksa Entry Form</h4>
                    <ul>
                        <?php foreach ($errors as $key => $error) { ?>
                            <li><?= esc($error) ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>
            <table class="table table-bordered">
                <tr class="text-center">
                    <th>NO</th>
                    <th>No Pinjam</th>
                    <th>Cover</th>
                    <th>Data Buku</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </tr>
                <?php $no = 1;
                foreach ($pengajuanditolak as $key => $value) { ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $value['no_pinjam'] ?></td>
                        <td class="text-center">
                            <img src="<?= base_url('cover/' . $value['cover']) ?>" width="125px" height="125px">
                            <p><b><?= $value['kode_buku'] ?></b></p>
                        </td>
                        <td>
                            <p>
                            <h5 class="text-primary"><?= $value['judul_buku'] ?></h5>
                            </p>
                            <p><b>Kategori :</b> <?= $value['nama_kategori'] ?><br>
                                <b>Penulis :</b> <?= $value['nama_penulis'] ?><br>
                                <b>Penerbit :</b> <?= $value['nama_penerbit'] ?><br>
                                <b>Lokasi :</b> <?= $value['nama_rak'] ?> Lantai <?= $value['lantai_rak'] ?><br>
                                <b>ISBN :</b> <?= $value['isbn'] ?><br>
                                <b>Bahasa :</b> <?= $value['bahasa'] ?><br>
                                <b>Tahun :</b> <?= $value['tahun'] ?><br>
                                <b>Halaman :</b> <?= $value['halaman'] ?><br>
                            </p>
                        </td>
                        <td>
                            <b>Tanggal Pengajuan :</b> <?= $value['tgl_pengajuan'] ?> <br>
                            <b>Tanggal Pinjam :</b> <?= $value['tgl_pinjam'] ?> <br>
                            <b>Lama Pinjam :</b> <?= $value['lama_pinjam'] ?> Hari <br>
                            <b>Harus Dikembalikan Pada :</b> <?= $value['tgl_harus_kembali'] ?> <br>
                        <td class="text-center">
                            <span class="right badge badge-danger"><?= $value['status_pinjam'] ?></span>
                        </td>
                        <td>
                            <?= $value['ket'] ?>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>