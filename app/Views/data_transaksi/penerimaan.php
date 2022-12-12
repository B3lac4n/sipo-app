<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Penerimaan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Data Penerimaan</li>
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
            <h5 class="m-0 card-title">Data Penerimaan</h5>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cetak-laporan">
                    <i class="fas fa-print"></i> Cetak Laporan
                  </button>

                  <a
                    class="btn btn-sm btn-outline-primary"
                    href="<?= base_url('/transaksi/penerimaan') ?>"
                    >Buat Penerimaan</a
                  >
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <table id="penerimaan" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Penerimaan</th>
                  <th>No SBBK</th>
                  <th>Tanggal Penerimaan</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($penerimaan as $key => $value) : ?>
                  <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $value['kd_penerimaan'] ?></td>
                    <td><?= $value['no_sbbk'] ?></td>
                    <td><?= $value['tgl_penerimaan'] ?></td>
                    <td><?= $value['keterangan'] ?></td>
                    <td>
                      <a class="btn btn-sm btn-outline-primary" href="<?= base_url('/penerimaan/'.$value['id']) ?>">Detail Item</a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Kode Penerimaan</th>
                  <th>No SBBK</th>
                  <th>Tanggal Penerimaan</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
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

<!-- Modal Cetak Laporan -->
<div class="modal fade" id="cetak-laporan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pilih Penerimaan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('/transaksi/penerimaan/laporan') ?>" method="post">
        <?= csrf_field(); ?>
        <div class="modal-body">
          <?php if (session()->getFlashdata('empty')): ?>
              <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('empty'); ?>
              </div>
          <?php endif; ?>

          <div class="form-group">
            <label for="kode">Kode Penerimaan</label>
            <select class="form-control form-control-sm select2-kode" style="width: 100%;" name="kode" id="kode">
              <option value="">Pilih Kode Penerimaan</option>
              <?php foreach ($penerimaan as $data) : ?>
                <option value="<?= $data['id'] ?>"><?= $data['kd_penerimaan'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Cetak</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2-kode').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $("#penerimaan").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
    });
  })
</script>
<?= $this->endSection() ?>