<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Airplane;

class AirplaneController extends BaseController
{
    public function index()
    {
        //model initialize
        $airplaneModel = new Airplane();

        //pager initialize
        $pager = \Config\Services::pager();

        $data = array(
            'airplanes' => $airplaneModel->paginate(5, 'post'),
            'pager' => $airplaneModel->pager
        );

        return view('Airplanes\index', $data);
    }
}
