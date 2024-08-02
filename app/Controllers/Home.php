<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $db1;

    public function __construct()
    {
        $this->db1 = \Config\Database::connect();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';

        if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) {
            $data['simpan'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_transaksi)=MONTH(CURDATE()) AND deleted_at IS NULL then nominal else 0 end) as simpan_bulan, SUM(case when deleted_at IS NULL then nominal else 0 end) as simpan_total FROM tc_simpan")->getResultArray();
            $data['pinjam'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_peminjaman)=MONTH(CURDATE()) AND deleted_at IS NULL then total_peminjaman else 0 end) as pinjam_bulan, SUM(case when deleted_at IS NULL then total_peminjaman else 0 end) as pinjam_total FROM tc_pinjam")->getResultArray();
            $data['bayar'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_pembayaran)=MONTH(CURDATE()) AND deleted_at IS NULL then nominal else 0 end) as bayar_bulan, SUM(case when deleted_at IS NULL then nominal else 0 end) as bayar_total, SUM(case when deleted_at IS NULL then sisa else 0 end) as sisa_total FROM tc_bayar")->getResultArray();
        } else {
            $id_anggota = session()->get('idanggota');
            $data['simpan'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_transaksi)=MONTH(CURDATE()) AND deleted_at IS NULL then nominal else 0 end) as simpan_bulan, SUM(case when deleted_at IS NULL then nominal else 0 end) as simpan_total FROM tc_simpan WHERE id_anggota=" . $id_anggota)->getResultArray();
            $data['pinjam'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_peminjaman)=MONTH(CURDATE()) AND deleted_at IS NULL then total_peminjaman else 0 end) as pinjam_bulan, SUM(case when deleted_at IS NULL then total_peminjaman else 0 end) as pinjam_total FROM tc_pinjam WHERE id_anggota=" . $id_anggota)->getResultArray();
            $data['bayar'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_pembayaran)=MONTH(CURDATE()) AND deleted_at IS NULL then nominal else 0 end) as bayar_bulan, SUM(case when deleted_at IS NULL then nominal else 0 end) as bayar_total, SUM(case when deleted_at IS NULL then sisa else 0 end) as sisa_total FROM tc_bayar WHERE id_anggota=" . $id_anggota)->getResultArray();
        }
        // print_r($data['simpan']);
        return view('pages/dashboard', $data);
    }
}
