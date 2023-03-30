<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Tugas2 extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Tugas 2'
        ];
        return view('Tugas2/index', $data);
    }
}
