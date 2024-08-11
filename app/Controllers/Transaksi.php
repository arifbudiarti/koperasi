<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;

class Transaksi extends BaseController
{
    private $db1;

    public function __construct()
    {
        $this->db1 = \Config\Database::connect();
    }

    public function index()
    {
        //
    }

    public function simpan()
    {
        $data['title'] = 'Transaksi - Simpan';
        if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) {
            $data['dashboard'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_transaksi)=MONTH(CURDATE()) AND deleted_at IS NULL then nominal else 0 end) as simpan_bulan, SUM(case when deleted_at IS NULL then nominal else 0 end) as simpan_total FROM tc_simpan")->getResultArray();
            $data['simpan'] = $this->db1->query("SELECT * FROM v_simpan")->getResult();
        } else {
            $id_anggota = session()->get('idanggota');
            // print_r($id_anggota);
            // die();
            $data['dashboard'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_transaksi)=MONTH(CURDATE()) AND deleted_at IS NULL then nominal else 0 end) as simpan_bulan, SUM(case when deleted_at IS NULL then nominal else 0 end) as simpan_total FROM tc_simpan WHERE id_anggota=" . $id_anggota)->getResultArray();
            $data['simpan'] = $this->db1->query("SELECT * FROM v_simpan WHERE id=" . $id_anggota)->getResult();
        }
        // print_r($data['simpan']);
        return view('pages/simpan', $data);
    }

    public function simpandetail($id)
    {
        $data['title'] = 'Transaksi - Simpan';
        $data['dashboard'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_transaksi)=MONTH(CURDATE()) AND deleted_at IS NULL then nominal else 0 end) as simpan_bulan, SUM(case when deleted_at IS NULL then nominal else 0 end) as simpan_total FROM tc_simpan WHERE id_anggota=" . $id)->getResultArray();
        $data['simpan'] = $this->simpanModels->where('status', 1)->where('id_anggota', $id)->findAll();

        if (!$data['simpan']) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('pages/simpandetail', $data);
    }

    public function simpancreate()
    {
        $data['title'] = 'Transaksi - Simpan';
        $data['anggota'] = $this->anggotaModels->where('status', 1)->findAll();
        $validation =  \Config\Services::validation();
        $add = array(
            'tgl_transaksi'     => $this->request->getPost('tgl_transaksi'),
            'nominal'     => $this->request->getPost('nominal'),
            'id_anggota'     => $this->request->getPost('id_anggota')
        );
        if ($validation->run($add, 'simpanadd') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/simpancreate', $data);
        } else {
            $add['created_by'] = session()->get('idusers');
            $add['updated_id'] = session()->get('idusers');
            $add['status'] = 1;
            $simpan = $this->simpanModels->insert($add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Add Simpanan Successfully');
                return redirect()->to(base_url('simpan'));
            }
        }
        // print_r($data);
        return view('pages/simpancreate', $data);
    }

    public function simpanedit($id)
    {
        $validation =  \Config\Services::validation();
        $data['title'] = 'Transaksi - Simpan';
        $data['edit'] = 1;
        $data['simpan'] = $this->simpanModels->find($id);
        $add = array(
            'tgl_transaksi'     => $this->request->getPost('tgl_transaksi'),
            'nominal'     => $this->request->getPost('nominal'),
            'id_anggota'     => $this->request->getPost('id_anggota')
        );
        if ($validation->run($add, 'simpanadd') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/simpancreate', $data);
        } else {
            $add['updated_id'] = session()->get('idusers');
            $simpan = $this->simpanModels->update($id, $add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Update Simpanan Successfully');
                return redirect()->to(base_url('simpan'));
            }
        }
    }

    public function simpandelete($id)
    {
        $data = $this->simpanModels->find($id);
        if (!empty($data)) {
            $anggota = $data['id_anggota'];
            $update['deleted_id'] = session()->get('idusers');
            $update['deleted_at'] = date('Y-m-d H:i:s');
            $update['status'] = 99;
            $this->simpanModels->update($id, $update);
            session()->setFlashdata('success', 'Simpanan deleted Successfully');
            return redirect()->back();
        } else {
            session()->setFlashdata('warning', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function pinjam()
    {
        $data['title'] = 'Transaksi - Peminjaman';
        if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) {
            $data['dashboard'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_peminjaman)=MONTH(CURDATE()) AND deleted_at IS NULL AND status=1 then total_peminjaman else 0 end) as pinjam_bulan, SUM(case when deleted_at IS NULL AND status=1 then total_peminjaman else 0 end) as pinjam_total FROM tc_pinjam")->getResultArray();
            $data['pinjam'] = $this->db1->query("SELECT * FROM v_pinjam")->getResult();
        } else {
            $id_anggota = session()->get('idanggota');
            // print_r($id_anggota);
            // die();
            $data['dashboard'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_peminjaman)=MONTH(CURDATE()) AND deleted_at IS NULL AND status=1 then total_peminjaman else 0 end) as pinjam_bulan, SUM(case when deleted_at IS NULL AND status=1 then total_peminjaman else 0 end) as pinjam_total FROM tc_pinjam WHERE id_anggota=" . $id_anggota)->getResultArray();
            $data['pinjam'] = $this->db1->query("SELECT * FROM v_pinjam WHERE id_anggota=" . $id_anggota)->getResult();
        }
        return view('pages/pinjam', $data);
    }

    public function pinjamdetail($id)
    {
        $data['title'] = 'Transaksi - Simpan';
        $data['dashboard'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_peminjaman)=MONTH(CURDATE()) AND deleted_at IS NULL AND status=1 then total_peminjaman else 0 end) as pinjam_bulan, SUM(case when deleted_at IS NULL AND status=1  then total_peminjaman else 0 end) as pinjam_total FROM tc_pinjam WHERE id_anggota=" . $id)->getResultArray();
        $data['simpan'] = $this->pinjamModels->where('status', 1)->where('id_anggota', $id)->findAll();

        if (!$data['simpan']) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('pages/pinjamdetail', $data);
    }

    public function pinjamcreate()
    {
        $data['title'] = 'Transaksi - Simpan';
        $data['useranggota'] = $this->anggotaModels->find(session()->get('idanggota'));
        $data['anggota'] = $this->anggotaModels->where('status', 1)->findAll();
        $validation =  \Config\Services::validation();
        $add = array(
            'tgl_peminjaman'     => $this->request->getPost('tgl_peminjaman'),
            'kredit'     => $this->request->getPost('kredit'),
            'id_anggota'     => $this->request->getPost('id_anggota'),
            'bunga'     => $this->request->getPost('bunga'),
            'pokok_peminjaman'     => $this->request->getPost('pokok_peminjaman'),
            'pokok_bunga'     => $this->request->getPost('pokok_bunga'),
            'pokok_cicilan'     => $this->request->getPost('pokok_cicilan'),
            'total_cicilan'     => $this->request->getPost('total_cicilan'),
            'total_peminjaman'     => $this->request->getPost('total_peminjaman')
        );
        if ($validation->run($add, 'pinjamadd') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/pinjamcreate', $data);
        } else {
            $add['created_by'] = session()->get('idusers');
            $add['updated_id'] = session()->get('idusers');
            $add['status'] = 2;
            $simpan = $this->pinjamModels->insert($add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Add Peminjaman Successfully');
                return redirect()->to(base_url('pinjam'));
            }
        }
        // print_r($data);
        return view('pages/pinjamcreate', $data);
    }

    public function pinjamedit($id)
    {
        $validation =  \Config\Services::validation();
        $data['title'] = 'Transaksi - Simpan';
        $data['edit'] = 1;
        $data['pinjam'] = $this->pinjamModels->find($id);
        $add = array(
            'tgl_peminjaman'     => $this->request->getPost('tgl_peminjaman'),
            'kredit'     => $this->request->getPost('kredit'),
            'id_anggota'     => $this->request->getPost('id_anggota'),
            'bunga'     => $this->request->getPost('bunga'),
            'pokok_peminjaman'     => $this->request->getPost('pokok_peminjaman'),
            'pokok_bunga'     => $this->request->getPost('pokok_bunga'),
            'pokok_cicilan'     => $this->request->getPost('pokok_cicilan'),
            'total_cicilan'     => $this->request->getPost('total_cicilan'),
            'total_peminjaman'     => $this->request->getPost('total_peminjaman')
        );
        if ($validation->run($add, 'pinjamadd') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/pinjamcreate', $data);
        } else {
            $add['updated_id'] = session()->get('idusers');
            $simpan = $this->pinjamModels->update($id, $add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Update Peminjaman Successfully');
                return redirect()->to(base_url('pinjam'));
            }
        }
    }

    public function pinjamdelete($id)
    {
        $data = $this->pinjamModels->find($id);
        if (!empty($data)) {
            // $anggota = $data['id_anggota'];
            $update['id'] = $id;
            $update['status'] = 99;
            $update['deleted_id'] = session()->get('idusers');
            $update['deleted_at'] = date('Y-m-d H:i:s');
            $this->pinjamModels->update($id, $update);
            session()->setFlashdata('success', 'Simpanan deleted Successfully');
            return redirect()->back();
        } else {
            session()->setFlashdata('warning', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function pinjamacc($id)
    {
        $data = $this->pinjamModels->find($id);
        if (!empty($data)) {
            $update['updated_id'] = session()->get('idusers');
            $update['updated_at'] = date('Y-m-d H:i:s');
            $update['status'] = 1;
            $this->pinjamModels->update($id, $update);
            session()->setFlashdata('success', 'Simpanan telah di setujui');
            return redirect()->back();
        } else {
            session()->setFlashdata('warning', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function pinjamdec($id)
    {
        $data = $this->pinjamModels->find($id);
        if (!empty($data)) {
            $anggota = $data['id_anggota'];
            $update['updated_id'] = session()->get('idusers');
            $update['updated_at'] = date('Y-m-d H:i:s');
            $update['status'] = 99;
            $this->pinjamModels->update($id, $update);
            session()->setFlashdata('warning', 'Simpanan tidak disetujui');
            return redirect()->back();
        } else {
            session()->setFlashdata('warning', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function bayar()
    {
        $data['title'] = 'Transaksi - Pembayaran';
        if (session()->get('logged_in') == TRUE && session()->get('admin') == TRUE) {
            $data['dashboard'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_pembayaran)=MONTH(CURDATE()) AND deleted_at IS NULL then nominal else 0 end) as bayar_bulan, SUM(case when deleted_at IS NULL then nominal else 0 end) as bayar_total FROM tc_bayar")->getResultArray();
            $data['pinjam'] = $this->db1->query("SELECT * FROM v_pinjam")->getResult();
        } else {
            $id_anggota = session()->get('idanggota');
            $data['dashboard'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_pembayaran)=MONTH(CURDATE()) AND deleted_at IS NULL then nominal else 0 end) as bayar_bulan, SUM(case when deleted_at IS NULL then nominal else 0 end) as bayar_total FROM tc_bayar WHERE id_anggota=" . $id_anggota)->getResultArray();
            $data['bayar'] = $this->db1->query("SELECT * FROM v_bayar WHERE id_anggota=" . $id_anggota)->getResult();
            // $data['bayar'] = $this->angsuranModels->where('status', 1)->where('id_anggota', $id_anggota)->findAll();
        }
        return view('pages/bayar', $data);
    }

    public function bayardetail($idanggota, $id)
    {
        $data['title'] = 'Transaksi - Pembayaran';
        $data['id'] = $id;
        $data['idanggota'] = $idanggota;
        $data['dashboard'] = $this->db1->query("SELECT SUM(case when MONTH(tgl_pembayaran)=MONTH(CURDATE()) AND deleted_at IS NULL then nominal else 0 end) as bayar_bulan, SUM(case when deleted_at IS NULL then nominal else 0 end) as bayar_total FROM tc_bayar WHERE id_pinjam=" . $id)->getResultArray();
        $data['pinjam'] = $this->pinjamModels->where('status', 1)->where('id', $id)->first();
        $data['bayar'] = $this->angsuranModels->where('status', 1)->where('id_pinjam', $id)->findAll();
        // print_r($data['pinjam']);
        if (!$data['pinjam']) {
            throw PageNotFoundException::forPageNotFound();
        }
        return view('pages/bayardetail', $data);
    }

    public function bayarcreate($id, $idanggota)
    {
        $data['title'] = 'Transaksi - Simpan';
        $data['anggota'] = $this->anggotaModels->where('status', 1)->where('id', $idanggota)->first();
        $data['pinjam'] = $this->pinjamModels->where('status', 1)->where('id', $id)->first();
        $data['bayar'] = $this->angsuranModels->where('status', 1)->where('id_pinjam', $id)->countAll();
        // print_r($data['pinjam']);
        // die();
        $validation =  \Config\Services::validation();
        $add = array(
            'id_anggota'     => $this->request->getPost('id_anggota'),
            'kredit'     => $this->request->getPost('kredit'),
            'id_pinjam'     => $this->request->getPost('id_pinjam'),
            'nominal'     => $this->request->getPost('nominal'),
            'saldo'     => $this->request->getPost('saldo'),
            'sisa'     => $this->request->getPost('sisa'),
            'total'     => $this->request->getPost('total'),
            'tgl_pembayaran'     => $this->request->getPost('tgl_pembayaran')
        );
        if ($validation->run($add, 'bayar') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/bayarcreate', $data);
        } else {
            $addnew = $this->hitungSisa($add);
            // print_r($addnew);
            $simpan = $this->angsuranModels->insert($addnew);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Add Angsuran Successfully');
                return redirect()->to(base_url('bayar/' . $idanggota . '/' . $id . '/detail'));
            }
        }
        // print_r($data);
        return view('pages/bayarcreate', $data);
    }

    public function bayaredit($id)
    {
        $validation =  \Config\Services::validation();
        $data['title'] = 'Transaksi - Simpan';
        $data['edit'] = 1;
        $cicil = $this->angsuranModels->find($id);
        $data['cicil'] = $cicil;
        $add = array(
            'id_anggota'     => $this->request->getPost('id_anggota'),
            'kredit'     => $this->request->getPost('kredit'),
            'id_pinjam'     => $this->request->getPost('id_pinjam'),
            'nominal'     => $this->request->getPost('nominal'),
            'saldo'     => $this->request->getPost('saldo'),
            'sisa'     => $this->request->getPost('sisa'),
            'total'     => $this->request->getPost('total'),
            'tgl_pembayaran'     => $this->request->getPost('tgl_pembayaran')
        );
        if ($validation->run($add, 'pinjamadd') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/bayarcreate', $data);
        } else {
            $add['updated_id'] = session()->get('idusers');
            $simpan = $this->angsuranModels->update($id, $add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Update Angsuran Successfully');
                return redirect()->to(base_url('bayar/' . $cicil['id_anggota'] . '/' . $id . '/detail'));
            }
        }
    }

    public function bayardelete($id)
    {
        $data = $this->pinjamModels->find($id);
        if (!empty($data)) {
            $anggota = $data['id_anggota'];
            $update['deleted_id'] = session()->get('idusers');
            $update['deleted_at'] = date('Y-m-d H:i:s');
            $this->pinjamModels->update($id, $update);
            session()->setFlashdata('success', 'Simpanan deleted Successfully');
            return redirect()->back();
        } else {
            session()->setFlashdata('warning', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function hitungSisa($data)
    {
        // print_r($data);
        $saldo  = $data['kredit'] * $data['nominal'];
        $sisa = $data['total'] - $saldo;
        $add = array(
            'id_anggota'     => $data['id_anggota'],
            'kredit'     => $data['kredit'],
            'id_pinjam'     => $data['id_pinjam'],
            'nominal'     => $data['nominal'],
            'saldo'     => $saldo,
            'sisa'     => $sisa,
            'tgl_pembayaran'     => $data['tgl_pembayaran'],
        );
        return $add;
    }
}
