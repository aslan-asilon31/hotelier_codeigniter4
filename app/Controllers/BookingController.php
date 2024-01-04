<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Amenity;
use App\Models\BedType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BookingController extends BaseController
{
    public function index()
    {
        $roomModel = new Room();
        $pager = \Config\Services::pager();

        $totalRecords = $roomModel->countAllResults();
        
        // Get paginated rooms with their associated room categories and amenities
        $rooms = $roomModel->join('room_categories', 'room_categories.id = rooms.room_category_id')
                        ->join('amenities', 'amenities.id = rooms.amenity_id', 'left') // Use left join if amenity_id is nullable
                        ->join('bed_types', 'bed_types.id = rooms.bed_type_id', 'left') // Use left join if amenity_id is nullable
                        ->select('rooms.*, room_categories.name as category_name, amenities.name as amenity_name, bed_types.name as bed_type_name')
                        ->paginate(5, 'room');

        // print_r($rooms);
        

        // ($rooms);

        $data = [
            'rooms' => $rooms,
            'pager' => $roomModel->pager,
        ];

        return view('Rooms\index', $data);
    }

    public function create()
    {
        $roomCategoryModel = new RoomCategory();
        $amenityModel = new Amenity();
        $bedTypeModel = new BedType();
        $data['roomCategories'] = $roomCategoryModel->findAll();
        $data['amenities'] = $amenityModel->findAll();
        $data['bedTypes'] = $bedTypeModel->findAll();
    
        return view('Rooms\create', $data);
    }

    
    public function store()
    {
        // Load helper form and URL
        helper(['form', 'url']);
         
        // Define validation rules
        $validationRules = [
            'room_category_id' => 'required',
            'amenity_id' => 'required',
            'bed_type_id' => 'required',
            'image' => [
                'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
                'errors' => [
                    'uploaded' => 'Please choose an image to upload.',
                    'max_size' => 'The image size should not exceed 1MB.',
                    'is_image' => 'Only image files (jpeg, png, gif) are allowed.',
                ],
            ],
        ];
    
        if (!$this->validate($validationRules)) {
            // Render view with error validation message
            return view('Rooms\create', [
                'validation' => $this->validator
            ]);
        } else {
            // Get the uploaded image file
            $image = $this->request->getFile('image');
    
            // Generate a random name for the image
            $imageName = $image->getRandomName();
    
            // Move the uploaded image to the 'uploads' directory
            $image->move(ROOTPATH . 'public/uploads/rooms', $imageName);
    
            // Model initialize
            $roomModel = new Room();
    
            // Insert data into the database
            $roomModel->insert([
                'room_category_id'   => $this->request->getPost('room_category_id'),
                'amenity_id' => $this->request->getPost('amenity_id'),
                'image' => $imageName,
                'bed_type_id' => $this->request->getPost('bed_type_id'),
                'name' => $this->request->getPost('name'),
                'image' => $this->request->getPost('image'),
                'type' => $this->request->getPost('type'),
            ]);
    
            // Flash message
            session()->setFlashdata('message', 'Room Berhasil Disimpan');
    
            return redirect()->to(base_url('rooms')); // Correct the route to 'posts'
        }
    }
    

        public function edit($id)
    {
        $roomCategoryModel = new RoomCategory();
        $amenityModel = new Amenity();
        $bedTypeModel = new BedType();
        $data['roomCategories'] = $roomCategoryModel->findAll();
        $data['amenities'] = $amenityModel->findAll();
        $data['bedTypes'] = $bedTypeModel->findAll();

        $roomModel = new Room();

        // Find the Room by ID
        $data['room'] = $roomModel->find($id);
        // var_dump($data['room']);

        return view('Rooms\edit', $data);
    }


    public function update($id)
{
    // Load necessary models
    $roomCategoryModel = new RoomCategory();
    $amenityModel = new Amenity();
    $bedTypeModel = new BedType();
    $roomModel = new Room();

    // Get the Room by ID
    $data['room'] = $roomModel->find($id);

    // Load helper form and URL
    helper(['form', 'url']);

    // Define validation rules
    $validationRules = [
        'room_category_id' => 'required',
        'amenity_id' => 'required',
        'bed_type_id' => 'required',
        'name' => 'required',
        'type' => 'required',
    ];

    // Check if a new image is uploaded
    $image = $this->request->getFile('image');
    if ($image->isValid() && !$image->hasMoved()) {
        $validationRules['image'] = 'uploaded[image]|mime_in[image,image/jpg,image/jpeg,image/png]';
    }

    // Validate the input data
    if (!$this->validate($validationRules)) {
        $roomModel = new Room();
        $roomCategoryModel = new RoomCategory();
        $amenityModel = new Amenity();
        $bedTypeModel = new BedType();
        $data['roomCategories'] = $roomCategoryModel->findAll();
        $data['amenities'] = $amenityModel->findAll();
        $data['bedTypes'] = $bedTypeModel->findAll();

        // Find the Room by ID
        $data['room'] = $roomModel->find($id);

        // Render view with error validation message
        return view('Rooms\edit', $data);
    } else {
        // Model initialize
        $roomModel = new Room();

        // Get the uploaded image
        if (isset($image) && $image->isValid() && !$image->hasMoved()) {
            // Generate a random name for the image to avoid name conflicts
            $newName = $image->getRandomName();

            // Move the uploaded image to the "uploads" directory
            $image->move(ROOTPATH . 'public/uploads/rooms', $newName);

            // Delete the old image (optional)
            $oldImage = $roomModel->find($id)['image'];
            if ($oldImage && file_exists(ROOTPATH . 'public/uploads/rooms/' . $oldImage)) {
                unlink(ROOTPATH . 'public/uploads/rooms/' . $oldImage);
            }
        } else {
            // Use the existing image name from the database if no new image was uploaded
            $newName = $roomModel->find($id)['image'];
        }

        // Update data in the database
        $roomModel->update($id, [
            'room_category_id' => $this->request->getPost('room_category_id'),
            'amenity_id' => $this->request->getPost('amenity_id'),
            'bed_type_id' => $this->request->getPost('bed_type_id'),
            'name' => $this->request->getPost('name'),
            'image' => $newName,
            'type' => $this->request->getPost('type'),
        ]);

        // Flash message
        session()->setFlashdata('message', 'Room Berhasil Diupdate');

        return redirect()->to(base_url('rooms'));
    }
}

    

    public function delete($id)
    {
        //model initialize
        $roomModel = new Room();

        // Delete the room
        $roomModel->delete($id);

        //flash message
        session()->setFlashdata('message', 'Room Berhasil Dihapus');

        return redirect()->to(base_url('rooms'));
    }

    function export()
    {
        $roomModel = new Room();
        $pager = \Config\Services::pager();
    
        // Get paginated rooms with their associated room categories and amenities
        $rooms = $roomModel->join('room_categories', 'room_categories.id = rooms.room_category_id')
            ->join('amenities', 'amenities.id = rooms.amenity_id', 'left') // Use left join if amenity_id is nullable
            ->join('bed_types', 'bed_types.id = rooms.bed_type_id', 'left') // Use left join if bed_type_id is nullable
            ->select('rooms.*, room_categories.name as category_name, amenities.name as amenity_name, bed_types.name as bed_type_name')
            ->paginate(5, 'room');
    
        $data = [
            'rooms' => $rooms,
            'pager' => $roomModel->pager,
        ];
    
        // Generate the current date and time in the 'Y-m-d-H-i-s' format
        $current_date_time = date('Y-m-d-H-i-s');
    
        $file_name = 'data-rooms-' . $current_date_time . '.xlsx';
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        $sheet->setCellValue('A1', 'Room Category');
        $sheet->setCellValue('B1', 'Room Amenity');
        $sheet->setCellValue('C1', 'Room Bed Type');
        $sheet->setCellValue('D1', 'Room Name');
        $sheet->setCellValue('E1', 'Room Type');
    
        $count = 2;
    
        foreach ($rooms as $row) { // Loop through $rooms instead of $data
            $sheet->setCellValue('A' . $count, $row['category_name']);
            $sheet->setCellValue('B' . $count, $row['amenity_name']);
            $sheet->setCellValue('C' . $count, $row['bed_type_name']);
            $sheet->setCellValue('D' . $count, $row['name']);
            $sheet->setCellValue('E' . $count, $row['type']);
    
            $count++;
        }
    
        $writer = new Xlsx($spreadsheet);
        $writer->save($file_name);
    
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($file_name));
    
        readfile($file_name);
        exit;
    }

    function template_excel()
    {
        $roomModel = new Room();
        $pager = \Config\Services::pager();
    
        // Get paginated rooms with their associated room categories and amenities
        $rooms = $roomModel->join('room_categories', 'room_categories.id = rooms.room_category_id')
            ->join('amenities', 'amenities.id = rooms.amenity_id', 'left') // Use left join if amenity_id is nullable
            ->join('bed_types', 'bed_types.id = rooms.bed_type_id', 'left') // Use left join if bed_type_id is nullable
            ->select('rooms.*, room_categories.name as category_name, amenities.name as amenity_name, bed_types.name as bed_type_name')
            ->paginate(5, 'room');
    
        $data = [
            'rooms' => $rooms,
            'pager' => $roomModel->pager,
        ];
    
        // Generate the current date and time in the 'Y-m-d-H-i-s' format
        $current_date_time = date('Y-m-d-H-i-s');
    
        $file_name = 'data-rooms-' . $current_date_time . '.xlsx';
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        $sheet->setCellValue('A1', 'Room Category');
        $sheet->setCellValue('B1', 'Room Amenity');
        $sheet->setCellValue('C1', 'Room Bed Type');
        $sheet->setCellValue('D1', 'Room Name');
        $sheet->setCellValue('E1', 'Room Type');
    
        $count = 2;
    
        foreach ($rooms as $row) { // Loop through $rooms instead of $data
            $sheet->setCellValue('A' . $count, $row['category_name']);
            $sheet->setCellValue('B' . $count, $row['amenity_name']);
            $sheet->setCellValue('C' . $count, $row['bed_type_name']);
            $sheet->setCellValue('D' . $count, $row['name']);
            $sheet->setCellValue('E' . $count, $row['type']);
    
            $count++;
        }
    
        $writer = new Xlsx($spreadsheet);
        $writer->save($file_name);
    
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length:' . filesize($file_name));
    
        readfile($file_name);
        exit;
    }

    function import()
    {
            $file_excel = $this->request->getFile('file');
            $ext = $file_excel->getClientExtension();
            if($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $render->load($file_excel);

            $data = $spreadsheet->getActiveSheet()->toArray();
            foreach($data as $x => $row) {
                if ($x == 0) {
                    continue;
                }
                
                $category_name = $row[0];
                $amenity_name = $row[1];
                $bed_type_name = $row[2];
                $name = $row[3];
                $type = $row[4];

                $db = \Config\Database::connect();

                $cekName = $db->table('rooms')->getWhere(['name'=>$name])->getResult();

                if(count($cekName) > 0) {
                    session()->setFlashdata('message','<b style="color:red">Data Gagal di Import Nama Room ada yang sama</b>');
                } else {

                $simpandata = [
                    'room_category_id'=> $category_name, 
                    'amenity_id'=> $amenity_name, 
                    'bed_type_id'=> $bed_type_name, 
                    'name'=> $name, 
                    'type'=> $type
                ];

                $db->table('rooms')->insert($simpandata);
                session()->setFlashdata('message','Berhasil import excel'); 
            }
        }
            
            return redirect()->to('/rooms');
    }
    
    

}
