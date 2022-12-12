<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Transaksi Pengeluaran Obat</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Pengeluaran Obat</li>
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
      <div class="col-md-8">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h5 class="m-0">Pengeluaran Baru</h5>
          </div>
          <form id="form-pengeluaran">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="kd_pengeluaran">Kode Pengeluaran</label>
                    <input type="text" id="kd_pengeluaran" name="kd_pengeluaran" class="form-control" value="<?= $kodePengeluaran ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="tgl_pengeluaran">Tanggal Pengeluaran</label>
                    <div class="input-group date" id="tgl_pengeluaran" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" name="tgl_pengeluaran" data-target="#tgl_pengeluaran"/>
                        <div class="input-group-append" data-target="#tgl_pengeluaran" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="dokter">Pemesan / Dokter</label>
                    <select class="form-control select2-dokter" style="width: 100%;" name="dokter" id="dokter" required>
                      <option value="">Pilih Dokter</option>
                      <?php foreach ($dokter as $d) : ?>
                        <option value="<?= $d['nama'] ?>"><?= $d['nama'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="jenis">Jenis Pengeluaran</label>
                    <div class="form-check">
                      <div class="row w-50">
                        <div class="col-6">
                          <input class="form-check-input" type="radio" name="jenis" value="Resep" checked>
                          <label class="form-check-label">Resep</label>
                        </div>
                        <div class="col-6">
                          <input class="form-check-input" type="radio" name="jenis" value="Lainnya">
                          <label class="form-check-label">Lainnya</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="petugas">Petugas</label>
                    <input type="text" id="petugas" name="petugas" class="form-control" value="<?= user()->fullname ?>" readonly>
                  </div>
                  
                  <div class="form-group">
                    <label for="pasien">Pengguna / Pasien</label>
                    <input type="text" id="pasien" name="pasien" class="form-control" placeholder="Nama Pasien" required>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-3">
                        <input type="text" id="umur" name="umur" class="form-control" placeholder="Umur" required>
                      </div>
                      <div class="col-md-9">
                        <div class="form-check">
                          <div class="row pl-3">
                            <div class="col-6">
                              <input class="form-check-input" type="radio" name="jk" value="Laki-laki" checked>
                              <label class="form-check-label">Laki-laki</label>  
                            </div>
                            <div class="col-6">
                              <input class="form-check-input" type="radio" name="jk" value="Perempuan">
                              <label class="form-check-label">Perempuan</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" rows="3" id="keterangan" name="keterangan"></textarea>
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

      <div class="col-md-4">
        <div class="card card-outline card-success">
          <div class="card-header">
            <h3 class="card-title">Daftar Item Obat</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambah-item">
                Tambah Item
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm" id="tabel-item">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nama</th>
                  <th>Jumlah</th>
                  <th style="width: 40px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- content dinamis -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<div class="modal fade" id="tambah-item">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Default Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-item" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="nama">Nama Obat</label>
            <select class="form-control form-control-sm select2-nama" style="width: 100%;" name="nama" id="nama">
              <option value="">Pilih Obat</option>
              <?php foreach ($semuaObat as $obat) : ?>
                <option value="<?= $obat['id'] ?>"><?= $obat['nama'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="qty">Jumlah</label>
            <input type="number" min="1" id="qty" name="qty" class="form-control form-control-sm">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Simpan</button>
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
    $('.select2-dokter').select2()
    $('.select2-nama').select2()
  })

  // init date picker
  $('#tgl_pengeluaran').datetimepicker({
      format: 'YYYY-MM-DD',
      defaultDate: new Date(),
      locale: 'id'
  });

  // init toast
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  const itemObat = [];
  const modal = new bootstrap.Modal(document.getElementById('tambah-item'));
  const tabel = document.querySelector('#tabel-item tbody');

  const showItemObat = () => {
    if (itemObat.length === 0) {
      while (tabel.hasChildNodes()) {
        tabel.removeChild(tabel.firstChild);
      }

      const tr = document.createElement('tr');
      const td = document.createElement('td');
      td.setAttribute('colspan', '8');
      td.setAttribute('class', 'text-center');
      td.innerText = "Belum ada item obat";

      tr.appendChild(td);
      tabel.appendChild(tr);
    } else {
      while (tabel.hasChildNodes()) {
        tabel.removeChild(tabel.firstChild);
      }
      
      itemObat.forEach((item, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>${index + 1}</td>
          <td>${item.namaObat}</td>
          <td>${item.qty}</td>
          <td><span class="badge bg-danger delete-item" data-index="${index}" style="cursor: pointer">X</span></td>
        `;

        tabel.appendChild(tr);
      });

      const deleteItemButton = document.querySelectorAll('.delete-item');
      deleteItemButton.forEach(button => {
        button.addEventListener('click', () => {
          indexItem = button.dataset.index;

          deleteItem(indexItem);
        })
      })
    }
  }
  
  document.addEventListener('DOMContentLoaded', () => {
    showItemObat();
  });

  // cek stok Obat
  const formItem = document.querySelector('#form-item');
  const cekStok = async () => {
    const idObat = formItem.nama.value;
    const namaObat = formItem.nama.options[nama.selectedIndex].text;
    const qty = formItem.qty.value;

    try {
      const response = await fetch(`<?= base_url() ?>/persediaan/stok/${idObat}`, {
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest"
        }
      });

      const data = await response.json();
      const stok = await data[0]['qty'];
      const sisa = stok - qty;
      
      if (sisa < 0) {
        Toast.fire({
          icon: 'error',
          title: 'Stok obat tidak mencukupi.'
        });
      } else {
        addItemObat(idObat, namaObat, qty);
      }
    } catch (err) {
      console.log(err);
    }
  }

  // tambah item obat
  const addItemObat = (idObat, namaObat, qty) => {
    itemObat.push({idObat: idObat, namaObat: namaObat, qty: qty});
    
    showItemObat();

    Toast.fire({
      icon: 'success',
      title: 'Item berhasil ditambah.'
    });

    formItem.reset();
    $('.select2-nama').val(null).trigger('change');
  }

  // delete item
  const deleteItem = (index) => {
    itemObat.splice(index, 1);
    
    showItemObat();
  }

  // format data obat yang harus dikeluarkan
  const obatKeluar = (obat) => {
    let table = `
      <table width=100% cellpadding=6 style="font-size: 10pt !important;">
        <thead>
          <th colspan="4">Obat Keluar</th>
        </thead>
        <tbody>
    `;

    obat.forEach(item => {
      table += `
        <tr>
          <td style="text-align:left">${item.nama_obat}</td>
          <td>${item.nomor_batch}</td>
          <td>${item.lokasi}</td>
          <td style="text-align:right">${item.qty}</td>
        </tr>
      `;
    });

    table += `
        </tbody>
      </table>
    `;

    return table;
  }

  // save pengeluaran
  const formPengeluaran = document.getElementById('form-pengeluaran');
  formPengeluaran.addEventListener('submit', async (e) => {
    e.preventDefault();

    const kd_pengeluaran = formPengeluaran.kd_pengeluaran.value;
    const tgl_pengeluaran = formPengeluaran.tgl_pengeluaran.value;
    const dokter = formPengeluaran.dokter.value;
    const jenis = document.querySelector('input[name=jenis]:checked').value;
    const petugas = formPengeluaran.petugas.value;
    const pasien = formPengeluaran.pasien.value;
    const umur = formPengeluaran.umur.value;
    const jk = document.querySelector('input[name=jk]:checked').value;
    const keterangan = formPengeluaran.keterangan.value;
    const items = itemObat;

    if (items.length <= 0) {
      Toast.fire({
        icon: 'error',
        title: 'Item obat masih kosong.'
      });
    } else {
      try {
        await fetch('<?= base_url() ?>/transaksi/pengeluaran', {
          method: "POST",
          body: JSON.stringify({ kd_pengeluaran, tgl_pengeluaran, dokter, jenis, petugas, pasien, umur, jk, keterangan, items }),
          headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
          }
        })
        .then(response => response.json())
        .then(data => {
          Swal.fire({
            title: `${data.message}.`,
            icon: 'success',
            html: obatKeluar(data.obat),
            showDenyButton: true,
            confirmButtonText: 'Cetak Laporan',
            denyButtonText: `Jangan Sekarang`,
            allowOutsideClick: false,
            allowEscapeKey: false
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = `<?= base_url('/transaksi/pengeluaran/laporan') ?>/${data.id}`;
            } else if (result.isDenied) {
              location.reload()
            }
          })
        });
      } catch (err) {
        console.log(err);
      }
    }
  });

  // validation
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        cekStok();
      }
    });
    $('#form-item').validate({
      rules: {
        nama: {
          required: true
        },
        qty: {
          required: true,
          number: true,
          min: 1
        }
      },
      messages: {
        nama: {
          required: "Silahkan pilih obat"
        },
        qty: {
          required: "Jumlah tidak boleh kosong",
          number: "Jumlah tidak valid",
          min: "Jumlah tidak boleh kurang dari 1"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
<?= $this->endSection() ?>