<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <img class="img-fluid" src="<?= base_url('cover/' . $ebook['cover']) ?>" width="200px" height="200px">
                </div>
                <div class="col-sm-8">
                    <table class="table">
                        <tr>
                            <th width="150px">Judul E-Book</th>
                            <th width="20px">:</th>
                            <td>
                                <h5 class="text-primary"><?= $ebook['judul_ebook'] ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <th>:</th>
                            <td><?= $ebook['nama_kategori'] ?></td>
                        </tr>
                        <tr>
                            <th>Penulis</th>
                            <th>:</th>
                            <td><?= $ebook['nama_penulis'] ?></td>
                        </tr>
                        <tr>
                            <th>Penerbit</th>
                            <th>:</th>
                            <td><?= $ebook['nama_penerbit'] ?></td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <th>:</th>
                            <td><?= $ebook['tahun'] ?></td>
                        </tr>
                        <tr>
                            <th>ISBN</th>
                            <th>:</th>
                            <td><?= $ebook['isbn'] ?></td>
                        </tr>
                        <tr>
                            <th>Bahasa</th>
                            <th>:</th>
                            <td><?= $ebook['bahasa'] ?></td>
                        </tr>
                        <tr>
                            <th>Halaman</th>
                            <th>:</th>
                            <td><?= $ebook['halaman'] ?></td>
                        </tr>
                        <tr>
                            <th>File E-Book</th>
                            <th>:</th>
                            <td>
                                <?php
                                if (session()->get('level') <> "") { ?>
                                    <a href="<?= base_url('ebooks/' . $ebook['ebooks']) ?>" class="btn btn-flat btn-sm btn-success"><i class="fas fa-file-pdf text-danger"></i> Download PDF</a>
                                <?php } else { ?>
                                    <label class="text-red">Login Terlebih Dahulu Untuk Mendownload File PDF !</label>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-12">
                    <?= $ebook['deskripsi'] ?>
                </div>
            </div>
        </div>

    </div>
</div>