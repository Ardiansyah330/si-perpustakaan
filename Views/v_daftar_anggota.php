<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?= base_url('Auth') ?>" class="h2"><?= $judul ?></a>
    </div>
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

      <?php echo form_open('Auth/Daftar') ?>

      <div class="form-group">
        <select name="id_prodi" class="form-control">
          <option value="">Pilih Prodi</option>
          <?php foreach ($prodi as $key => $value) { ?>
            <option value="<?= $value['id_prodi'] ?>"><?= $value['nama_prodi'] ?></option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group">
        <input class="form-control" name="nim" value="<?= old('nim') ?>" placeholder="NIM">
      </div>

      <div class="form-group">
        <input class="form-control" name="nama" value="<?= old('nama') ?>" placeholder="Nama">
      </div>

      <div class="form-group">
        <select name="jenis_kelamin" class="form-control">
          <option value="">Pilih Jenis Kelamin</option>
          <option value="Laki-laki">Laki-laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <div class="form-group">
        <input class="form-control" name="no_hp" value="<?= old('no_hp') ?>" placeholder="Nomor Handphone">
      </div>

      <div class="form-group">
        <input type="password" class="form-control" name="password" value="<?= old('password') ?>" placeholder="Password">
      </div>

      <div class="form-group">
        <input type="password" class="form-control" name="ulangi_password" value="<?= old('ulangi_password') ?>" placeholder="Ulangi Password">
      </div>

      <div class="row">
        <div class="col-sm-6">
          <a class="btn btn-success btn-block" href="<?= base_url('Auth') ?>">Kembali</a>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </div>
        <!-- /.col -->
      </div>
      <?php echo form_close() ?>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="<?= base_url('Auth/LoginAnggota') ?>" class="btn btn-block btn-warning">
          <i class="fas fa-sign-in-alt"></i>
          Kembali ke Login
        </a>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
</div>