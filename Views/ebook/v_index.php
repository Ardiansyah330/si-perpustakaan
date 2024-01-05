<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
            <div class="card-tools">
                <a href="<?= base_url('Ebook/AddData') ?>" class="btn btn-primary btn-flat btn-sm">
                    <i class="fas fa-plus"></i> Add
                </a>
            </div>

        </div>
        <div class="card-body">

            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i>';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>


            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th width="50px">NO</th>
                        <th>Cover</th>
                        <th>Judul buku</th>
                        <th>ISBN</th>
                        <th>Tahun</th>
                        <th>Bahasa</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($ebook as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td class="text-center">
                                <img src="<?= base_url('cover/' . $value['cover']) ?>" width="125px" height="125px">
                                <p><br><a href="<?= base_url('ebooks/' . $value['ebooks']) ?>" class="btn btn-danger btn-flat btn-sm">
                                        <i class="fas fa-file-pdf"></i> Download
                                    </a></p>
                            </td>
                            <td>
                                <h5 class="text-primary"><?= $value['judul_ebook'] ?></h5>
                                <p><b>Kategori :</b> <?= $value['nama_kategori'] ?><br>
                                    <b>Penulis :</b> <?= $value['nama_penulis'] ?><br>
                                    <b>Penerbit :</b> <?= $value['nama_penerbit'] ?><br>
                                    <b>Halaman :</b> <?= $value['halaman'] ?><br>
                                </p>
                            </td>
                            <td><?= $value['isbn'] ?></td>
                            <td><?= $value['tahun'] ?></td>
                            <td><?= $value['bahasa'] ?></td>
                            <td>
                                <a href="<?= base_url('Ebook/EditData/' . $value['id_ebook']) ?>" class="btn btn-warning btn-flat btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_ebook'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<?php foreach ($ebook as $key => $value) { ?>
    <div class="modal fade" id="modal-delete<?= $value['id_ebook'] ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Ebook/DeleteData/' . $value['id_ebook'])) ?>
                    <div class="form-group">
                        Apakah Anda Ingin Menghapus <b><?= $value['judul_ebook'] ?></b> ?
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger btn-flat">Delete</button>
                    </div>
                    <?php echo form_close() ?>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
<?php } ?>