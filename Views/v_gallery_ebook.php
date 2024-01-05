<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">

            <table id="example1" class="table table-borderless table-hover">
                <thead>
                    <tr class="text-center">
                        <th>Cover</th>
                        <th>E-Book</th>
                        <th width="300px">Deskripsi/Sinopsis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ebook as $key => $value) { ?>
                        <tr>
                            <td class="text-center">
                                <img src="<?= base_url('cover/' . $value['cover']) ?>" width="250px" height="270px">
                            </td>
                            <td>
                                <p>
                                <h5 class="text-primary"><?= $value['judul_ebook'] ?></h5>
                                </p>
                                <p><b>Kategori :</b> <?= $value['nama_kategori'] ?><br>
                                    <b>Penulis :</b> <?= $value['nama_penulis'] ?><br>
                                    <b>Penerbit :</b> <?= $value['nama_penerbit'] ?><br>
                                    <b>Bahasa :</b> <?= $value['bahasa'] ?><br>
                                    <b>ISBN :</b> <?= $value['isbn'] ?><br>
                                    <b>Tahun :</b> <?= $value['tahun'] ?><br>
                                    <b>Halaman :</b> <?= $value['halaman'] ?><br>
                                </p>
                            </td>
                            <td><?= substr($value['deskripsi'], 0, 350) ?>... <a href="<?= base_url('Home/DetailEbook/' . $value['id_ebook']) ?>">More View >></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>