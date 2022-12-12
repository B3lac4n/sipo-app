<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Transaksi Pemesanan Obat</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Pemesanan Obat</li>
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
            <h5 class="m-0">Pemesanan Baru</h5>
          </div>

          <?php $validation = \Config\Services::validation(); ?>
          <form id="form-pemesanan" action="<?= base_url('/transaksi/pemesanan') ?>" method="post">
            <?= csrf_field(); ?>
          
            <div class="card-body">
              
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kd_pemesanan">Kode Pemesanan</label>
                    <input type="text" id="kd_pemesanan" name="kd_pemesanan" class="form-control" value="<?= $kodePemesanan ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="petugas">Petugas</label>
                    <input type="text" id="petugas" name="petugas" class="form-control" value="<?= user()->fullname ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="tgl_dokumen">Tanggal Dokumen</label>
                    <div class="input-group date" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input <?= $validation->hasError('tgl_dokumen') ? 'is-invalid' : null ?>" data-target="#tgl_dokumen" name="tgl_dokumen" id="tgl_dokumen"/>
                        <div class="input-group-append" data-target="#tgl_dokumen" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <div class="invalid-feedback">
                      <?= $validation->getError('tgl_dokumen') ?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="no_dokumen">Nomor Dokumen</label>
                    <input type="text" id="no_dokumen" name="no_dokumen" class="form-control <?= $validation->hasError('no_dokumen') ? 'is-invalid' : null ?>" value="<?= old('no_dokumen') ?>" required maxlength="25">
                    <div class="invalid-feedback">
                      <?= $validation->getError('no_dokumen') ?>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="umum">Jumlah Kunjungan</label>
                    <div class="row">
                      <div class="col-md-4">
                        <input type="number" min="0" id="umum" name="umum" class="form-control <?= $validation->hasError('umum') ? 'is-invalid' : null ?>" placeholder="UMUM" value="<?= old('umum') ?>" required>
                        <div class="invalid-feedback">
                          <?= $validation->getError('umum') ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <input type="number" min="0" id="bpjs" name="bpjs" class="form-control <?= $validation->hasError('bpjs') ? 'is-invalid' : null ?>" placeholder="BPJS/JKN" value="<?= old('bpjs') ?>" required>
                        <div class="invalid-feedback">
                          <?= $validation->getError('bpjs') ?>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <input type="number" min="0" id="jamkesda" name="jamkesda" class="form-control <?= $validation->hasError('jamkesda') ? 'is-invalid' : null ?>" value="<?= old('jamkesda') ?>" placeholder="JAMKESDA" required>
                        <div class="invalid-feedback">
                          <?= $validation->getError('jamkesda') ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" rows="3" id="keterangan" name="keterangan"></textarea>
                  </div>
                  <button type="submit" class="btn btn-success float-right">Simpan</button>
                </div>

              </div>
                
            </div>
          </form>
          <!-- /.card -->
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
  <?php if (session()->getFlashdata('inserted')): ?>
    const message = '<?= session()->getFlashdata('inserted'); ?>';
    Swal.fire({
      title: `${message}, Cetak Laporan Transaksi Terakhir?`,
      icon: 'success',
      showDenyButton: true,
      confirmButtonText: 'Cetak',
      denyButtonText: `Jangan Sekarang`,
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '<?= base_url('/transaksi/pemesanan/laporan/'.session()->getFlashdata('id')) ?>';
      } else if (result.isDenied) {
        Swal.close()
      }
    })
  <?php endif; ?>
</script>
<?= $this->endSection() ?>