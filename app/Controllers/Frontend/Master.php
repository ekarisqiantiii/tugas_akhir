<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\CURLRequest;

class Master extends BaseController
{
    protected $client;

    public function __construct()
    {
        $this->client = \Config\Services::curlrequest();
    }

    public function pegawai()
    {
        $response = $this->client->request('GET', base_url('Backend/BackendPegawai'));
        $data['pegawai'] = json_decode($response->getBody(), true);
        return view('frontend/pegawai', $data);
    }
}
