<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <?php
        echo form_open_multipart('Pengaturan/UpdateWeb')
        ?>
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


            <div class="row">
                <div class="col-sm-2">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Logo Universitas</label>
                                <img src="<?= base_url('logo/' . $web['logo']) ?>" width="150" height="150">
                            </div>
                            <div class="form-group">
                                <label>Ganti Logo</label>
                                <input type="file" name="logo" class="form-control" accept="image/png, image/jpg, image/jpeg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama Universitas</label>
                                <input class="form-control" name="nama_universitas" value="<?= $web['nama_universitas'] ?>" placeholder="Nama Universitas">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input class="form-control" name="alamat" value="<?= $web['alamat'] ?>" placeholder="Alamat">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <input class="form-control" name="kecamatan" value="<?= $web['kecamatan'] ?>" placeholder="Kecamatan">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kabupaten/Kota</label>
                                <input class="form-control" name="kab_kota" value="<?= $web['kab_kota'] ?>" placeholder="Kabupaten/Kota">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Pos</label>
                                <input class="form-control" name="pos" value="<?= $web['pos'] ?>" placeholder="Pos">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>No Telp</label>
                                <input class="form-control" name="no_telp" value="<?= $web['no_telp'] ?>" placeholder="No Telp">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Sejarah</label>
                        <textarea class="form-control" rows="5" name="sejarah"><?= $web['misi'] ?></textarea>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Visi</label>
                            <textarea class="form-control" rows="5" name="visi"><?= $web['visi'] ?></textarea>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Misi</label>
                                <textarea class="form-control" rows="5" name="misi"><?= $web['misi'] ?></textarea>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- /.card-body -->

                <div class="card-footer">
                    <a href="<?= base_url('User') ?>" class="btn btn-danger"><i class="far fa-caret-square-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary"><i class="fas  fa-save"></i> Simpan</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
        <!-- /.card -->