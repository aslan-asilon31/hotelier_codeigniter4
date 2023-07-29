<?php

namespace App\Controllers\API;

use App\Controllers\BaseController;
use App\Models\Room;

class APIController extends BaseController
{
    protected $roomModel;
    
    public function __construct()
    {
        $this->roomModel = new Room();
    }

    // Method to handle GET request
    public function index()
    {
        $data = $this->roomModel->findAll();
        return $this->response->setJSON($data); // Use setJSON() to return JSON response
    }
}
