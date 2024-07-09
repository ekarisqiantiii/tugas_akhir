<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use App\Models\PegawaiModel;

class BackendPegawai extends BaseController
{
    public function getPegawaiData()
    {
        $pegawaiModel = new PegawaiModel();
        $data['pegawai'] = $pegawaiModel->findAll();

        return $this->response->setJSON($data);
    }

    public function create()
    {
        $pegawaiModel = new PegawaiModel();
        $data = $this->request->getPost();

        if ($pegawaiModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => $pegawaiModel->errors()]);
        }
    }

    public function update($username)
    {
        $pegawaiModel = new PegawaiModel();
        $data = $this->request->getRawInput();

        if ($pegawaiModel->update($username, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil diupdate']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => $pegawaiModel->errors()]);
        }
    }

    public function delete($username)
    {
        $pegawaiModel = new PegawaiModel();

        if ($pegawaiModel->delete($username)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data gagal dihapus']);
        }
    }
}
