<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <div class="card-body">
            <?php
            //notifikasi
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?>
                <div class="alert alert-danger" role="alert">
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

            <?php
            echo form_open_multipart('Ebook/UpdateData/' . $ebook['id_ebook']);
            ?>

            <div class="row">
                <div class="col-sm-2">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Cover</label>
                                <img src="<?= base_url('cover/' . $ebook['cover']) ?>" id="gambar_load" class="img-fluid" width="200px" height="200px">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>File Cover</label>
                                <input type="file" name="cover" class="form-control" id="preview_gambar" accept="image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Judul Buku</label>
                                <input class="form-control" name="judul_ebook" value="<?= $ebook['judul_ebook'] ?>" placeholder="Judul Buku">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>ISBN</label>
                                <input class="form-control" name="isbn" value="<?= $ebook['isbn'] ?>" placeholder="ISBN">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Kategori</label>
                                <div class="input-group">
                                    <select name="id_kategori" class="form-control">
                                        <option value="<?= $ebook['id_kategori'] ?>"><?= $ebook['nama_kategori'] ?></option>
                                        <?php foreach ($kategori as $key => $value) { ?>
                                            <option value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="input-group-append">
                                        <a href="<?= base_url('Kategori') ?>" type="button" class="btn btn-primary btn-flat">
                                            <i class="fas fa fa-plus"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Penulis</label>
                                <div class="input-group">
                                    <select name="id_penulis" class="form-control">
                                        <option value="<?= $ebook['id_penulis'] ?>"><?= $ebook['nama_penulis'] ?></option>
                                        <?php foreach ($penulis as $key => $value) { ?>
                                            <option value="<?= $value['id_penulis'] ?>"><?= $value['nama_penulis'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="input-group-append">
                                        <a href="<?= base_url('Penulis') ?>" type="button" class="btn btn-primary btn-flat">
                                            <i class="fas fa fa-plus"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Penerbit</label>
                                <div class="input-group">
                                    <select name="id_penerbit" class="form-control">
                                        <option value="<?= $ebook['id_penerbit'] ?>"><?= $ebook['nama_penerbit'] ?></option>
                                        <?php foreach ($penerbit as $key => $value) { ?>
                                            <option value="<?= $value['id_penerbit'] ?>"><?= $value['nama_penerbit'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="input-group-append">
                                        <a href="<?= base_url('Penerbit') ?>" type="button" class="btn btn-primary btn-flat">
                                            <i class="fas fa fa-plus"></i>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select name="tahun" class="form-control">
                                    <option value="<?= $ebook['tahun'] ?>"><?= $ebook['tahun'] ?></option>
                                    <?php for ($i = date('Y'); $i >= 1990; $i--) { ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Bahasa</label>
                                <input class="form-control" name="bahasa" value="<?= $ebook['bahasa'] ?>" placeholder="Bahasa">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Halaman</label>
                                <input type="number" class="form-control" name="halaman" value="<?= $ebook['halaman'] ?>" placeholder="Halaman">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>File E-Book</label>
                                <input type="file" name="ebooks" class="form-control" accept=".pdf">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Deskripsi/Sinopsis</label>
                        <textarea rows="5" class="form-control" name="deskripsi"><?= $ebook['deskripsi'] ?></textarea>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <a href="<?= base_url('Ebook') ?>" class="btn btn-danger"><i class="far fa-caret-square-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas  fa-save"></i> Simpan</button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<!-- /.card -->