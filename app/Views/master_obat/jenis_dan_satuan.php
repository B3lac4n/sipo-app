<?= $this->extend('layout/template') ?>

<?php $validation = \Config\Services::validation(); ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Jenis & Satuan Obat</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Jenis & Satuan Obat</li>
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
      <div class="col-md-4">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h5 class="m-0 card-title">Data Jenis Obat</h5>
          </div>
          <div class="card-body">
            <?php if (session()->getFlashdata('jenis-success')): ?>
              <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('jenis-success'); ?>
              </div>
            <?php endif; ?>
            <?php if ($validation->hasError('jenis')) : ?>
              <div class="alert alert-danger" role="alert">
                <?= $validation->getError('jenis') ?>
              </div>
            <?php endif; ?>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Jenis</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($jenisObat) :
                  $i = 1;
                  foreach ($jenisObat as $jenis) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $jenis['jenis']; ?></td>
                    <td>
                      <div class="row justify-content-around ">
                        <div class="align-items-center">
                          <button class="btn btn-sm text-success edit-jenis" data-id="<?= $jenis['id'] ?>" data-jenis="<?= $jenis['jenis'] ?>">
                            <i class="fas fa-pencil-alt"></i>
                          </button>
                        </div>
                        <div class="align-items-center">
                          <a href="<?= base_url('/jenisdansatuan/hapus_jenis/'.$jenis['id']) ?>" class="text-danger">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; 
                else: ?>
                  <tr>
                    <td colspan="3" class="text-center">Data masih kosong.</td>
                  </tr>
                <?php
                endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h5 class="m-0 card-title">Tambah Jenis</h5>
          </div>
          <form action="<?= base_url('/jenisdansatuan/save') ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="id" id="id-jenis">
            <div class="card-body">
              <div class="form-group">
                <input type="hidden" name="type" value="jenis">
                <input type="text" class="form-control form-control-sm <?= $validation->hasError('jenis') ? 'is-invalid' : null ?>" id="jenis" name="jenis">
              </div>

              <ul class="nav nav-pills ml-auto float-right">
                <li class="nav-item">
                  <button type="reset" class="btn btn-outline-success btn-sm"><i class="fas fa-sync-alt"></i></button>

                  <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </li>
              </ul>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h5 class="m-0 card-title">Data Satuan Obat</h5>
          </div>
          <div class="card-body">
            <?php if (session()->getFlashdata('satuan-success')): ?>
              <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('satuan-success'); ?>
              </div>
            <?php endif; ?>
            <?php if ($validation->hasError('satuan')) : ?>
              <div class="alert alert-danger" role="alert">
                <?= $validation->getError('satuan') ?>
              </div>
            <?php endif; ?>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Satuan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($jenisObat):
                  $i = 1;
                  foreach ($satuanObat as $satuan) : ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $satuan['satuan']; ?></td>
                    <td>
                      <div class="row justify-content-around ">
                        <div class="align-items-center">
                          <button class="btn btn-sm text-success edit-satuan" data-id="<?= $satuan['id'] ?>" data-satuan="<?= $satuan['satuan'] ?>">
                            <i class="fas fa-pencil-alt"></i>
                          </button>
                        </div>
                        <div class="align-items-center">
                          <a href="<?= base_url('/jenisdansatuan/hapus_satuan/'.$satuan['id']) ?>" class="text-danger">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; 
                else: ?>
                  <tr>
                    <td colspan="3" class="text-center">Data masih kosong.</td>
                  </tr>
                <?php
                endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h5 class="m-0 card-title">Tambah Satuan</h5>
          </div>
          <form action="<?= base_url('/jenisdansatuan/save') ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="id" id="id-satuan">
            <div class="card-body">
              <div class="form-group">
                <input type="hidden" name="type" value="satuan">
                <input type="text" class="form-control form-control-sm <?= $validation->hasError('satuan') ? 'is-invalid' : null ?>" id="satuan" name="satuan">
              </div>
              
              <ul class="nav nav-pills ml-auto float-right">
                <li class="nav-item">
                  <button type="reset" class="btn btn-outline-success btn-sm"><i class="fas fa-sync-alt"></i></button>

                  <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                </li>
              </ul>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    btnJenis = document.querySelectorAll('.edit-jenis');
    btnSatuan = document.querySelectorAll('.edit-satuan');

    inputJenis = document.getElementById('jenis');
    inputIdJenis = document.getElementById('id-jenis');
    inputSatuan = document.getElementById('satuan');
    inputIdSatuan = document.getElementById('id-satuan');

    btnJenis.forEach(btn => {
      btn.addEventListener('click', () => {
        inputJenis.value = btn.getAttribute('data-jenis');
        inputIdJenis.value = btn.getAttribute('data-id');
      });
    });
    
    btnSatuan.forEach(btn => {
      btn.addEventListener('click', () => {
        inputSatuan.value = btn.getAttribute('data-satuan');
        inputIdSatuan.value = btn.getAttribute('data-id');
      });
    })
  }) 
</script>
<?= $this->endSection() ?>