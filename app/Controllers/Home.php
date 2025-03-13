<?php

namespace App\Controllers;

use PDO;

class Home extends BaseController
{
    public function index()
    {
        return view('partials/dashboard');
    }
}
