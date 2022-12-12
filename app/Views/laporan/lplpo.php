<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemakaian dan Lembar Permintaan Obat</title>

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
          <h3 style="text-transform: uppercase">Laporan Pemakaian dan Lembar Permintaan Obat<br>(LPLPO)</h3>
        </tr>
      </tbody>
    </table>

    <!-- HEADER -->
    <table border=0 width=100% cellpadding=2 cellspacing=0 style="margin-top: 20px; font-size: 10pt;">
      <tbody>
        <tr>
          <td style="text-transform: uppercase" width=20%><strong>Kode Puskesmas</strong></td>
          <td style="text-transform: uppercase" width=50%><strong>:</strong></td>
          <td style="text-transform: uppercase" width=10%><strong>Bulan</strong></td>
          <td style="text-transform: uppercase" width=20%><strong>: <?= $pemesanan['bulan'] ?></strong></td>
        </tr>
        <tr>
          <td style="text-transform: uppercase" width=20%><strong>Puskesmas</strong></td>
          <td style="text-transform: uppercase" width=50%><strong>: Keritang Hulu</strong></td>
          <td style="text-transform: uppercase" width=10%><strong>Tahun</strong></td>
          <td style="text-transform: uppercase" width=20%><strong>: <?= $pemesanan['tahun'] ?></strong></td>
        </tr>
        <tr>
          <td style="text-transform: uppercase" width=20%><strong>Kecamatan</strong></td>
          <td style="text-transform: uppercase" width=50%><strong>: Kemuning</strong></td>
        </tr>
        <tr>
          <td style="text-transform: uppercase" width=20%><strong>Kabupaten</strong></td>
          <td style="text-transform: uppercase" width=50%><strong>: Indragiri Hilir</strong></td>
        </tr>
        <tr>
          <td style="text-transform: uppercase" width=20%><strong>Provinsi</strong></td>
          <td style="text-transform: uppercase" width=50%><strong>: Riau</strong></td>
        </tr>
      </tbody>
    </table>
    
    <!-- BODY -->
    <table border=1 width=100% cellpadding=2 cellspacing=0 style="margin-top: 30px; font-size: 8pt;">
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
                <td style="text-align:center"><?= $key + 1; ?></td>
                <td><?= $data->nama; ?></td>
                <td style="text-align:center"><?= $data->satuan; ?></td>
                <td style="text-align:right"><?= $data->stock_awal; ?></td>
                <td style="text-align:right"><?= $data->total_penerimaan; ?></td>
                <td style="text-align:right"><?= $data->persediaan; ?></td>
                <td style="text-align:right"><?= $data->total_pengeluaran; ?></td>
                <td style="text-align:right"><?= $data->sisa_stock; ?></td>
                <td style="text-align:right"><?= $data->permintaan; ?></td>
                <td style="text-align:right">
                  
                </td>
                <td style="text-align:right"></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- FOOTER -->
    <table border=1 width=60% cellpadding=2 cellspacing=0 style="margin-top: 30px; text-align:center; font-size: 10pt;">
      <thead>
        <tr>
          <th rowspan="2" style="text-transform: uppercase">Jumlah Kunjungan</th>
          <th width="17%" style="text-transform: uppercase">Umum</th>
          <th width="17%" style="text-transform: uppercase">BPJS/JKN</th>
          <th width="17%" style="text-transform: uppercase">JAMKESDA</th>
          <th width="17%" style="text-transform: uppercase">Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?= $pemesanan['umum'] ?></td>
          <td><?= $pemesanan['bpjs'] ?></td>
          <td><?= $pemesanan['jamkesda'] ?></td>
          <td><?= array_sum([$pemesanan['umum'], $pemesanan['bpjs'], $pemesanan['jamkesda']]) ?></td>
        </tr>
      </tbody>
    </table>

    <!-- TANDA TANGAN -->
    <table border=0 width=100% style="margin-top: 30px; font-size: 10pt;">
      <tbody>
        <tr style="text-transform: uppercase">
          <td width=70%>Mengetahui,</td>
          <td>Keritang Hulu, <?= $pemesanan['tgl_dokumen'] ?></td>
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