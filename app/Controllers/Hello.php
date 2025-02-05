<?php

namespace App\Controllers;

use App\Models\Hello_model;

class Hello extends BaseController
{
    public function index()
    {
        echo ('Hello World!');
    }

    public function hello_model()
    {
        $helloModel = new Hello_model();
        $data = $helloModel->hello();
        return $data;
    }

    public function hello_view()
    {
        return view('v_hello');
    }

    public function hello_mvc()
    {
        $helloModel = new Hello_model();
        $data = $helloModel->hello();

        return view('v_hellomvc', ['message' => $data]);
    }
}
