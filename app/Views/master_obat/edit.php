<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Edit Data Obat</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Edit Obat</li>
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
            <h5 class="m-0">Form Edit Data Obat</h5>
          </div>
          <?php $validation = \Config\Services::validation(); ?>
          <form action="<?= base_url('/obat/save') ?>" method="post">
            <?= csrf_field(); ?>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <input type="hidden" name="id" value="<?= $obat['id'] ?>">
                  <div class="form-group">
                    <label for="kd_obat">Kode Obat</label>
                    <input type="text" id="kd_obat" name="kd_obat" class="form-control <?= $validation->hasError('kd_obat') ? 'is-invalid' : null ?>" value="<?= (old('kd_obat')) ? old('kd_obat') : $obat['kd_obat']; ?>" readonly>
                    <div class="invalid-feedback">
                      <?= $validation->getError('kd_obat') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="nama">Nama Obat</label>
                    <input type="text" class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : null ?>" id="nama" name="nama" value="<?= (old('nama')) ? old('nama') : $obat['nama'] ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('nama') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="jenis">Jenis Obat</label>
                    <select class="form-control select2 <?= $validation->hasError('jenis') ? 'is-invalid' : null ?>" style="width: 100%;" name="jenis" id="jenis">
                      <option value="">Pilih Jenis Obat</option>
                      <?php foreach ($jenisObat as $jenis) : ?>
                        <option value="<?= $jenis['jenis']; ?>" <?= $jenis['jenis'] == $obat['jenis'] ? 'selected' : ''?>><?= $jenis['jenis']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                      <?= $validation->getError('jenis') ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="suhu">Suhu Penyimpanan Obat</label>
                    <div class="input-group">
                      <input type="number" class="form-control <?= $validation->hasError('suhu') ? 'is-invalid' : null ?>" id="suhu" name="suhu" value="<?= (old('suhu')) ? old('suhu') : $obat['suhu_penyimpanan'] ?>">
                      <div class="input-group-append">
                        <span class="input-group-text">&#8451;</span>
                      </div>
                      <div class="invalid-feedback">
                        <?= $validation->getError('suhu') ?>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="satuan">Satuan Obat</label>
                    <select class="form-control select2 <?= $validation->hasError('satuan') ? 'is-invalid' : null ?>" style="width: 100%;" id="satuan" name="satuan">
                      <option value="">Pilih Satuan Obat</option>
                      <?php foreach ($satuanObat as $satuan) : ?>
                        <option value="<?= $satuan['satuan']; ?>" <?= $satuan['satuan'] == $obat['satuan'] ? 'selected' : ''?>><?= $satuan['satuan']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                      <?= $validation->getError('satuan') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" rows="3" id="keterangan" name="keterangan"><?= $obat['keterangan'] ?></textarea>
                  </div>
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