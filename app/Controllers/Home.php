<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard'
        ];
        return view('Admin/overview', $data);
        // echo view('layout/header');
        // echo view('layout/topbar');
        // echo view('layout/sidebar');
        // echo view('Admin/overview');
        // echo view('layout/footer');
    }

    public function about($nama = null, $umur = 0)
    {
        echo "Hai nama saya adalah $nama. Umur saya adalah $umur";
    }

    public function Bio()
    {
        return view('Home');
    }

    public function contact()
    {
        return view('Contact');
    }

    public function ab_us()
    {
        return view('About');
    }

    public function coba()
    {
        echo "Hey You!";
    }
}
