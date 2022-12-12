<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Data Ketenagaan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Ketenagaan</li>
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
      <div class="col-md-6">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h5 class="m-0">Form Tambah Data Ketenagaan</h5>
          </div>
          <?php $validation = \Config\Services::validation(); ?>
          <form action="<?= base_url('/ketenagaan/save') ?>" method="post">
            <?= csrf_field(); ?>
            <div class="card-body">
              <div class="form-group">
                <label for="nama">Nama Pegawai/Staf</label>
                <input type="text" id="nama" name="nama" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : null ?>" value="<?= old('nama') ?>" required>
                <div class="invalid-feedback">
                  <?= $validation->getError('nama') ?>
                </div>
              </div>

              <div class="form-group">
                <label for="nip">NIP Pegawai/Gol</label>
                <input type="text" class="form-control <?= $validation->hasError('nip') ? 'is-invalid' : null ?>" id="nip" name="nip" value="<?= old('nip') ?>" required>
                <div class="invalid-feedback">
                  <?= $validation->getError('nip') ?>
                </div>
              </div>
              
              <div class="form-group">
                <label for="status">Status</label>
                <input type="text" class="form-control <?= $validation->hasError('status') ? 'is-invalid' : null ?>" id="status" name="status" value="<?= old('status') ?>" required>
                <div class="invalid-feedback">
                  <?= $validation->getError('status') ?>
                </div>
              </div>

              <div class="form-group">
                <label for="pendidikan">Pendidikan</label>
                <input type="text" class="form-control <?= $validation->hasError('pendidikan') ? 'is-invalid' : null ?>" id="pendidikan" name="pendidikan" value="<?= old('pendidikan') ?>" required>
                <div class="invalid-feedback">
                  <?= $validation->getError('pendidikan') ?>
                </div>
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