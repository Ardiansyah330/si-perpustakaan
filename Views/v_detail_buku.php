<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <img class="img-fluid" src="<?= base_url('cover/' . $buku['cover']) ?>" width="200px" height="200px">
                </div>
                <div class="col-sm-8">
                    <table class="table">
                        <tr>
                            <th>Kode</th>
                            <th>:</th>
                            <td><?= $buku['kode_buku'] ?></td>
                        </tr>
                        <tr>
                            <th width="150px">Judul Buku</th>
                            <th width="20px">:</th>
                            <td>
                                <h5 class="text-primary"><?= $buku['judul_buku'] ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <th>:</th>
                            <td><?= $buku['nama_kategori'] ?></td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <th>:</th>
                            <td><?= $buku['nama_penulis'] ?></td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <th>:</th>
                            <td><?= $buku['nama_penerbit'] ?></td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <th>:</th>
                            <td><?= $buku['tahun'] ?></td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <th>:</th>
                            <td><?= $buku['isbn'] ?></td>
                        </tr>
                        <tr>
                            <th>Bahasa</th>
                            <th>:</th>
                            <td><?= $buku['bahasa'] ?></td>
                        </tr>
                        <tr>
                            <th>Halaman</th>
                            <th>:</th>
                            <td><?= $buku['halaman'] ?></td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <th>:</th>
                            <td><?= $buku['nama_rak'] ?> Lantai <?= $buku['lantai_rak'] ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <th>:</th>
                            <td><span class="badge badge-success"><?= $buku['jumlah'] ?></span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-12">
                    <?= $buku['deskripsi'] ?>
                </div>
            </div>
        </div>

    </div>
</div>