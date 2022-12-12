<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perubahah Lokasi Obat</title>

    <style>
      * {
        font-family: Arial, Helvetica, sans-serif;
      }

      img {
        width: 70px;
      }

      h2, h3, h4, .alamat-kop {
        margin-top: 0;
        margin-bottom: 0;
      }

      .kop {
        padding-bottom: 10px;
        border-bottom: 5px solid black;
      }
    </style>
</head>

<body>
    <!-- KOP SURAT -->
    <table class="kop" width=100% style="text-align:center">
      <tbody>
        <tr>
          <td><img src="<?= base_url() ?>/public/assets/img/logo-inhil.png"></td>
          <td>
            <h4 style="text-transform: uppercase">Pemerintah Kabupaten Indragiri Hilir</h4>
            <h2 style="text-transform: uppercase">Dinas Kesehatan</h2>
            <h3 style="text-transform: uppercase">UPT Puskesmas Keritang Hulu</h3>
            <p class="alamat-kop">
              Jl. Lintas Sumatra, Kec. Kemuning, Kabupaten Indragiri Hilir, Riau, Kode Pos 29274
            </p>
          </td>
          <td><img src="<?= base_url() ?>/public/assets/img/logo.png"></td>
        </tr>
      </tbody>
    </table>

    <!-- TITLE -->
    <table border=0 width=100% style="text-align:center; margin-top: 20px;">
      <tbody>
        <tr>
          <h3 style="text-transform: uppercase">Laporan Perubahan Lokasi Obat</h3>
          <span>(Gudang ke Apotek)</span><br>
          <span>Tanggal Perubahan: <?= $tanggal ?></span>
        </tr>
      </tbody>
    </table>
    
    <!-- BODY -->
    <table border=1 width=100% cellpadding=4 cellspacing=0 style="margin-top: 30px; font-size: 9pt;">
        <thead>
            <tr bgcolor=silver align=center>
                <th style="text-transform: uppercase" width="5%">No</th>
                <th style="text-transform: uppercase" width="10%">Kode Perubahan</th>
                <th style="text-transform: uppercase" width="10%">Kode Obat</th>
                <th style="text-transform: uppercase" width="35%">Nama Obat</th>
                <th style="text-transform: uppercase" width="10%">Satuan</th>
                <th style="text-transform: uppercase" width="25%">No Batch</th>
                <th style="text-transform: uppercase" width="10%">ED</th>
                <th style="text-transform: uppercase" width="20%">Lokasi / Rak</th>
                <th style="text-transform: uppercase" width="8%">QTY</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($perubahan as $key => $data) :?>
            <tr>
              <td><?= $key + 1; ?></td>
              <td><?= $data->kd_perubahan; ?></td>
              <td><?= $data->kd_obat; ?></td>
              <td><?= $data->nama; ?></td>
              <td><?= $data->satuan; ?></td>
              <td><?= $data->no_batch; ?></td>
              <td style="text-align:right"><?= $data->expired; ?></td>
              <td><?= $data->lokasi; ?></td>
              <td style="text-align:right"><?= $data->qty; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>

    <!-- TANDA TANGAN -->
    <table border=0 width=100% style="margin-top: 30px; font-size: 10pt;">
      <tbody>
        <tr style="text-transform: uppercase">
          <td width=70%>Mengetahui,</td>
          <td>Keritang Hulu, <?= $tanggalLaporan ?></td>
        </tr>
        <tr style="text-transform: uppercase">
          <td>Kepala UPT Puskesmas</td>
          <td>Pengelola LPLPO Apotek</td>
        </tr>
        <tr><td colspan=2 style="height: 60px"></td></tr>
        <tr>
          <td>
            <u><?= $kepalaPuskesmas['nama'] ?></u>
            <br>
            NIP: <?= explode('/', $kepalaPuskesmas['nip'])[0] ?>
          </td>
          <td><?= $petugasFarmasi['nama'] ?></td>
        </tr>
      </tbody>
    </table>
</body>
</html>