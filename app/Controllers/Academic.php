<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Academic extends BaseController
{
    public function index()
    {
        $parser = service('parser');

        $data = ['title' => 'Course List'];
        $data['content'] = $parser->setData($data)->render("academic/course_list", ['cache' => 86400, 'cache_name' => 'course_list']);
        
        return view('academic/course_list', $data);
    }
    
    public function statistic(){
        $parser = service('parser');
        
        $data = ['title' => 'Academic Statistics'];
        $data['content'] = $parser->setData($data)->render("academic/statistics", ['cache' => 3600, 'cache_name' => 'statistics']);

        return view('academic/statistics', $data);
    }
}
