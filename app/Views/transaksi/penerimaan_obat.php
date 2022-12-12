<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Transaksi Penerimaan Obat</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Penerimaan Obat</li>
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
            <h5 class="m-0">Penerimaan Baru</h5>
          </div>
          <form id="form-penerimaan">
            <div class="card-body">
              <div class="form-group">
                <label for="kd_penerimaan">Kode Penerimaan</label>
                <input type="text" id="kd_penerimaan" name="kd_penerimaan" class="form-control" value="<?= $kodePenerimaan ?>" readonly required>
              </div>

              <div class="form-group">
                <label for="tgl_penerimaan">Tanggal Penerimaan</label>
                <div class="input-group date" id="tgl_penerimaan" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" name="tgl_penerimaan" data-target="#tgl_penerimaan" required/>
                    <div class="input-group-append" data-target="#tgl_penerimaan" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
              </div>

              <div class="form-group">
                <label for="sbbk">Nomor SBBK</label>
                <input type="text" id="sbbk" name="sbbk" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="petugas">Petugas</label>
                <input type="text" id="petugas" name="petugas" class="form-control" value="<?= user()->fullname ?>" readonly required>
              </div>

              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control" rows="3" id="keterangan" name="keterangan"></textarea>
              </div>
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success float-right">Simpan</button>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-8">
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
                  <th>Batch</th>
                  <th>Expire</th>
                  <th>Kategori</th>
                  <th>Lokasi</th>
                  <th>QTY</th>
                  <th style="width: 40px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- conten dinamis -->
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
        <h4 class="modal-title">Tambah item Obat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="item-form" method="post">
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
            <label for="batch">Nomor Batch</label>
            <input type="text" id="batch" name="batch" class="form-control form-control-sm" require>
          </div>

          <div class="form-group">
            <label for="tgl_expire">Tanggal Kadaluarsa</label>
            <div class="input-group date" id="tgl_expire" data-target-input="nearest">
                <input type="text" class="form-control form-control-sm datetimepicker-input" name="tgl_expire" data-target="#tgl_expire" require/>
                <div class="input-group-append" data-target="#tgl_expire" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
          </div>

          
          <div class="form-group">
            <label for="kategori">Kategori</label>
            <div class="form-check">
              <div class="row w-50">
                <div class="col-md-6">
                  <input class="form-check-input" type="radio" name="kategori" value="DINKES" checked>
                  <label class="form-check-label">DINKES</label>
                </div>
                <div class="col-md-6">
                  <input class="form-check-input" type="radio" value="JKN" name="kategori">
                  <label class="form-check-label">JKN</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="lokasi">Lokasi</label>
            <div class="row">
              <div class="col-3">
                <input type="text" id="lokasi" name="lokasi" value="Gudang" class="form-control form-control-sm" readonly>
              </div>
              <div class="col-1 text-center">
                <span class="align-middle">/</span>
              </div>
              <div class="col-8">
                <input type="text" id="rak" name="rak" class="form-control form-control-sm" placeholder="Lokasi Rak" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="qty">QTY</label>
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
    $('.select2-nama').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })

  // init date picker
  $('#tgl_penerimaan').datetimepicker({
      format: 'YYYY-MM-DD',
      defaultDate: new Date(),
      locale: 'id'
  });

  $('#tgl_expire').datetimepicker({
      format: 'YYYY-MM-DD',
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
  // const deleteItemButton = [];

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
          <td>${item.batch}</td>
          <td>${item.tgl_expire}</td>
          <td>${item.kategori}</td>
          <td>${item.lokasi}</td>
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

  // tambah item obat
  const formItem = document.querySelector('#item-form');
  
  const addItemObat = () => {
    const idObat = formItem.nama.value;
    const namaObat = formItem.nama.options[nama.selectedIndex].text;
    const batch = formItem.batch.value;
    const tgl_expire = formItem.tgl_expire.value;
    const kategori = document.querySelector('input[name=kategori]:checked').value;
    const lokasi = `${formItem.lokasi.value} / ${formItem.rak.value}`;
    const qty = formItem.qty.value;
    
    itemObat.push({idObat: idObat, namaObat: namaObat, batch: batch, tgl_expire: tgl_expire, kategori: kategori, lokasi: lokasi, qty: qty});
    
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

  // save penerimaan
  const formPenerimaan = document.getElementById('form-penerimaan');
  formPenerimaan.addEventListener('submit', async (e) => {
    e.preventDefault();

    const kd_penerimaan = formPenerimaan.kd_penerimaan.value;
    const tgl_penerimaan = formPenerimaan.tgl_penerimaan.value;
    const sbbk = formPenerimaan.sbbk.value;
    const petugas = formPenerimaan.petugas.value;
    const keterangan = formPenerimaan.keterangan.value;
    const items = itemObat;

    if (items.length <= 0) {
      Toast.fire({
        icon: 'error',
        title: 'Item obat masih kosong.'
      });
    } else {
      try {
        await fetch('<?= base_url() ?>/transaksi/penerimaan', {
          method: "POST",
          body: JSON.stringify({ kd_penerimaan, tgl_penerimaan, sbbk, petugas, keterangan, items }),
          headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
          }
        })
        .then(response => response.json())
        .then(data => {
          Swal.fire({
            title: `${data.message}, Cetak Laporan Transaksi Terakhir?`,
            icon: 'success',
            showDenyButton: true,
            confirmButtonText: 'Cetak',
            denyButtonText: `Jangan Sekarang`,
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = `<?= base_url('/transaksi/penerimaan/laporan') ?>/${data.id}`;
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

  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        addItemObat();
      }
    });
    $('#item-form').validate({
      rules: {
        nama: {
          required: true
        },
        batch: {
          required: true
        },
        tgl_expire: {
          required: true,
          date: true
        },
        lokasi: {
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
        batch: {
          required: "Nomor Batch tidak boleh kosong"
        },
        tgl_expire: {
          required: "Tanggal kadaluarsa tidak boleh kosong",
          date: "Tanggal tidak valid"
        },
        lokasi: {
          required: "Lokasi tidak boleh kosong"
        },
        rak: {
          required: "Rak tidak boleh kosong"
        },
        qty: {
          required: "QTY tidak boleh kosong",
          number: "QTY tidak valid",
          min: "QTY tidak boleh kurang dari 1"
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

<!-- perbaiki proses pengeluaran obat, harusnya menampilkan data obat yang akan dikeluarkan -->