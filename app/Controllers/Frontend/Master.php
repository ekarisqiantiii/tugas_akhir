<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;

class Master extends BaseController
{
    public function index()
    {
        return view('frontend/template');
    }
}
