<?php

namespace App\Controllers;

class Support {
  protected $bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
		);

  public function tanggalIndoFull($tanggal)
  { 
    $split = explode('-', $tanggal);
	  return $split[2] . ' ' . $this->bulan[ (int)$split[1] ] . ' ' . $split[0];
  }

  public function bulanIndo($bulan)
  {
    return $this->bulan[(int)$bulan];
  }

	public function tanggalExpired($tanggal)
	{
		$expired = date_create($tanggal);
		return date_format($expired, 'm-Y');
	}

	public function generateKode($jenis, $table, $fieldKode)
  {
    $db      = \Config\Database::connect();
    $builder = $db->table($table);
    $builder->select('RIGHT('.$fieldKode.', 4) as kode', false);
    $builder->orderBy($fieldKode, 'DESC');
    $builder->limit(1);
    $query = $builder->get();
    $row = $query->getRow();
    
    if (isset($row)) {
        $kode = $row->kode + 1;
    } else {
        $kode = 1;
    }

    $lastKode = str_pad($kode, 4, "0", STR_PAD_LEFT);
    $month = date('m');
    $year = date('y');

		$jenisKode = null;

		switch ($jenis) {
			case 'obat':
				$jenisKode = 'OB';
				break;
			case 'pemesanan':
				$jenisKode = 'TP';
				break;
			case 'penerimaan':
				$jenisKode = 'TM';
				break;
			case 'pengeluaran':
				$jenisKode = 'TK';
				break;
			case 'perubahan':
				$jenisKode = 'SA';
				break;
			default:
				break;
		}

		if ($jenis == 'obat') {
			return $newKode = $jenisKode . $lastKode;
		}

    $newKode = $jenisKode . $year . $month . $lastKode;

    return $newKode;
  }
}