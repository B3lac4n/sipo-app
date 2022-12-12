<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Pengguna</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Data Pengguna</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h5 class="m-0">Form Tambah Pengguna</h5>
          </div>
            <div class="card-body">
              <?= view('Myth\Auth\Views\_message_block') ?>

              <form action="<?= base_url('register') ?>" method="post">
              <?= csrf_field(); ?>

              <div class="form-group">
                <label for="id_ketenagaan">Nama Ketenagaan</label>
                <select class="form-control select2-ketenagaan" style="width: 100%;" name="id_ketenagaan" id="id_ketenagaan">
                  <option value="">Pilih Ketenagaan</option>
                  <?php foreach ($ketenagaan as $key => $value) : ?>
                    <option value="<?= $value['id'] ?>" <?= old('id_ketenagaan') == $value['id'] ? 'selected' : '' ?>><?= $value['nama'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                  <label for="fullname">Nama Lengkap</label>
                  <input type="text" class="form-control <?php if(session('errors.fullname')) : ?>is-invalid<?php endif ?>"
                          name="fullname" placeholder="Nama Lengkap" value="<?= old('fullname') ?>">
              </div>

              <div class="form-group">
                  <label for="email"><?=lang('Auth.email')?></label>
                  <input type="email" class="form-control <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>"
                          name="email" aria-describedby="emailHelp" placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
                  <small id="emailHelp" class="form-text text-muted"><?=lang('Auth.weNeverShare')?></small>
              </div>

              <div class="form-group">
                  <label for="username"><?=lang('Auth.username')?></label>
                  <input type="text" class="form-control <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
              </div>

              <div class="form-group">
                  <label for="password"><?=lang('Auth.password')?></label>
                  <input type="password" name="password" class="form-control <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>" autocomplete="off">
              </div>

              <div class="form-group">
                  <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                  <input type="password" name="pass_confirm" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success float-right">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2-ketenagaan').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
<?= $this->endSection() ?>