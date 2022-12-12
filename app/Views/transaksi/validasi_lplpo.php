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
          <form id="form-pemesanan" action="<?= base_url('/transaksi/validasi-lplpo') ?>" method="post">
            <?= csrf_field(); ?>
          
            <div class="card-body">
              
              <div class="overflow-auto mb-3">
                <table border=1 width=100% cellpadding=2 cellspacing=0 style="font-size: 8pt;">
                  <thead>
                      <tr bgcolor=silver align=center>
                          <th style="text-transform: uppercase" width="5%">No</th>
                          <th style="text-transform: uppercase" width="60%">Nama Obat</th>
                          <th style="text-transform: uppercase" width="15%">Satuan</th>
                          <th style="text-transform: uppercase" width="15%">Stok Awal</th>
                          <th style="text-transform: uppercase" width="15%">Penerimaan</th>
                          <th style="text-transform: uppercase" width="15%">Persediaan</th>
                          <th style="text-transform: uppercase" width="15%">Pemakaian</th>
                          <th style="text-transform: uppercase" width="15%">Sisa Stok</th>
                          <th style="text-transform: uppercase" width="15%">Permintaan</th>
                          <th style="text-transform: uppercase" width="15%">Pemberian</th>
                          <th style="text-transform: uppercase" width="15%">Keterangan</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($dataLPLPO as $key => $data) :?>
                      <tr>
                          <input type="hidden" name="id_obat[<?= $key ?>]" value="<?= $data->id_obat ?>">
                          <td style="text-align:center"><?= $key + 1; ?></td>
                          <td>
                            <input type="text" name="nama_obat[<?= $key ?>]" value="<?= $data->nama; ?>">
                          </td>
                          <td style="text-align:center">
                            <input type="text" name="satuan[<?= $key ?>]" value="<?= $data->satuan; ?>">
                          </td>
                          <td style="text-align:right">
                            <input type="text" name="stok_awal[<?= $key ?>]" value="<?= $data->stok_awal; ?>">
                          </td>
                          <td style="text-align:right">
                            <input type="text" name="penerimaan[<?= $key ?>]" value="<?= $data->total_penerimaan; ?>">
                          </td>
                          <td style="text-align:right">
                            <input type="text" name="persediaan[<?= $key ?>]" value="<?= $data->persediaan; ?>">
                          </td>
                          <td style="text-align:right">
                            <input type="text" name="pemakaian[<?= $key ?>]" value="<?= $data->total_pengeluaran; ?>">
                          </td>
                          <td style="text-align:right">
                            <input type="text" name="sisa_stok[<?= $key ?>]" value="<?= $data->total_qty; ?>">
                          </td>
                          <td style="text-align:right">
                            <input type="text" name="permintaan[<?= $key ?>]" value="<?= $data->permintaan; ?>">
                          </td>
                          <td style="text-align:right">
                            <input type="text" name="pemberian[<?= $key ?>]" >
                          </td>
                          <td>
                            <input type="text" name="keterangan[<?= $key ?>]" >
                          </td>
                      </tr>
                      <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

              <button type="submit" class="btn btn-success float-right">Simpan</button>
                
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