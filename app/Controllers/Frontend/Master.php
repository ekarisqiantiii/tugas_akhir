<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use Config\Services;

class Master extends BaseController
{
    public function pegawai()
    {
        $client = Services::curlrequest();
        $response = $client->get(site_url('backend/backendpegawai/getPegawaiData'));
        $data['pegawai'] = json_decode($response->getBody(), true);

        return view('frontend/pegawai', $data);
    }
}
