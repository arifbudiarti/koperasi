<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    private $db1;

    public function __construct()
    {
        $this->db1 = \Config\Database::connect();
    }

    public function index()
    {
        $data['title'] = 'dashboard';
        $data['user'] = $this->userModels->findAll();
        // print_r($data);
        return view('login', $data);
    }

    public function register()
    {
        $data['title'] = 'dashboard';
        $data['user'] = $this->userModels->findAll();
        // print_r($data);
        return view('register', $data);
    }

    public function create()
    {
        $validation =  \Config\Services::validation();
        $add = array(
            'name'     => $this->request->getPost('name'),
            'username'     => $this->request->getPost('username'),
            'password'     => $this->request->getPost('password'),
            'nik'     => $this->request->getPost('nik'),
            'alamat'     => $this->request->getPost('alamat'),
            'email'     => $this->request->getPost('email'),
            'no_hp'     => $this->request->getPost('no_hp'),
        );
        if ($validation->run($add, 'register') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('register'));
        } else {
            $anggota = array(
                'no_anggota'     => $this->generateNoANggota(),
                'nama'     => $this->request->getPost('name'),
                'nik'     => $this->request->getPost('nik'),
                'alamat'     => $this->request->getPost('alamat'),
                'email'     => $this->request->getPost('email'),
                'no_hp'     => $this->request->getPost('no_hp'),
                'status'     => 1
            );
            $simpan = $this->anggotaModels->insert($anggota);
            print_r($anggota);
            if ($simpan) { // ada data anggota -> create user
                $users = array(
                    'id_anggota'     => $simpan,
                    'username'     => $this->request->getPost('username'),
                    'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'status'     => 1
                );
                print_r($users);
                $simpanUsers = $this->userModels->save($users);
                if ($simpanUsers) {
                    session()->setFlashdata('success', 'Add Agenda Successfully');
                    return redirect()->to(base_url('login'));
                }
            }
        }
    }

    public function authcheck()
    {
        $validation =  \Config\Services::validation();

        $username  = $this->request->getPost('username');
        $password   = $this->request->getPost('password');

        $data = [
            'username' => $username,
            'password' => $password
            //'remember' => $remember
        ];

        //print_r($data);

        if ($validation->run($data, 'authlogin') == FALSE) {
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to('login');
        } else {
            // $cek_login = $this->db1->query("SELECT * FROM mt_users WHERE username='" . $username . "' AND status=1 LIMIT 1 ")->getRowArray();
            $cekAuth = $this->userModels->where('username', $username)->where('status', 1)->first();
            // print_r($cekAuth['id_anggota']);
            if (!empty($cekAuth) && !empty($cekAuth['id_anggota'])) {
                if (password_verify($password, $cekAuth['password'])) {
                    $anggota = $this->anggotaModels->find($cekAuth['id_anggota']);
                    session()->set('username', $cekAuth['username']);
                    session()->set('name', $anggota['nama']);
                    session()->set('idusers', $cekAuth['id']);
                    session()->set('idanggota', $cekAuth['id_anggota']);
                    session()->set('active', $cekAuth['status']);
                    session()->set('logged_in', TRUE);
                    $cekPetugas = $this->pegawaiModels->where('id_anggota', $cekAuth['id_anggota'])->where('status', 1)->first();
                    if (!empty($cekPetugas)) {
                        session()->set('admin', TRUE);
                    }
                    return redirect()->to('dashboard');
                } else {
                    session()->setFlashdata('errors', ['' => 'Username & Password tidak cocok']);
                    return redirect()->to('login');
                }
            } else {
                session()->setFlashdata('errors', ['' => 'Username & Password tidak cocok']);
                return redirect()->to('login');
            }
        }
    }

    private function generateNoANggota()
    {
        $noanggota = 0;
        $anggota = $this->db1->query("SELECT * FROM mt_anggota WHERE YEAR(created_at)=" . date('Y'))->getResult();
        // print_r(sizeof($anggota));
        if (sizeof($anggota) > 0) {
            $count = sizeof($anggota) + 1;
            if ($count > 0 && $count < 10) {
                $noanggota = date('y') . date('m') . '000' . $count;
            } elseif ($count > 9 && $count < 100) {
                $noanggota = date('y') . date('m') . '00' . $count;
            } else {
                $noanggota = date('y') . date('m') . '0' . $count;
            }
        } else {
            $noanggota = date('y') . date('m') . '0001';
        }
        return $noanggota;
    }

    public function logout()
    {
        //update table users
        session()->destroy();
        return redirect()->to('login');
    }

    public function list()
    {
        $data['title'] = 'Users';
        $data['user'] = $this->db1->query("SELECT * FROM v_user")->getResult();
        return view('pages/user', $data);
    }

    public function usercreate()
    {
        $data['title'] = 'Anggota';
        $data['anggota'] = $this->anggotaModels->where('status', 1)->findAll();
        $validation =  \Config\Services::validation();
        $add = array(
            'id_anggota'     => $this->request->getPost('id_anggota'),
            'username'     => $this->request->getPost('username'),
            'password'     => $this->request->getPost('password')
        );
        if ($validation->run($add, 'useradd') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/usercreate', $data);
        } else {
            $add['created_by'] = session()->get('idusers');
            $add['updated_id'] = session()->get('idusers');
            $add['status'] = 1;
            $simpan = $this->userModels->insert($add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Add Users Successfully');
                return redirect()->to(base_url('anggota'));
            }
        }
        // print_r($data);
        return view('pages/usercreate', $data);
    }

    public function useredit($id)
    {
        $validation =  \Config\Services::validation();
        $data['title'] = 'Users';
        $data['edit'] = 1;
        $data['user'] = $this->userModels->find($id);
        $add = array(
            'id_anggota'     => $this->request->getPost('id_anggota'),
            'username'     => $this->request->getPost('username'),
            'password'     => $this->request->getPost('password')
        );
        if ($validation->run($add, 'useradd') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/usercreate', $data);
        } else {
            $add['updated_id'] = session()->get('idusers');
            $simpan = $this->userModels->update($id, $add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Update Users Successfully');
                return redirect()->to(base_url('users'));
            }
        }
    }

    public function userdelete($id)
    {
        $data = $this->userModels->find($id);
        if (!empty($data)) {
            $update['deleted_id'] = session()->get('idusers');
            $update['deleted_at'] = date('Y-m-d H:i:s');
            $this->userModels->update($id, $update);
            session()->setFlashdata('success', 'Users deleted Successfully');
            return redirect()->back();
        } else {
            session()->setFlashdata('warning', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function anggota()
    {
        $data['title'] = 'Users - Anggota';
        $data['anggota'] = $this->anggotaModels->findAll();
        return view('pages/anggota', $data);
    }

    public function anggotacreate()
    {
        $data['title'] = 'Anggota';
        $validation =  \Config\Services::validation();
        $add = array(
            'nama'     => $this->request->getPost('name') . ' ' . $this->request->getPost('name2'),
            'nik'     => $this->request->getPost('nik'),
            'alamat'     => $this->request->getPost('alamat'),
            'jenis_kelamin'     => $this->request->getPost('jenis_kelamin'),
            'email'     => $this->request->getPost('email'),
            'no_hp'     => $this->request->getPost('no_hp')
        );
        if ($validation->run($add, 'anggota') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/anggotacreate', $data);
        } else {
            $add['no_anggota'] = $this->generateNoANggota();
            $add['created_by'] = session()->get('idusers');
            $add['updated_id'] = session()->get('idusers');
            $add['status'] = 1;
            $simpan = $this->anggotaModels->insert($add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Add Anggota Successfully');
                return redirect()->to(base_url('anggota'));
            }
        }
        // print_r($data);
        return view('pages/anggotacreate', $data);
    }

    public function anggotaedit($id)
    {
        $validation =  \Config\Services::validation();
        $data['title'] = 'Users';
        $data['edit'] = 1;
        $data['anggota'] = $this->anggotaModels->find($id);
        $add = array(
            'nama'     => $this->request->getPost('name'),
            'nik'     => $this->request->getPost('nik'),
            'alamat'     => $this->request->getPost('alamat'),
            'jenis_kelamin'     => $this->request->getPost('jenis_kelamin'),
            'email'     => $this->request->getPost('email'),
            'no_hp'     => $this->request->getPost('no_hp')
        );
        if ($validation->run($add, 'anggota') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/anggotacreate', $data);
        } else {
            $add['updated_id'] = session()->get('idusers');
            $simpan = $this->anggotaModels->update($id, $add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Update Anggota Successfully');
                return redirect()->to(base_url('anggota'));
            }
        }
    }

    public function anggotadelete($id)
    {
        $data = $this->anggotaModels->find($id);
        if (!empty($data)) {
            $update['deleted_id'] = session()->get('idusers');
            $update['deleted_at'] = date('Y-m-d H:i:s');
            $this->anggotaModels->update($id, $update);
            session()->setFlashdata('success', 'Anggota deleted Successfully');
            return redirect()->back();
        } else {
            session()->setFlashdata('warning', 'Data Not Found');
            return redirect()->back();
        }
    }

    public function petugas()
    {
        $data['title'] = 'User - Data Petugas';
        $data['petugas'] = $this->db1->query("SELECT * FROM v_petugas")->getResultArray();
        // $data['petugas'] = $this->pegawaiModels->findAll();
        return view('pages/petugas', $data);
    }

    public function petugascreate()
    {
        $data['title'] = 'Anggota';
        $validation =  \Config\Services::validation();
        $data['anggota'] = $this->anggotaModels->findAll();
        $add = array(
            'id_anggota'     => $this->request->getPost('id_anggota'),
            'tmt'     => $this->request->getPost('tmt')
        );
        if ($validation->run($add, 'petugas') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/petugascreate', $data);
        } else {
            $add['nip'] = $this->generateNip($add['id_anggota']);
            $add['created_by'] = session()->get('idusers');
            $add['updated_id'] = session()->get('idusers');
            $add['status'] = 1;
            $simpan = $this->pegawaiModels->insert($add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Add PEtugas Successfully');
                return redirect()->to(base_url('petugas'));
            }
        }
        // print_r($data);
        return view('pages/petugascreate', $data);
    }

    public function petugasedit($id)
    {
        $validation =  \Config\Services::validation();
        $data['title'] = 'Users';
        $data['edit'] = 1;
        $data['petugas'] = $this->pegawaiModels->find($id);
        $add = array(
            'id_anggota'     => $this->request->getPost('id_anggota'),
            'tmt'     => $this->request->getPost('tmt')
        );
        if ($validation->run($add, 'petugas') == FALSE) {
            // session()->setFlashdata('inputs', $this->request->getPost());
            // session()->setFlashdata('errors', $validation->getErrors());
            return view('pages/petugascreate', $data);
        } else {
            $add['updated_id'] = session()->get('idusers');
            $simpan = $this->pegawaiModels->update($id, $add);
            // print_r($simpan);
            if ($simpan) { // ada data anggota -> create user
                session()->setFlashdata('success', 'Update PEtugas Successfully');
                return redirect()->to(base_url('petugas'));
            }
        }
    }

    public function petugasdelete($id)
    {
        $data = $this->pegawaiModels->find($id);
        if (!empty($data)) {
            $update['deleted_id'] = session()->get('idusers');
            $update['deleted_at'] = date('Y-m-d H:i:s');
            $this->pegawaiModels->update($id, $update);
            session()->setFlashdata('success', 'Anggota Petugas Successfully');
            return redirect()->back();
        } else {
            session()->setFlashdata('warning', 'Data Not Found');
            return redirect()->back();
        }
    }

    private function generateNip($id)
    {
        $nip = 0;
        // $anggota = $this->anggotaModels->find($id);
        // print_r($anggota);
        $petugas = $this->db1->query("SELECT * FROM mt_petugas WHERE YEAR(created_at)=" . date('Y'))->getResult();
        // print_r(sizeof($anggota));
        if (sizeof($petugas) > 0) {
            $count = sizeof($petugas) + 1;
            if ($count > 0 && $count < 10) {
                $nip = 'KSP' . $id . date('y') . date('m') . '000' . $count;
            } elseif ($count > 9 && $count < 100) {
                $nip = 'KSP' . $id . date('y') . date('m') . '00' . $count;
            } else {
                $nip = 'KSP' . $id . date('y') . date('m') . '0' . $count;
            }
        } else {
            $nip = 'KSP' . $id . date('y') . date('m') . '0001';
        }
        return $nip;
    }
}
