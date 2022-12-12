<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Persediaan Obat</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Persediaan Obat</li>
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
            <h5 class="m-0 card-title">Persediaan Obat Di <?= $lokasi == 'gudang' ? 'Gudang' : 'Apotek' ?></h5>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <!-- <li class="nav-item">
                  <a
                    class="nav-link active"
                    href="#"
                    ><i class="fas fa-plus"></i></a
                  >
                </li> -->
              </ul>
            </div>
          </div>
          <div class="card-body">
            <table id="persediaan" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Nomor Batch</th>
                <th>ED</th>
                <th>Lokasi</th>
                <th>QTY</th>
                <th>Status</th>
                <?php if ($lokasi == 'gudang') : ?>
                  <th>Aksi</th>
                <?php endif; ?>
              </tr>
              </thead>
              <tbody>
              <?php foreach ($persediaan as $p) : ?>
                <tr>
                  <td><?= $p->kd_obat ?></td>
                  <td><?= $p->nama ?></td>
                  <td><?= $p->no_batch ?></td>
                  <td><?= $p->expired ?></td>
                  <td><?= $p->lokasi_obat ?></td>
                  <td>
                    <?= $p->qty ?>
                    <?= $p->qty <= 50 ? '<span class="badge badge-warning float-right">Kritis</span>' : ''; ?>
                  </td>
                  <td><?= $p->status ?></td>
                  <?php if ($lokasi == 'gudang') : ?>
                    <td>
                      <button type="button" data-id="<?= $p->id ?>" data-qty="<?= $p->qty ?>" class="btn btn-sm btn-outline-primary pindahkan" data-toggle="modal" data-target="#modal-pindah">
                      Pindahkan
                      </button>
                    </td>
                  <?php endif; ?>
                </tr>
              <?php endforeach; ?>
              </tbody>
              <tfoot>
              <tr>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Nomor Batch</th>
                <th>ED</th>
                <th>Lokasi</th>
                <th>QTY</th>
                <th>Status</th>
                <?php if ($lokasi == 'gudang') : ?>
                  <th>Aksi</th>
                <?php endif; ?>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php if ($lokasi == 'gudang') : ?>
<!-- Modal Pemindahan -->
<div class="modal fade" id="modal-pindah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pindahkan Lokasi Obat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php $validation = \Config\Services::validation(); ?>
      <form action="<?=base_url() ?>/transaksi/perubahan" method="post">
        <?= csrf_field(); ?>
        <div class="modal-body">

          <input type="hidden" name="id" id="id_persediaan_detail">
          <input type="hidden" name="jumlah" id="jumlah">

          <div class="form-group">
            <label for="kd_perubahan">Kode Perubahan</label>
            <input type="text" id="kd_perubahan" name="kd_perubahan" class="form-control form-control-sm" value="<?= $kodePerubahan ?>" readonly>
          </div>

          <div class="form-group">
            <label for="petugas">Petugas</label>
            <input type="text" id="petugas" name="petugas" class="form-control form-control-sm" value="<?= user()->fullname ?>" readonly>
          </div>

          <div class="form-group">
            <label for="lokasi">Lokasi Tujuan</label>
            <div class="row">
              <div class="col-3">
                <input type="text" id="lokasi" name="lokasi" class="form-control form-control-sm" value="Apotek" readonly>
              </div>
              <div class="col-1 text-center">
                <span class="align-middle">/</span>
              </div>
              <div class="col-8">
                <input type="text" id="rak" name="rak" class="form-control form-control-sm <?= $validation->hasError('rak') ? 'is-invalid' : null ?>" placeholder="Lokasi Rak" value="<?= old('rak') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('rak') ?>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="tgl_perubahan">Tanggal Perubahan</label>
            <div class="input-group date" data-target-input="nearest">
                <input type="text" class="form-control form-control-sm datetimepicker-input" data-target="#tgl_perubahan" id="tgl_perubahan" name="tgl_perubahan" required/>
                <div class="input-group-append" data-target="#tgl_perubahan" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
          </div>

          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control form-control-sm" rows="3" id="keterangan" name="keterangan"></textarea>
          </div>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Pindahkan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php endif; ?>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  <?php if (session()->getFlashdata('moved')): ?>
    const message = '<?= session()->getFlashdata('moved'); ?>';
    Swal.fire({
      title: `${message}.`,
      icon: 'success',
      showCancelButton: true,
      confirmButtonText: 'Data Perubahan',
      cancelButtonText: 'Tutup'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = '<?= base_url('/perubahan') ?>';
      } 
    })
  <?php endif; ?>

  $(function () {
    // init datatable
    $("#persediaan").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
    });
  })

  $('#tgl_perubahan').datetimepicker({
      format: 'YYYY-MM-DD',
      defaultDate: new Date(),
      locale: 'id'
  });

  document.addEventListener('DOMContentLoaded', () => {
      btnPindah = document.querySelectorAll('.pindahkan');

      btnPindah.forEach(btn => {
        btn.addEventListener('click', () => {
          inputId = document.getElementById('id_persediaan_detail');
          inputJumlah = document.getElementById('jumlah');

          inputId.value = btn.getAttribute('data-id');
          inputJumlah.value = btn.getAttribute('data-qty');
        });
      });

      // show modal jika ada validation error
      <?php 
        if ($lokasi == 'gudang') {
          if ($validation->getErrors()) { ?>
            $('#modal-pindah').modal('toggle');
      <?php  
          }
        } 
      ?>
  });
</script>
<?= $this->endSection() ?>