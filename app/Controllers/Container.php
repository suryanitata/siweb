<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Container extends BaseController
{
    public function index()
    {
        return view('Admin/Container');
    }
}
