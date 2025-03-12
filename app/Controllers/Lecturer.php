<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Lecturer extends BaseController
{
    public function dashboard()
    {

        return view('partials/dashboard');
    }
}
